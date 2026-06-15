# Architecture Diagram: Multi-Platform MCP Deployment

## System Architecture Overview

```
┌─────────────────────────────────────────────────────────────────────────┐
│                         ENGINEERSTECH AI ECOSYSTEM                      │
│                                                                         │
│  Users Across Multiple Platforms Getting AI Sales & Support Assistance │
└─────────────────────────────────────────────────────────────────────────┘

                                    ▲
                    ┌───────────────┼───────────────┐
                    │               │               │
                    ▼               ▼               ▼
        ┌──────────────┐  ┌──────────────┐  ┌──────────────┐
        │  ChatGPT    │  │ Tencent Mini │  │   Claude    │
        │  Apps SDK   │  │   App/SCF    │  │   Desktop   │
        │             │  │              │  │             │
        │ 200M Users  │  │ 800M Users   │  │ 200M Users  │
        └──────────────┘  └──────────────┘  └──────────────┘
                    │               │               │
                    └───────────────┼───────────────┘
                                    │
                                    ▼
        ┌───────────────────────────────────────────────────┐
        │     MCP Server (TypeScript + Node.js)            │
        │     /mcp-server/src/index.ts                     │
        │                                                   │
        │  Unified Tool Interface (Platform-Agnostic)     │
        │  • 7 Tools serving all platforms identically     │
        │  • Consistent input/output format                │
        │  • Intelligent routing & error handling          │
        └───────────────────────────────────────────────────┘
                                    │
                ┌───────────────────┼───────────────────┐
                │                   │                   │
                ▼                   ▼                   ▼
        ┌──────────────┐    ┌──────────────┐   ┌──────────────┐
        │  ChatGPT    │    │ Tencent      │   │ CLI/Direct   │
        │  Adapter    │    │  Adapter     │   │   MCP        │
        │ (Express)   │    │ (Serverless) │   │              │
        │             │    │              │   │              │
        │ HTTP/REST   │    │ HTTP/REST    │   │ STDIO        │
        │ OpenAPI     │    │ Format Conv  │   │              │
        └──────────────┘    └──────────────┘   └──────────────┘
                                    │
                                    ▼
        ┌───────────────────────────────────────────────────┐
        │          CORE TOOLS (Platform-Independent)       │
        │                                                   │
        │  ├─ get_services(category?, limit?)             │
        │  ├─ get_service_details(service_id)             │
        │  ├─ recommend_services(business_type, ...)      │
        │  │                                               │
        │  ├─ get_products(category?, limit?)             │
        │  ├─ get_product_details(product_id)             │
        │  │                                               │
        │  ├─ get_projects(category?, limit?)             │
        │  ├─ get_project_details(project_id)             │
        │  │                                               │
        │  ├─ capture_lead(email, name, company, ...)     │
        │  └─ get_lead_status(lead_id)                    │
        │                                                   │
        └───────────────────────────────────────────────────┘
                                    │
                                    ▼
        ┌───────────────────────────────────────────────────┐
        │        Laravel Backend (PHP + Eloquent)          │
        │     /eTwebsitebackend/eTwebsitebackend/          │
        │                                                   │
        │  API Endpoints:                                  │
        │  ├─ GET  /api/v1/services                       │
        │  ├─ GET  /api/v1/services/{id}                  │
        │  ├─ GET  /api/v1/products                       │
        │  ├─ GET  /api/v1/projects                       │
        │  ├─ POST /api/v1/leads (capture)                │
        │  ├─ GET  /api/v1/leads/{id}                     │
        │  ├─ POST /api/v1/recommendations/services       │
        │  └─ POST /api/v1/recommendations/products       │
        │                                                   │
        │  Models:                                         │
        │  ├─ MCPLead (new - for all platform sources)    │
        │  ├─ Service                                     │
        │  ├─ Product                                     │
        │  ├─ Project                                     │
        │  ├─ ContactSubmission                           │
        │  └─ Others...                                   │
        │                                                   │
        └───────────────────────────────────────────────────┘
                                    │
                ┌───────────────────┴───────────────────┐
                │                                       │
                ▼                                       ▼
        ┌──────────────────┐              ┌──────────────────┐
        │  SQLite (Dev)    │              │ PostgreSQL/MySQL │
        │  data.db         │              │   (Production)   │
        │                  │              │                  │
        │  • Services      │              │  Same Schema     │
        │  • Products      │              │                  │
        │  • Projects      │              │  Replicated &    │
        │  • MCPLeads      │              │  Optimized       │
        │  • Contacts      │              │                  │
        │  • etc.          │              │                  │
        └──────────────────┘              └──────────────────┘
```

