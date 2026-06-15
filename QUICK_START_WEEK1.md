# 🚀 Quick Start Checklist - Week 1

**Goal**: Get MCP Server running locally and integrated with Laravel API

## 📋 Pre-Flight Checks

- [ ] Node.js 18+ installed: `node --version` (should be ≥18)
- [ ] npm installed: `npm --version`
- [ ] PHP 8.2+ installed: `php --version`
- [ ] Laravel Artisan available: `php artisan --version`
- [ ] Git configured: `git config user.email`
- [ ] Docker installed (optional): `docker --version`

**Status**: Proceed if all checked ✅

---

## 🔧 Step 1: Setup MCP Server (15 minutes)

```bash
# 1.1 Navigate to MCP project
cd /home/tjms/Documents/engineerstechbd/mcp-server

# 1.2 Copy environment template
cp .env.example .env
echo "✅ Created .env file"

# 1.3 Install dependencies
npm install
# Watch for: "added XXX packages" (should be 50+)
echo "✅ Dependencies installed"

# 1.4 Build TypeScript
npm run build
# Watch for: No errors in output
echo "✅ TypeScript compiled"

# 1.5 Create logs directory
mkdir -p logs
echo "✅ Logs directory created"
```

**Checklist**:
- [ ] .env file exists
- [ ] `node_modules/` directory created
- [ ] `dist/` directory created (compiled JavaScript)
- [ ] `logs/` directory created
- [ ] No build errors

---

## ⚙️ Step 2: Configure Environment (10 minutes)

**File**: `/home/tjms/Documents/engineerstechbd/mcp-server/.env`

```bash
# 2.1 Edit .env file
nano .env
```

**Find and update these values**:

```dotenv
# Node Environment
NODE_ENV=development
MCP_PORT=3000
LOG_LEVEL=debug

# Laravel API Configuration
LARAVEL_API_URL=http://localhost:8000/api/v1
LARAVEL_API_KEY=your-laravel-api-key-here
LARAVEL_API_TIMEOUT=10000

# For production ChatGPT deployment (configure later)
MCP_PUBLIC_URL=https://your-domain.com
OPENAI_API_KEY=sk-...
OPENAI_ORG_ID=org-...

# For Tencent deployment (configure later)
# TENCENTCLOUD_SECRET_ID=...
# TENCENTCLOUD_SECRET_KEY=...
```

**Get Laravel API Key**:
```bash
# In Laravel project directory
cd /home/tjms/Documents/engineerstechbd/eTwebsitebackend/eTwebsitebackend
php artisan tinker
> config('app.key')  # This is your base Laravel key
# Create a personal access token if using Sanctum:
> \App\Models\User::find(1)->createToken('mcp-server')->plainTextToken
```

**Checklist**:
- [ ] LARAVEL_API_URL set correctly
- [ ] LARAVEL_API_KEY obtained
- [ ] Other values look reasonable
- [ ] File saved (Ctrl+X, Y, Enter in nano)

---

## 🗄️ Step 3: Setup Laravel Database (20 minutes)

```bash
# 3.1 Navigate to Laravel project
cd /home/tjms/Documents/engineerstechbd/eTwebsitebackend/eTwebsitebackend

# 3.2 Run migrations
php artisan migrate
# Watch for: "✓ Migrated: 2026_06_15_000000_create_mcp_leads_table"

# 3.3 Verify table created
php artisan tinker
> DB::table('mcp_leads')->first()
# Should return: null (no data yet, but table exists)
> exit
```

**If migration fails**:
```bash
# Check migration file exists
ls database/migrations/ | grep mcp_leads

# Run with verbose output
php artisan migrate --verbose

# If still fails, check Laravel setup
php artisan --version
php artisan config:clear
php artisan migrate --fresh  # ⚠️ WARNING: This clears all data!
```

**Checklist**:
- [ ] Migration executed successfully
- [ ] No errors in output
- [ ] `mcp_leads` table created
- [ ] Laravel API responding

---

## 🔌 Step 4: Test Connectivity (10 minutes)

**Terminal 1 - Start MCP Server**:
```bash
cd /home/tjms/Documents/engineerstechbd/mcp-server
npm run dev

# Expected output:
# 🌐 MCP Server listening on port 3000
# ✅ Server ready for tool requests
# 📝 Logs written to ./logs/combined.log
```

**Terminal 2 - Test Endpoints**:
```bash
# 4.1 Health check
curl http://localhost:3000/health
# Expected: {"status":"ok","platform":"mcp"}

# 4.2 Manifest (for ChatGPT - will fail now, that's OK)
curl http://localhost:3000/.well-known/manifest.json
# Expected: Will fail - this requires MCP_PUBLIC_URL

# 4.3 Test tool call (simple)
curl -X POST http://localhost:3000/mcp \
  -H "Content-Type: application/json" \
  -d '{
    "jsonrpc": "2.0",
    "method": "tools/call",
    "params": {
      "name": "get_services",
      "arguments": {
        "category": "web"
      }
    },
    "id": 1
  }'
# Expected: Returns list of services (may be empty if DB empty)
```

