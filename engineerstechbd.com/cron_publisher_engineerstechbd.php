<?php
/**
 * Cron Publisher for engineerstechbd.com
 * 
 * Table: posts (id, title, slug, category, cover_image, excerpt, content, status, created_at, updated_at)
 * 
 * Cron: */30 * * * * /usr/bin/php /home/ctgcnkle/public_html/cron_publisher_engineerstechbd.php >> /home/ctgcnkle/cron_engineer.log 2>&1
 */

// ── Supabase config ──
define('SUPABASE_URL', 'https://toqzhpupnbyexaloxycr.supabase.co');
define('SUPABASE_ANON_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InRvcXpocHVwbmJ5ZXhhbG94eWNyIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzU2NzE2MzYsImV4cCI6MjA5MTI0NzYzNn0.NdutC7AHeYS-dmvhlyzgAIHBtQFo7cJpmh5PFS0H4H8');
define('BLOG_API_KEY', 'dccf4a9d-fa69-432c-87f5-3998319ccdf5');
define('BLOG_DOMAIN', 'engineerstechbd.com');

// ── MySQL config for engineerstechbd (UPDATED DB NAME) ──
define('DB_HOST', 'localhost');
define('DB_NAME', 'ctgcnkle_eTWebsiteDB');   // Correct database name
define('DB_USER', 'ctgcnkle_mcp');
define('DB_PASS', 'Pjokjict4@#');

// ── Log file ──
define('LOG_FILE', '/home/ctgcnkle/cron_engineer.log');

function logMsg($msg) {
    $ts = date('Y-m-d H:i:s');
    file_put_contents(LOG_FILE, "[$ts] $msg\n", FILE_APPEND);
    echo "[$ts] $msg\n";
}

logMsg("=== Starting cron publisher for " . BLOG_DOMAIN . " ===");

// ── Connect to MySQL ──
try {
    $db = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    logMsg("MySQL connected to database: " . DB_NAME);
} catch (PDOException $e) {
    logMsg("MySQL connection failed: " . $e->getMessage());
    exit(1);
}

// ── Fetch approved articles from Supabase Edge Function ──
$url = SUPABASE_URL . '/functions/v1/fetch-articles?api_key=' . urlencode(BLOG_API_KEY) . '&domain=' . urlencode(BLOG_DOMAIN);

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . SUPABASE_ANON_KEY,
    ],
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErr = curl_error($ch);
curl_close($ch);

if ($curlErr) {
    logMsg("CURL error: $curlErr");
    exit(1);
}

if ($httpCode !== 200) {
    logMsg("HTTP error $httpCode: $response");
    exit(1);
}

$data = json_decode($response, true);
if (empty($data['articles'])) {
    logMsg("No new articles to publish.");
    exit(0);
}

$published = 0;
$failed = 0;

foreach ($data['articles'] as $article) {
    try {
        // Check if slug already exists
        $stmt = $db->prepare("SELECT id FROM posts WHERE slug = ? LIMIT 1");
        $stmt->execute([$article['slug']]);
        if ($stmt->fetchColumn()) {
            logMsg("SKIP: Article with slug '{$article['slug']}' already exists.");
            continue;
        }

        // Insert into posts table
        $stmt = $db->prepare("
            INSERT INTO posts (title, slug, category, cover_image, excerpt, content, status, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, 'published', NOW(), NOW())
        ");
        $stmt->execute([
            $article['title'],
            $article['slug'],
            $article['category'] ?? 'General',
            $article['featured_image_url'] ?? null,
            $article['excerpt'] ?? '',
            $article['content'],
        ]);
        $postId = $db->lastInsertId();

        logMsg("PUBLISHED: [{$postId}] {$article['title']}");
        $published++;

    } catch (Exception $e) {
        logMsg("FAILED: '{$article['title']}' - " . $e->getMessage());
        $failed++;
    }
}

logMsg("=== Done. Published: $published, Failed: $failed ===");
?>