---

## Request Flow Diagram

```
User in ChatGPT/Tencent/Claude
         │
         │ Natural Language Request
         │ "Show me services for e-commerce"
         │
         ▼
┌─────────────────────────────────────┐
│ Platform (ChatGPT/Tencent/Claude)   │
│ ├─ Parse user input                 │
│ └─ Route to MCP Tool                │
└─────────────────────────────────────┘
         │
         │ Tool Call: get_services(category="ecommerce")
         │
         ▼
┌─────────────────────────────────────┐
│ MCP Server (Platform Adapter)       │
│ ├─ Receive tool call                │
│ ├─ Validate inputs                  │
│ └─ Forward to Laravel API           │
└─────────────────────────────────────┘
         │
         │ HTTP GET /api/v1/services?category=ecommerce
         │ Authorization: Bearer API_KEY
         │
         ▼
┌─────────────────────────────────────┐
│ Laravel Backend                     │
│ ├─ Validate API key                 │
│ ├─ Query services from database     │
│ ├─ Filter by category               │
│ └─ Return JSON response             │
└─────────────────────────────────────┘
         │
         │ HTTP 200 + Services JSON
         │
         ▼
┌─────────────────────────────────────┐
│ MCP Server (Tool Handler)           │
│ ├─ Parse response                   │
│ ├─ Format for platform              │
│ └─ Return tool result               │
└─────────────────────────────────────┘
         │
         │ Formatted Tool Result
         │
         ▼
User in ChatGPT/Tencent/Claude
         │ (AI Formats Pretty Response)
         │
         ▼ "Here are our E-commerce services..."
       DISPLAY
```

---

## Lead Capture Flow Diagram

```
User Interest in Service
         │
         ▼
User Enters Contact Info
(Email, Name, Company, Budget, etc.)
         │
         ▼
Platform Collects & Validates
         │
         ▼
MCP Tool: capture_lead()
         │
         ├─ Validate input
         │  ├─ Email format ✓
         │  ├─ Required fields ✓
         │  └─ Length limits ✓
         │
         ▼
POST /api/v1/leads
{
  email: "user@company.com",
  name: "John Doe",
  company: "Acme Corp",
  service_interest: "web-development",
  budget_range: "50000-100000",
  platform_source: "chatgpt",
  conversation_summary: "User interested in SaaS platform development"
}
         │
         ▼
Laravel LeadController::store()
         │
         ├─ Create MCPLead record
         │  ├─ id: auto-generated
         │  ├─ status: "new"
         │  ├─ lead_score: calculated
         │  └─ timestamps: created_at, updated_at
         │
         ├─ Trigger notifications
         │  ├─ Email to sales team
         │  └─ Webhook to CRM
         │
         └─ Return lead ID
              │
              ▼
         HTTP 201 + { id: "lead_abc123", ... }
              │
              ▼
         MCP Tool returns to user
              │
              ▼
    User sees confirmation:
    "Lead captured! We'll contact you soon."
```

---

## Deployment Architecture

```
                           DEVELOPMENT
                                │
                    ┌───────────┼───────────┐
                    │           │           │
                    ▼           ▼           ▼
                ┌────────┐  ┌────────┐  ┌────────┐
                │ Docker │  │  npm   │  │ Laravel│
                │ Local  │  │  dev   │  │ Artisan│
                │ Compose│  │        │  │        │
                └────────┘  └────────┘  └────────┘
                    │           │           │
                    └───────────┼───────────┘
                                │
                    Testing & Validation
                                │
                                ▼
                        STAGING ENVIRONMENT
                    (Optional - via ngrok for ChatGPT)
                                │
                ┌───────────────┼───────────────┐
                │               │               │
                ▼               ▼               ▼
            ┌────────────┐  ┌────────────┐  ┌────────────┐
            │  ChatGPT   │  │  Tencent   │  │   Claude   │
            │  via ngrok │  │   Local    │  │   Local    │
            │  (testing) │  │  Deploy    │  │   Config   │
            └────────────┘  └────────────┘  └────────────┘
                                │
                            Review & Approval
                                │
                                ▼
                        PRODUCTION ENVIRONMENT
                                │
                ┌───────────────┼───────────────┐
                │               │               │
                ▼               ▼               ▼
        ┌─────────────────┐ ┌─────────────┐ ┌─────────────┐
        │ ChatGPT Apps    │ │ Tencent SCF │ │ Claude      │
        │ (Custom Domain) │ │ + Mini App  │ │ Standalone  │
        │                 │ │             │ │             │
        │ Docker on VPS   │ │ Serverless  │ │ Configured  │
        │ + Nginx Reverse │ │ Framework   │ │ Desktop     │
        │ Proxy           │ │             │ │             │
        │ + SSL/TLS       │ │ Auto-scale  │ │             │
        └─────────────────┘ └─────────────┘ └─────────────┘
                │               │               │
                └───────────────┼───────────────┘
                                │
                    All Connected to Same
                    Laravel Backend Database
                                │
                                ▼
                    Central PostgreSQL Instance
                    (Multi-tenancy Ready)
```

