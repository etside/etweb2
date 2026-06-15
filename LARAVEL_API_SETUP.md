# Update routes/api.php in Laravel

Add these routes to `routes/api.php`:

```php
<?php

use App\Http\Controllers\API\{
    ServiceController,
    ProductController,
    ProjectController,
    LeadController,
    RecommendationController
};

Route::prefix('v1')->group(function () {
    
    // Services API
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{id}', [ServiceController::class, 'show']);
    
    // Products API
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    
    // Projects/Portfolio API
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    
    // Leads API (MCP Server Integration)
    Route::post('/leads', [LeadController::class, 'store']);
    Route::get('/leads/{id}', [LeadController::class, 'show']);
    Route::patch('/leads/{id}', [LeadController::class, 'update']);
    Route::get('/leads/platform/{platform}', [LeadController::class, 'byPlatform']);
    Route::get('/leads/qualified/{threshold?}', [LeadController::class, 'qualified']);
    
    // Recommendations API
    Route::post('/recommendations/services', [RecommendationController::class, 'recommendServices']);
    Route::post('/recommendations/products', [RecommendationController::class, 'recommendProducts']);
    
});
```

## Commands to Run

```bash
# Migrate database
php artisan migrate

# Create models if not exists
php artisan make:model MCPLead
php artisan make:controller API/LeadController
php artisan make:controller API/RecommendationController

# Test API
curl http://localhost:8000/api/v1/services
curl http://localhost:8000/api/v1/leads -X POST -H "Content-Type: application/json" -d '{"email":"test@example.com","name":"Test User"}'
```
