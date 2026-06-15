#!/bin/bash

# Setup MCP Server with Laravel API integration
set -e

echo "📋 engineersTech MCP Server Setup"
echo "=================================="
echo ""

# Step 1: Install dependencies
echo "📦 Step 1: Installing dependencies..."
npm install
echo "✅ Dependencies installed"
echo ""

# Step 2: Setup environment
echo "⚙️  Step 2: Setting up environment..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ Created .env (please configure your API keys)"
else
    echo "✅ .env already exists"
fi
echo ""

# Step 3: Build TypeScript
echo "🔨 Step 3: Building TypeScript..."
npm run build
echo "✅ Build complete"
echo ""

# Step 4: Create logs directory
echo "📁 Step 4: Creating logs directory..."
mkdir -p logs
echo "✅ Logs directory created"
echo ""

# Step 5: Laravel Database Setup
echo "🗄️  Step 5: Running Laravel migrations..."
echo "⚠️  Make sure Laravel is running first!"
echo ""
echo "To run migrations, execute in your Laravel directory:"
echo "php artisan migrate"
echo ""

# Step 6: Test MCP Server
echo "🧪 Step 6: Testing MCP Server..."
echo ""
echo "Start the development server with:"
echo "  npm run dev"
echo ""
echo "In another terminal, test with:"
echo "  curl http://localhost:3000/health"
echo ""

echo "=================================="
echo "✅ Setup complete!"
echo ""
echo "📚 Next steps:"
echo "1. Edit .env with your configuration"
echo "2. Run: npm run dev"
echo "3. Run Laravel migrations"
echo "4. Test endpoints"
echo ""
echo "📖 Documentation:"
echo "  - Deployment: ../MULTI_PLATFORM_DEPLOYMENT_PLAN.md"
echo "  - Quick Ref: ../DEPLOYMENT_QUICK_REFERENCE.md"
echo ""