**Checklist**:
- [ ] MCP server starts without errors
- [ ] Health endpoint returns 200
- [ ] No connection errors in logs
- [ ] Tool call returns valid JSON (even if empty data)

---

## 🔗 Step 5: Test Laravel Integration (15 minutes)

**Make sure MCP Server is running** (from Step 4, Terminal 1)

**Terminal 2 - Direct Laravel API Test**:
```bash
# 5.1 Get API key (if not already done)
cd /home/tjms/Documents/engineerstechbd/eTwebsitebackend/eTwebsitebackend
API_KEY=$(php artisan tinker --execute 'echo base64_encode("test-api-key")')

# 5.2 Test Laravel API directly
curl http://localhost:8000/api/v1/services \
  -H "Authorization: Bearer ${API_KEY}"

# Expected: 
# {"data":[],"meta":{"total":0,"returned":0}}
# (Empty because no services in DB yet - that's OK)

# 5.3 Test MCP → Laravel flow
# Go back to MCP server and check logs
tail -f logs/combined.log
```

**Checklist**:
- [ ] Laravel API responds to direct curl requests
- [ ] No 401 Unauthorized errors
- [ ] MCP server shows request logs
- [ ] Response format is JSON

---

## ✅ Step 6: Add Demo Data (Optional, 10 minutes)

**Test with real data**:
```bash
cd /home/tjms/Documents/engineerstechbd/eTwebsitebackend/eTwebsitebackend

# Open Laravel tinker
php artisan tinker

# Create a demo service
\App\Models\Service::create([
  'name' => 'Web Development',
  'slug' => 'web-development',
  'category' => 'web',
  'description' => 'Custom web application development',
  'price_from' => 10000,
  'duration_weeks' => 12
])

# Exit
exit

# Now test again in Terminal 2
curl http://localhost:3000/mcp \
  -X POST \
  -H "Content-Type: application/json" \
  -d '{"jsonrpc":"2.0","method":"tools/call","params":{"name":"get_services","arguments":{"category":"web"}},"id":1}'

# Expected: Now returns your service!
```

**Checklist**:
- [ ] Services created in database
- [ ] MCP tool returns service data
- [ ] Tool recommendations work (if you test them)

---

## 📊 Progress Summary

**If all steps complete**: You have ✅ 
- MCP Server running locally on port 3000
- Connected to Laravel API
- Database synchronized
- Ready to test platform deployments

**Next**: Go to IMPLEMENTATION_CHECKLIST.md for Week 2 tasks

---

## 🆘 Troubleshooting

### "npm install" fails
```bash
# Clear npm cache
npm cache clean --force

# Try again
npm install

# If still fails, check Node version
node --version  # Should be 18 or higher
```

### MCP server won't start
```bash
# Check if port 3000 is in use
lsof -i :3000

# Kill process using port 3000
kill -9 <PID>

# Try again
npm run dev
```

### Laravel migration fails
```bash
# Check Laravel is properly installed
php artisan --version

# Check database connection
php artisan migrate:status

# Try fresh migration (WARNING: clears data)
php artisan migrate:refresh
```

### API key not working
```bash
# Generate new key
cd eTwebsitebackend/eTwebsitebackend
php artisan tinker

# Generate token
> \App\Models\User::find(1)->createToken('mcp-api')->plainTextToken

# Copy the token and update .env
```

### Connection refused errors
```bash
# Make sure Laravel is running
# Terminal 3: cd eTwebsitebackend/eTwebsitebackend && php artisan serve

# Check LARAVEL_API_URL in .env
cat mcp-server/.env | grep LARAVEL_API_URL

# Should be http://localhost:8000/api/v1
```

---

## ⏱️ Total Time Estimate: 90 minutes

| Step | Task | Time |
|------|------|------|
| 1 | Setup MCP Server | 15 min |
| 2 | Configure Environment | 10 min |
| 3 | Database Migrations | 20 min |
| 4 | Test Connectivity | 10 min |
| 5 | Laravel Integration | 15 min |
| 6 | Demo Data (optional) | 10 min |
| - | **TOTAL** | **90 min** |

---

## 🎉 Success Indicators

You'll know everything is working when:

✅ MCP server starts without errors  
✅ Health check returns `{"status":"ok"}`  
✅ Tool calls return JSON responses  
✅ Laravel API responds to requests  
✅ MCP logs show successful API calls  
✅ Demo data appears in responses  

---

**Ready? Start with Step 1 above! 🚀**

Questions? Check the documentation files:
- `ARCHITECTURE_DIAGRAMS.md` - Visual system overview
- `MULTI_PLATFORM_DEPLOYMENT_PLAN.md` - Complete guide
- `LARAVEL_API_SETUP.md` - API configuration details