---

## File Organization

```
engineerstechbd/
│
├── mcp-server/                             ← MCP SERVER CORE
│   ├── src/
│   │   ├── index.ts                       ← Main entry point
│   │   │
│   │   ├── tools/                         ← Tool Modules
│   │   │   ├── serviceTools.ts            ├─ 3 service tools
│   │   │   ├── productTools.ts            ├─ 3 product tools
│   │   │   ├── projectTools.ts            ├─ 2 project tools
│   │   │   └── leadTools.ts               └─ 2 lead tools (7 total)
│   │   │
│   │   ├── adapters/                      ← Platform Adapters
│   │   │   ├── chatgptAdapter.ts          ├─ OpenAI integration
│   │   │   └── tencentAdapter.ts          └─ Tencent integration
│   │   │
│   │   ├── backends/                      ← Backend Integration
│   │   │   └── laravelAPI.ts              └─ Laravel HTTP client
│   │   │
│   │   ├── utils/                         ← Utilities
│   │   │   ├── logger.ts                  ├─ Winston logging
│   │   │   ├── validators.ts              ├─ Input validation
│   │   │   └── helpers.ts                 └─ Helper functions
│   │   │
│   │   └── prompts/                       ← AI Prompts
│   │       └── systemPrompts.ts           └─ System prompt templates
│   │
│   ├── tests/                             ← Test Suites
│   │   ├── unit/                          ├─ Unit tests
│   │   │   ├── laravelAPI.test.ts
│   │   │   └── validators.test.ts
│   │   └── integration/                   └─ Integration tests
│   │       ├── chatgpt.integration.test.ts
│   │       ├── tencent.integration.test.ts
│   │       └── laravel.integration.test.ts
│   │
│   ├── docker/                            ← Containerization
│   │   ├── Dockerfile                     ├─ Node 18 Alpine base
│   │   └── docker-compose.yml             └─ Full dev environment
│   │
│   ├── scripts/                           ← Deployment Scripts
│   │   ├── setup.sh                       ├─ Initial setup
│   │   ├── deploy-chatgpt.sh              ├─ ChatGPT deployment
│   │   └── deploy-tencent.sh              └─ Tencent deployment
│   │
│   ├── .github/                           ← CI/CD
│   │   └── workflows/
│   │       └── ci-cd.yml                  └─ GitHub Actions
│   │
│   ├── package.json                       ← NPM Configuration
│   ├── tsconfig.json                      ← TypeScript Config
│   ├── .env.example                       ← Environment Template
│   ├── .gitignore                         ← Git Configuration
│   ├── README.md                          ← Project README
│   └── serverless.yml                     ← Tencent Serverless Config
│
├── eTwebsitebackend/eTwebsitebackend/     ← LARAVEL BACKEND
│   ├── database/
│   │   └── migrations/
│   │       ├── ...existing...
│   │       └── 2026_06_15_000000_create_mcp_leads_table.php  ← NEW
│   │
│   ├── app/
│   │   ├── Models/
│   │   │   ├── ...existing...
│   │   │   └── MCPLead.php                ← NEW
│   │   │
│   │   └── Http/Controllers/API/
│   │       ├── ...existing...
│   │       ├── LeadController.php         ← NEW
│   │       └── RecommendationController.php ← NEW
│   │
│   ├── routes/
│   │   └── api.php                        ← Add MCP routes here
│   │
│   └── ...rest of Laravel app...
│
└── Documentation/                         ← GUIDES
    ├── SETUP_STATUS_REPORT.md            ← This summary
    ├── MULTI_PLATFORM_DEPLOYMENT_PLAN.md ← Full technical guide
    ├── DEPLOYMENT_QUICK_REFERENCE.md     ← Quick lookup
    ├── IMPLEMENTATION_CHECKLIST.md       ← Task tracking
    └── LARAVEL_API_SETUP.md              ← Backend setup
```

