# Multi-Platform Deployment - Quick Reference

## Core Principle: Build Once, Deploy Everywhere

**Single MCP Server** → **Multiple Platforms** → **Same Tools & Logic**

---

## The Three-Layer Architecture

### Layer 1: MCP Server (Core Logic)
```
┌─────────────────────────────────────────┐
│ MCP Server (Node.js/TypeScript)         │
│ ────────────────────────────────────    │
│ • Tools (functions)                     │
│ • Resources (data templates)            │
│ • Prompts (system messages)             │
│ • State management                      │
│                                         │
│ Tools:                                  │
│ - get_services()                        │
│ - get_products()                        │
│ - get_projects()                        │
│ - recommend_services()                  │
│ - capture_lead()                        │
└─────────────────────────────────────────┘
```

### Layer 2: Platform Adapters (Connectors)
```
ChatGPT Adapter          Tencent Adapter         Claude Adapter
├─ HTTP Server           ├─ SCF Wrapper          ├─ Stdio Transport
├─ Manifest endpoint     ├─ Mini App Backend     ├─ Native MCP
├─ OpenAPI spec          ├─ Tencent format       ├─ Direct tool calls
└─ ChatGPT UI            └─ Mini app format      └─ Auto-discovery
```

### Layer 3: Data Backend (Persistence)
```
┌─────────────────────────────────┐
│ Laravel Backend (engineersTech) │
│ ─────────────────────────────   │
│ • /api/v1/services             │
│ • /api/v1/products             │
│ • /api/v1/projects             │
│ • /api/v1/leads                │
│ • /api/v1/recommendations      │
└─────────────────────────────────┘
```

---

## Comparison: Platform-Specific Approaches

| Aspect | OpenAI ChatGPT | Tencent Cloud | Claude | Others |
|--------|---|---|---|---|
| **Integration** | HTTP REST → MCP | Backend API + SDK | Stdio transport | Variable |
| **Deployment** | Docker + HTTPS | SCF Serverless | Local/Desktop | Varies |
| **Discovery** | Manifest.json | Tencent Console | Desktop config | Platform-specific |
| **UI/UX** | ChatGPT Native | Custom Mini App | Claude chat | Platform UI |
| **Distribution** | App Store | Cloud Marketplace | Desktop app | Varies |
| **Cost** | Revenue share | Pay-as-you-go | Free (local) | Varies |
| **Reach** | 200M+ users | 800M+ users (Asia) | 200M+ users | Growing |

---

## Quick Deployment Path

### ✅ Step 1: Build Core MCP Server
```bash
npm init
npm install @modelcontextprotocol/sdk
# Create src/tools/*.ts
# Create src/backends/laravelAPI.ts
npm run build
```
**Time**: 1 week

### ✅ Step 2: ChatGPT Adapter (Fastest ROI)
```bash
npm install express
# Create src/adapters/chatgptAdapter.ts
npm run build:chatgpt
docker build -t engineerstech-mcp:latest .
# Deploy to: Docker/VPS/AWS
# Register at: platform.openai.com/apps
```
**Time**: 3-5 days

### ✅ Step 3: Tencent Cloud Adapter
```bash
npm install @tencentcloud/sdk-scf
# Create src/adapters/tencentAdapter.ts
npm run build:tencent
serverless deploy
# Register in: Tencent Cloud Console
```
**Time**: 1 week

### ✅ Step 4: Other Platforms (Claude, Slack, etc.)
```bash
# Claude: Just point to MCP server (works out of box!)
# Slack: Create bridge → Slack app → MCP server
# GitHub: Create Action runner → MCP server
```
**Time**: 3-5 days each

---

## Key Technologies Used

| Component | Technology | Why |
|-----------|-----------|-----|
| MCP Server | Node.js 18+ | Fast, async, TypeScript support |
| Framework | Express.js | Lightweight, flexible routing |
| DB ORM | Laravel Eloquent | Already in use, proven |
| Deployment | Docker | Consistent across platforms |
| ChatGPT | OpenAI Apps SDK | Native, easy integration |
| Tencent | Tencent SCF | Serverless, auto-scaling |
| Caching | Redis | Session & response caching |
| Logging | Winston | Structured, platform-agnostic |

---

## Tools That Power Each Platform

### All Platforms Share These Tools:
```
✅ get_services(category?, limit?)
✅ get_service_details(service_id)
✅ recommend_services(business_type, challenges)
✅ get_products(category?, limit?)
✅ get_products_details(product_id)
✅ get_projects() → Portfolio
✅ capture_lead(email, name, company, service_interest, platform_source)
✅ get_lead_status(lead_id)
```

### Platform-Specific Variations:
```
ChatGPT:
  + get_conversation_context() → Remember previous messages
  + upload_file() → For document analysis
  + schedule_demo() → Direct calendar integration

Tencent:
  + get_user_location() → Mini app permission
  + send_notification() → Mini app notification system
  + process_payment() → Tencent payment integration

Claude:
  + search_knowledge_base() → Internal docs search
  + run_code_analysis() → Technical deep dives
```

---

## Database Schema (New Tables)

### mcp_leads Table
```sql
CREATE TABLE mcp_leads (
  id BIGINT PRIMARY KEY,
  email VARCHAR(255) UNIQUE,
  name VARCHAR(255),
  company VARCHAR(255),
  phone VARCHAR(20),
  service_interest VARCHAR(255),
  budget_range VARCHAR(50),
  conversation_summary LONGTEXT,
  platform_source ENUM('chatgpt', 'tencent', 'claude', 'slack', 'web'),
  status ENUM('new', 'contacted', 'qualified', 'proposal', 'converted'),
  lead_score INT,
  mcp_session_id VARCHAR(255),
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  
  INDEX(platform_source),
  INDEX(status),
  INDEX(created_at)
);
```

