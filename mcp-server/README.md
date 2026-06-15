# engineersTech MCP Server

Model Context Protocol (MCP) Server for engineersTech AI Sales Assistant. Deploy on ChatGPT, Tencent Cloud, Claude, and other MCP-compatible platforms.

## Features

- ✅ Single MCP server → Multiple platforms
- ✅ AI-powered service recommendations
- ✅ Smart lead capture & scoring
- ✅ Portfolio & project showcase
- ✅ Real-time conversation analytics
- ✅ Multi-platform deployment ready

## Platforms Supported

| Platform | Status | Deployment |
|----------|--------|-----------|
| ChatGPT Apps | ✅ Ready | Docker + HTTPS |
| Tencent Cloud | ✅ Ready | Serverless (SCF) |
| Claude | ✅ Ready | Native MCP |
| Slack | 🔄 Bridge | Coming soon |
| GitHub | 🔄 Bridge | Coming soon |

## Quick Start

### Prerequisites

- Node.js 18+
- npm 9+
- Docker (for deployment)

### Local Development

```bash
# Install dependencies
npm install

# Setup environment
cp .env.example .env
# Edit .env with your configuration

# Start development server
npm run dev

# Open http://localhost:3000
```

### Build & Test

```bash
# Build TypeScript
npm run build

# Run tests
npm run test

# Run specific test suite
npm run test:chatgpt:integration
npm run test:tencent:integration
```

## Project Structure

```
mcp-server/
├── src/
│   ├── index.ts              # Main entry point
│   ├── tools/                # Tool implementations
│   │   ├── serviceTools.ts
│   │   ├── productTools.ts
│   │   ├── projectTools.ts
│   │   └── leadTools.ts
│   ├── backends/             # External API clients
│   │   └── laravelAPI.ts
│   ├── adapters/             # Platform adapters
│   │   ├── chatgptAdapter.ts
│   │   ├── tencentAdapter.ts
│   │   └── claudeAdapter.ts
│   ├── state/                # State management
│   ├── prompts/              # System prompts
│   ├── utils/                # Utilities
│   └── types/                # TypeScript types
├── tests/                    # Test files
├── docker/                   # Docker configuration
└── scripts/                  # Deployment scripts
```

## Available Tools

### Service Tools
- `get_services()` - List all services
- `get_service_details()` - Service information
- `recommend_services()` - AI recommendations

### Product Tools
- `get_products()` - Product catalog
- `get_product_details()` - Product info

### Project Tools
- `get_projects()` - Portfolio showcase
- `get_project_details()` - Project case study

### Lead Tools
- `capture_lead()` - Capture prospect info
- `get_lead_status()` - Lead status tracking

## Deployment

### ChatGPT Apps

```bash
npm run deploy:chatgpt
```

### Tencent Cloud

```bash
npm run deploy:tencent
```

### Docker

```bash
npm run docker:build
npm run docker:run
```

## Configuration

All configuration via environment variables. See `.env.example`.

Key variables:
- `LARAVEL_API_URL` - Backend API endpoint
- `LARAVEL_API_KEY` - API authentication key
- `MCP_PUBLIC_URL` - Public HTTPS endpoint (for ChatGPT)
- `CHATGPT_ADAPTER_ENABLED` - Enable ChatGPT adapter
- `TENCENTCLOUD_*` - Tencent Cloud credentials

## API Reference

### POST /mcp (for adapters)
```json
{
  "method": "get_services",
  "params": {
    "category": "development",
    "limit": 10
  }
}
```

### Health Check

```bash
curl http://localhost:3000/health
```

## Contributing

1. Create feature branch
2. Make changes
3. Run tests: `npm run test`
4. Format code: `npm run format`
5. Submit PR

## Support

- 📧 Email: devops@engineerstechbd.com
- 📋 Issues: GitHub Issues
- 📚 Docs: [Deployment Plan](../MULTI_PLATFORM_DEPLOYMENT_PLAN.md)

## License

MIT