---

## Data Flow: Complete Journey

```
┌──────────────────────────────────────────────────────────────────┐
│                    USER INITIATES CONVERSATION                   │
│              (ChatGPT / Tencent Mini App / Claude)              │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
┌──────────────────────────────────────────────────────────────────┐
│          PLATFORM RECOGNIZES ENGINEERSTECH TOOL CALL            │
│        "I need to see services for e-commerce business"        │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
┌──────────────────────────────────────────────────────────────────┐
│           MCP SERVER RECEIVES TOOL INVOCATION                   │
│         Adapter Layer: Convert to Standard Format              │
│                                                                 │
│  ChatGPT Format → Standard MCP Format                          │
│  Tencent Format → Standard MCP Format                          │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
┌──────────────────────────────────────────────────────────────────┐
│              TOOL VALIDATION & PROCESSING                       │
│                                                                 │
│  ├─ Validate input (sanitize, check types)                    │
│  ├─ Check rate limits                                          │
│  ├─ Add request context (user_id, platform, etc)              │
│  └─ Log request                                                │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
┌──────────────────────────────────────────────────────────────────┐
│          CALL LARAVEL BACKEND API VIA HTTP                      │
│                                                                 │
│  GET /api/v1/services?category=ecommerce&limit=5              │
│  Headers: Authorization: Bearer {LARAVEL_API_KEY}              │
│           Content-Type: application/json                       │
│           X-Request-ID: {unique-id}                           │
│           X-Platform-Source: chatgpt                          │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
┌──────────────────────────────────────────────────────────────────┐
│         LARAVEL BACKEND PROCESSES REQUEST                       │
│                                                                 │
│  ├─ Authenticate API key                                       │
│  ├─ Parse & validate parameters                                │
│  ├─ Query Service model from database                          │
│  ├─ Filter by category = 'ecommerce'                           │
│  ├─ Limit to 5 results                                         │
│  ├─ Format response with metadata                              │
│  └─ Return JSON                                                │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
┌──────────────────────────────────────────────────────────────────┐
│              HTTP RESPONSE RETURNED TO MCP                      │
│                                                                 │
│  HTTP 200 OK                                                   │
│  {                                                             │
│    "data": [                                                   │
│      {                                                         │
│        "id": "srv_123",                                        │
│        "name": "E-Commerce Development",                       │
│        "description": "Custom e-commerce solutions...",        │
│        "price_from": 15000,                                    │
│        "duration": "3-6 months"                               │
│      },                                                        │
│      ...4 more...                                              │
│    ],                                                          │
│    "meta": {                                                   │
│      "total": 12,                                              │
│      "returned": 5                                             │
│    }                                                           │
│  }                                                             │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
┌──────────────────────────────────────────────────────────────────┐
│          MCP SERVER FORMATS FOR PLATFORM                        │
│                                                                 │
│  Standard MCP Format → ChatGPT Format                          │
│  Standard MCP Format → Tencent Format                          │
│  Standard MCP Format → Claude Native                          │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
┌──────────────────────────────────────────────────────────────────┐
│      PLATFORM AI CREATES USER-FRIENDLY RESPONSE                │
│                                                                 │
│  "Here are our top E-commerce development services:           │
│                                                                 │
│   1. E-Commerce Development                                   │
│      Starting at $15,000 | 3-6 months                         │
│      Custom e-commerce solutions...                            │
│                                                                 │
│   2. [Next service]                                            │
│   3. [Next service]                                            │
│   ...                                                          │
│                                                                 │
│   Would you like more details on any of these?"               │
└──────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
                            USER SEES RESULT
                           (Beautiful Format)
```

---

This architecture ensures:
- ✅ **Scalability**: Add platforms by creating new adapters only
- ✅ **Maintainability**: Tools updated once, works on all platforms
- ✅ **Consistency**: Same logic & validation everywhere
- ✅ **Performance**: Caching at multiple layers
- ✅ **Reliability**: Error handling & retry logic
- ✅ **Security**: Validation, authentication, rate limiting
