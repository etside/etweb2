#!/bin/bash

# Deploy to ChatGPT Apps via ngrok tunnel
set -e

echo "🚀 Deploying engineersTech MCP Server to ChatGPT..."

# Check if ngrok is installed
if ! command -v ngrok &> /dev/null; then
    echo "❌ ngrok is not installed. Please install it first:"
    echo "   https://ngrok.com/download"
    exit 1
fi

# Build the project
echo "📦 Building TypeScript..."
npm run build

# Start ngrok tunnel in background
echo "🌐 Starting ngrok tunnel..."
NGROK_PID=$!
ngrok http 3000 --log=stdout > /tmp/ngrok.log &
sleep 2

# Extract ngrok URL
NGROK_URL=$(grep -oP 'https://[a-z0-9]+\.ngrok\.io' /tmp/ngrok.log | head -1)

if [ -z "$NGROK_URL" ]; then
    echo "❌ Failed to get ngrok URL"
    exit 1
fi

echo "✅ ngrok URL: $NGROK_URL"

# Update environment
export MCP_PUBLIC_URL=$NGROK_URL

# Start MCP server
echo "🔧 Starting MCP server..."
node dist/index.js &
SERVER_PID=$!

sleep 2

# Test endpoints
echo "🧪 Testing endpoints..."
curl -s "$NGROK_URL/health" | jq . || echo "⚠️  Health check failed"
curl -s "$NGROK_URL/.well-known/manifest.json" | jq . || echo "⚠️  Manifest check failed"

echo ""
echo "✅ Deployment ready!"
echo "📝 Next steps:"
echo "1. Go to https://platform.openai.com/apps"
echo "2. Create new app"
echo "3. Use manifest URL: $NGROK_URL/.well-known/manifest.json"
echo "4. Submit for review"
echo ""
echo "ℹ️  ngrok session will remain active. Press Ctrl+C to stop."

# Keep scripts running
wait $SERVER_PID