---

## Environment Variables Needed

### Development
```env
LARAVEL_API_URL=http://localhost:8000/api/v1
LARAVEL_API_KEY=dev-key
MCP_PORT=3000
NODE_ENV=development
REDIS_URL=redis://localhost:6379
```

### Production (All Platforms)
```env
# Core
NODE_ENV=production
LOG_LEVEL=info
LARAVEL_API_URL=https://engineerstechbd.com/api/v1
LARAVEL_API_KEY=${SECURE_KEY}

# ChatGPT
OPENAI_API_KEY=${OPENAI_KEY}
MCP_PUBLIC_URL=https://api.your-domain.com
CHATGPT_ADAPTER_ENABLED=true

# Tencent Cloud
TENCENTCLOUD_SECRET_ID=${TENCENT_ID}
TENCENTCLOUD_SECRET_KEY=${TENCENT_KEY}
TENCENT_ADAPTER_ENABLED=true

# Cache
REDIS_URL=redis://redis-prod:6379

# Email notifications
SMTP_HOST=smtp.sendgrid.net
NOTIFICATION_EMAIL=sales@engineerstechbd.com
```

---

## Testing Strategy

### Unit Tests
```bash
npm run test:unit
# Test each tool independently
```

### Integration Tests
```bash
npm run test:integration
# Test tools with mock Laravel API
```

### Platform-Specific Tests
```bash
npm run test:chatgpt:integration
npm run test:tencent:integration
npm run test:claude:integration
```

### End-to-End Tests
```bash
# Deploy to staging
# Test actual ChatGPT conversation
# Test actual Tencent Mini App
# Monitor for 48 hours before production
```

---

## Monitoring & Analytics

### Key Metrics Per Platform
```
ChatGPT:
  • Conversations initiated per day
  • Average conversation length
  • Tool call frequency
  • Leads captured per day
  • Conversion rate

Tencent:
  • DAU (Daily Active Users)
  • Tool usage by region
  • Crash rate
  • Lead quality score

Claude:
  • Sessions per day
  • Tool accuracy rating
  • Conversation depth
```

### Alerting Thresholds
```
⚠️ Warning: Error rate > 5%
🚨 Critical: Error rate > 10%
⚠️ Warning: Response time > 5s
🚨 Critical: Response time > 10s
⚠️ Warning: Lead capture failures > 1%
```

---

## Security Checklist

- [ ] Rate limiting enabled on all endpoints
- [ ] Input validation on all tool parameters
- [ ] API key rotation every 90 days
- [ ] HTTPS/TLS 1.3 enforced
- [ ] CORS properly configured per platform
- [ ] SQL injection prevention (use parameterized queries)
- [ ] XSS protection on any UI components
- [ ] GDPR consent before email capture
- [ ] Data encryption at rest
- [ ] Regular security audits

---

## Cost Analysis

| Platform | Setup | Monthly | Per Lead | Notes |
|----------|-------|---------|----------|-------|
| **ChatGPT** | $0 (free tier) | $100-500 | $0-5 | Revenue share model available |
| **Tencent** | $100 | $200-1000 | $0-2 | Pay-as-you-go, very cost-effective |
| **Claude** | $0 | $0 (local) | $0 | Desktop only, no cloud costs |
| **Total** | ~$100 | ~$400-1500 | | Highly scalable |

---

## Migration Path

### Week 1: Foundation
- [x] Design MCP server architecture
- [ ] Setup repository and CI/CD
- [ ] Build core tools (get_services, get_products, etc.)
- [ ] Create LaravelAPI client

### Week 2-3: ChatGPT (Quick Win)
- [ ] Build ChatGPT adapter
- [ ] Deploy to production
- [ ] Register with OpenAI
- [ ] Soft launch for testing

### Week 4-5: Tencent Cloud
- [ ] Build Tencent adapter
- [ ] Setup Tencent Cloud account
- [ ] Deploy to SCF
- [ ] Create mini app frontend
- [ ] Register with Tencent

### Week 6: Other Platforms
- [ ] Claude integration (5 hours - it works natively!)
- [ ] Slack bridge (if needed)
- [ ] GitHub Actions (if needed)

### Week 7+: Optimization
- [ ] Lead scoring refinement
- [ ] Conversation analytics
- [ ] Performance optimization
- [ ] Multi-language support

---

## Support & Documentation

| Resource | Link |
|----------|------|
| Full Deployment Plan | [MULTI_PLATFORM_DEPLOYMENT_PLAN.md](./MULTI_PLATFORM_DEPLOYMENT_PLAN.md) |
| OpenAI Apps SDK | https://developers.openai.com/apps-sdk |
| Tencent Cloud Docs | https://www.tencentcloud.com/document/product/1219/61257 |
| MCP Specification | https://spec.modelcontextprotocol.io/ |
| Repository | https://github.com/engineerstech/mcp-server |
| Issues & Support | devops@engineerstechbd.com |

---

## Next Steps

1. **Immediately**: Review and validate this plan with team
2. **This week**: Provision infrastructure (Docker, VPS, etc.)
3. **Next week**: Start building MCP server core
4. **Week 2**: Deploy ChatGPT adapter
5. **Week 4**: Deploy Tencent adapter
6. **Week 6**: Monitor, optimize, scale

---

**Status**: APPROVED FOR IMPLEMENTATION  
**Last Updated**: 2026-06-15  
**Prepared By**: AI Engineering Team  
**Next Review**: 2026-07-15
