#!/bin/bash

# Deploy to Tencent Cloud via Serverless Framework
set -e

echo "🚀 Deploying engineersTech MCP Server to Tencent Cloud..."

# Check prerequisites
if ! command -v serverless &> /dev/null; then
    echo "❌ Serverless Framework not installed"
    echo "Install with: npm install -g serverless"
    exit 1
fi

# Check Tencent credentials
if [ -z "$TENCENTCLOUD_SECRET_ID" ] || [ -z "$TENCENTCLOUD_SECRET_KEY" ]; then
    echo "❌ Tencent Cloud credentials not set"
    echo "Set:"
    echo "  export TENCENTCLOUD_SECRET_ID=your-id"
    echo "  export TENCENTCLOUD_SECRET_KEY=your-key"
    exit 1
fi

# Build
echo "📦 Building TypeScript..."
npm run build

# Deploy
echo "☁️  Deploying to Tencent Cloud..."
serverless deploy

echo ""
echo "✅ Deployment complete!"
echo "📝 Next steps:"
echo "1. Get the SCF function URL from the deployment output"
echo "2. Register in Tencent Cloud Console"
echo "3. Configure Mini App to call the backend API"
echo ""
