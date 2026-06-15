# engineersTech Multi-Platform MCP Deployment Plan
**Version**: 1.0  
**Date**: 2026-06-15  
**Scope**: OpenAI Apps SDK (ChatGPT) + Tencent Cloud Super App + Other MCP-Compatible Platforms

---

## Executive Summary

This document outlines a unified deployment strategy for engineersTech's AI-powered sales assistant across multiple platforms through a **single Model Context Protocol (MCP) Server**. The architecture enables deployment on:

1. **OpenAI ChatGPT Apps Store** (ChatGPT widget integration)
2. **Tencent Cloud Super App** (Mini App platform across Asia)
3. **Anthropic Claude** (native MCP support)
4. **Future platforms** supporting MCP specification (Slack, GitHub, etc.)

**Core Principle**: Build once as an MCP server, deploy everywhere.

---

## Architecture Overview

### The MCP Server: Universal Integration Point

```
                    ┌──────────────────────────────┐
                    │  MCP Server (Node.js/TypeScript)
                    │  ────────────────────────────│
                    │  • Tools (functions)         │
                    │  • Resources (data)          │
                    │  • Prompts (templates)       │
                    │  • State management          │
                    └──────────────┬───────────────┘
                                   │
                    ┌──────────────┴──────────────────────┐
                    │                                    │
         ┌──────────▼─────────────┐    ┌────────────────▼────────┐
         │  OpenAI Apps SDK       │    │  Tencent Cloud SDK      │
         │  ────────────────────  │    │  ────────────────────   │
         │  • ChatGPT Widget      │    │  • Mini App Runtime     │
         │  • HTTP Endpoint       │    │  • Backend API Layer    │
         │  • HTTPS + CORS        │    │  • Mobile SDKs          │
         └────────┬───────────────┘    └────────┬─────────────────┘
                  │                             │
              ChatGPT                       Tencent Cloud
              App Store                     Super App Console
                  │
         Other MCP Platforms
         (Anthropic, Slack, etc.)
                  │
                  │
         ┌────────▼──────────────┐
         │  Shared Data Layer    │
         │  ────────────────────│
         │  • Redis Cache       │
         │  • PostgreSQL DB     │
         │  • File Storage      │
         └────────┬──────────────┘
                  │
         ┌────────▼──────────────────┐
         │  Laravel Backend API      │
         │  (engineerstechbd)        │
         │  ────────────────────────│
         │  • /api/services        │
         │  • /api/products        │
         │  • /api/projects        │
         │  • /api/leads           │
         │  • /api/contact         │
         └───────────────────────────┘
```

---

## Part 1: MCP Server Architecture (Core)

### 1.1 Project Structure

```
engineersTech-MCP-Server/
├── src/
│   ├── index.ts                    # Main MCP server entry point
│   ├── mcpServer.ts               # McpServer implementation
│   ├── tools/
│   │   ├── serviceTools.ts        # Services & recommendations
│   │   ├── productTools.ts        # Product catalog & queries
│   │   ├── projectTools.ts        # Portfolio & project showcase
│   │   ├── leadTools.ts           # Lead capture & CRM integration
│   │   └── conversationTools.ts   # Context & recommendation engine
│   ├── resources/
│   │   ├── serviceResource.ts     # Service metadata & templates
│   │   ├── productResource.ts     # Product specifications
│   │   └── faqResource.ts         # FAQ & documentation
│   ├── prompts/
│   │   ├── salesPrompt.ts         # System prompt for sales assistant
│   │   ├── supportPrompt.ts       # Support assistant variations
│   │   └── techPrompt.ts          # Technical consultation template
│   ├── state/
│   │   ├── conversationState.ts   # Session & context management
│   │   ├── cache.ts               # Redis/in-memory cache
│   │   └── userProfile.ts         # User data & preferences
│   ├── backends/
│   │   ├── laravelAPI.ts          # Laravel API client
│   │   ├── tencent.ts             # Tencent Cloud integration
│   │   └── openai.ts              # OpenAI GPT integration
│   ├── adapters/
│   │   ├── chatgptAdapter.ts      # ChatGPT platform adapter
│   │   ├── tencentAdapter.ts      # Tencent Cloud adapter
│   │   └── genericAdapter.ts      # Universal MCP adapter
│   └── utils/
│       ├── logger.ts              # Logging utilities
│       ├── validators.ts          # Input validation
│       └── helpers.ts             # Shared utilities
├── package.json
├── tsconfig.json
├── .env.example
└── docker/
    ├── Dockerfile
    └── docker-compose.yml
```

### 1.2 Core MCP Server Implementation

```typescript
// src/index.ts
import { McpServer } from "@modelcontextprotocol/sdk";
import { registerServiceTools } from "./tools/serviceTools";
import { registerProductTools } from "./tools/productTools";
import { registerProjectTools } from "./tools/projectTools";
import { registerLeadTools } from "./tools/leadTools";
import { LaravelAPI } from "./backends/laravelAPI";
import { logger } from "./utils/logger";

const mcpServer = new McpServer({
  name: "engineersTech Sales Assistant",
  version: "1.0.0",
  capabilities: {
    tools: {},
    resources: {},
    prompts: {}
  }
});

// Initialize backend APIs
const laravelAPI = new LaravelAPI({
  baseUrl: process.env.LARAVEL_API_URL || "http://localhost:8000/api",
  apiKey: process.env.LARAVEL_API_KEY,
  timeout: 10000
});

// Register tool groups (same tools serve all platforms)
registerServiceTools(mcpServer, laravelAPI);
registerProductTools(mcpServer, laravelAPI);
registerProjectTools(mcpServer, laravelAPI);
registerLeadTools(mcpServer, laravelAPI);

// Initialize resources (FAQ, product specs, service catalogs)
mcpServer.setResourceTemplates([
  {
    uriTemplate: "service://{serviceId}",
    name: "Service Details",
    description: "Detailed service information"
  },
  {
    uriTemplate: "product://{productId}",
    name: "Product Info",
    description: "Product specifications and pricing"
  },
  {
    uriTemplate: "project://{projectId}",
    name: "Project Case Study",
    description: "Portfolio project details"
  }
]);

// Start MCP server (HTTP transport by default)
const PORT = process.env.MCP_PORT || 3000;
mcpServer.listen({
  transport: "stdio", // or "http" with transport options
  port: PORT
});

logger.info(`engineersTech MCP Server running on port ${PORT}`);
```

### 1.3 Tools Definition (Platform Agnostic)

```typescript
// src/tools/serviceTools.ts
import { Tool } from "@modelcontextprotocol/sdk";

export function registerServiceTools(mcpServer, laravelAPI) {
  
  // Tool 1: Get all services
  mcpServer.tool("get_services", {
    description: "Retrieve all services offered by engineersTech",
    inputSchema: {
      type: "object",
      properties: {
        category: {
          type: "string",
          description: "Filter by category (optional): development, consulting, ai, devops"
        },
        limit: {
          type: "number",
          description: "Number of results (default: 10)"
        }
      }
    }
  }, async (input) => {
    const { category, limit = 10 } = input;
    
    try {
      const response = await laravelAPI.get("/services", {
        params: { category, limit }
      });
      
      return {
        content: [
          {
            type: "text",
            text: JSON.stringify(response.data, null, 2)
          }
        ]
      };
    } catch (error) {
      return {
        content: [
          {
            type: "text",
            text: `Error fetching services: ${error.message}`
          }
        ],
        isError: true
      };
    }
  });

  // Tool 2: Get service details
  mcpServer.tool("get_service_details", {
    description: "Get detailed information about a specific service",
    inputSchema: {
      type: "object",
      properties: {
        service_id: {
          type: "string",
          description: "Service ID or slug"
        }
      },
      required: ["service_id"]
    }
  }, async (input) => {
    const { service_id } = input;
    
    try {
      const response = await laravelAPI.get(`/services/${service_id}`);
      
      return {
        content: [
          {
            type: "text",
            text: JSON.stringify(response.data, null, 2)
          }
        ]
      };
    } catch (error) {
      return {
        content: [
          {
            type: "text",
            text: `Error fetching service: ${error.message}`
          }
        ],
        isError: true
      };
    }
  });

  // Tool 3: Recommend services based on user needs
  mcpServer.tool("recommend_services", {
    description: "Recommend services based on user's business needs",
    inputSchema: {
      type: "object",
      properties: {
        business_type: {
          type: "string",
          description: "Type of business (e.g., 'ecommerce', 'saas', 'startup', 'enterprise')"
        },
        challenges: {
          type: "array",
          items: { type: "string" },
          description: "Key business challenges or needs"
        }
      },
      required: ["business_type", "challenges"]
    }
  }, async (input) => {
    const { business_type, challenges } = input;
    
    try {
      const response = await laravelAPI.post("/recommendations/services", {
        business_type,
        challenges,
        max_results: 5
      });
      
      return {
        content: [
          {
            type: "text",
            text: JSON.stringify(response.data, null, 2)
          }
        ]
      };
    } catch (error) {
      return {
        content: [
          {
            type: "text",
            text: `Error recommending services: ${error.message}`
          }
        ],
        isError: true
      };
    }
  });
}
```

### 1.4 Lead Capture Tool

```typescript
// src/tools/leadTools.ts

export function registerLeadTools(mcpServer, laravelAPI) {

  // Tool: Capture lead information
  mcpServer.tool("capture_lead", {
    description: "Capture lead contact information and conversation context",
    inputSchema: {
      type: "object",
      properties: {
        email: {
          type: "string",
          description: "Email address (required)",
          format: "email"
        },
        name: {
          type: "string",
          description: "Full name"
        },
        company: {
          type: "string",
          description: "Company name"
        },
        phone: {
          type: "string",
          description: "Phone number (optional)"
        },
        service_interest: {
          type: "string",
          description: "Service interested in"
        },
        budget_range: {
          type: "string",
          description: "Budget range (e.g., '$10k-$50k')"
        },
        conversation_summary: {
          type: "string",
          description: "Summary of conversation with user"
        },
        platform_source: {
          type: "string",
          enum: ["chatgpt", "tencent", "claude", "slack", "github", "web"],
          description: "Which platform lead came from"
        }
      },
      required: ["email"]
    }
  }, async (input) => {
    const {
      email, name, company, phone, 
      service_interest, budget_range, 
      conversation_summary, platform_source
    } = input;
    
    try {
      const response = await laravelAPI.post("/leads", {
        email,
        name: name || "Unknown",
        company: company || "Unknown",
        phone: phone || null,
        service_interest: service_interest || "Not specified",
        budget_range: budget_range || "Not specified",
        conversation_summary: conversation_summary,
        platform_source: platform_source || "mcp-server",
        status: "new"
      });
      
      return {
        content: [
          {
            type: "text",
            text: `Lead captured successfully! ID: ${response.data.id}\nWe'll follow up within 24 hours.`
          }
        ]
      };
    } catch (error) {
      return {
        content: [
          {
            type: "text",
            text: `Error capturing lead: ${error.message}`
          }
        ],
        isError: true
      };
    }
  });

  // Tool: Get lead status
  mcpServer.tool("get_lead_status", {
    description: "Check status of captured lead",
    inputSchema: {
      type: "object",
      properties: {
        lead_id: {
          type: "string",
          description: "Lead ID returned from capture_lead"
        }
      },
      required: ["lead_id"]
    }
  }, async (input) => {
    try {
      const response = await laravelAPI.get(`/leads/${input.lead_id}`);
      return {
        content: [
          {
            type: "text",
            text: JSON.stringify(response.data, null, 2)
          }
        ]
      };
    } catch (error) {
      return {
        content: [
          {
            type: "text",
            text: `Error fetching lead: ${error.message}`
          }
        ],
        isError: true
      };
    }
  });
}
```

### 1.5 System Prompts (Platform-Agnostic Templates)

```typescript
// src/prompts/salesPrompt.ts

export const SALES_ASSISTANT_PROMPT = `You are engineersTech's AI Sales Assistant, helping businesses discover software solutions.

Core Personality:
- Professional, consultative, helpful
- Ask clarifying questions before recommending
- Focus on business outcomes, not just technical specs
- Authentic and transparent about capabilities and limitations

Your Role:
1. Understand the prospect's business needs and challenges
2. Ask about their current situation, goals, and constraints
3. Recommend relevant services and products from engineersTech's catalog
4. Present case studies and examples when relevant
5. If appropriate, capture their contact information for follow-up

Available Actions:
- get_services() - List all services
- get_service_details(service_id) - Get specific service info
- recommend_services(business_type, challenges) - AI-powered recommendations
- get_products() - Show product catalog
- get_projects() - Show portfolio/case studies
- capture_lead() - Capture prospect contact info

Conversation Flow:
1. Greet warmly and ask about their business
2. Listen and understand their needs
3. Recommend 2-3 most relevant services
4. Share relevant case studies
5. Offer next steps: demo, consultation, proposal
6. Only capture lead when they show genuine interest

Important:
- NEVER pressure for sales
- ALWAYS ask permission before capturing email
- Provide value first, close second
- Be honest about project requirements and timelines
- If unsure, say "Let me find that information for you"

Guidelines:
- Keep responses concise (2-3 sentences max for each response)
- Use bullet points for lists
- Personalize based on their industry
- Reference specific case studies when relevant
`;

export const SUPPORT_ASSISTANT_PROMPT = `You are engineersTech's Support Assistant.

Focus on:
- Answering questions about existing services
- Explaining technical concepts
- Providing documentation
- Escalating to sales team when appropriate

Available Tools:
- get_services()
- get_service_details(service_id)
- get_projects() for case studies
`;

export const TECHNICAL_CONSULTANT_PROMPT = `You are engineersTech's Technical Consultant.

Focus on:
- Deep technical questions
- Architecture discussions
- Technology recommendations
- Integration planning

Available Tools:
- get_service_details()
- get_projects() for technical case studies
- recommend_services() for technical stacks
`;
```

---

## Part 2: Platform-Specific Adapters

### 2.1 OpenAI ChatGPT Apps Adapter

```typescript
// src/adapters/chatgptAdapter.ts

import express from "express";
import { MCP_RESPONSE_FORMAT } from "./types";

export class ChatGPTAdapter {
  private app: express.Application;
  private mcpServer: any;
  private salesPrompt: string;

  constructor(mcpServer: any, salesPrompt: string) {
    this.mcpServer = mcpServer;
    this.salesPrompt = salesPrompt;
    this.app = express();
    this.setupRoutes();
  }

  private setupRoutes() {
    // Health check
    this.app.get("/health", (req, res) => {
      res.json({ status: "ok", platform: "chatgpt" });
    });

    // MCP endpoint - ChatGPT calls this
    this.app.post("/mcp", async (req, res) => {
      try {
        const { method, params } = req.body;

        // Call MCP server tool
        const result = await this.mcpServer.callTool(method, params);

        res.json({
          result: result,
          success: true
        });
      } catch (error) {
        res.status(400).json({
          error: error.message,
          success: false
        });
      }
    });

    // Manifest endpoint (ChatGPT discovery)
    this.app.get("/manifest.json", (req, res) => {
      res.json({
        schema_version: "1.0.0",
        name_for_human: "engineersTech Sales Assistant",
        name_for_model: "engineerstech_sales",
        description_for_human: "AI-powered sales assistant for engineersTech",
        description_for_model: this.salesPrompt,
        auth: {
          type: "none"
        },
        api: {
          type: "openapi",
          url: `${process.env.MCP_PUBLIC_URL}/.openapi.json`,
          is_user_facing: true
        },
        logo_url: "https://engineerstechbd.com/logo.svg",
        contact_email: "sales@engineerstechbd.com",
        legal_info_url: "https://engineerstechbd.com/legal"
      });
    });

    // OpenAPI spec for ChatGPT discovery
    this.app.get("/.openapi.json", (req, res) => {
      res.json(this.generateOpenAPISpec());
    });
  }

  private generateOpenAPISpec() {
    return {
      openapi: "3.0.0",
      info: {
        title: "engineersTech Sales Assistant API",
        version: "1.0.0"
      },
      servers: [
        {
          url: process.env.MCP_PUBLIC_URL
        }
      ],
      paths: {
        "/mcp": {
          post: {
            summary: "Call MCP tool",
            requestBody: {
              content: {
                "application/json": {
                  schema: {
                    type: "object",
                    properties: {
                      method: { type: "string" },
                      params: { type: "object" }
                    }
                  }
                }
              }
            },
            responses: {
              "200": {
                description: "Tool result"
              }
            }
          }
        }
      }
    };
  }

  getApp() {
    return this.app;
  }
}
```

### 2.2 Tencent Cloud Mini App Adapter

```typescript
// src/adapters/tencentAdapter.ts

import express from "express";

export class TencentCloudAdapter {
  private app: express.Application;
  private mcpServer: any;

  constructor(mcpServer: any) {
    this.mcpServer = mcpServer;
    this.app = express();
    this.setupRoutes();
  }

  private setupRoutes() {
    // Health check
    this.app.get("/tencent/health", (req, res) => {
      res.json({ status: "ok", platform: "tencent" });
    });

    // Tencent Mini App Backend API
    this.app.post("/tencent/call-function", async (req, res) => {
      try {
        const { functionName, parameters, requestId, sessionId } = req.body;

        // Convert Tencent parameter format to MCP format
        const result = await this.mcpServer.callTool(
          this.convertTencentNameToMCP(functionName),
          parameters
        );

        res.json({
          requestId,
          sessionId,
          code: 0,
          message: "success",
          data: result
        });
      } catch (error) {
        res.status(400).json({
          code: -1,
          message: error.message
        });
      }
    });

    // Tencent Mini App Session Management
    this.app.post("/tencent/create-session", async (req, res) => {
      const sessionId = this.generateSessionId();
      
      res.json({
        code: 0,
        message: "success",
        data: {
          sessionId,
          expiresIn: 3600
        }
      });
    });

    // Tencent File Upload Handler
    this.app.post("/tencent/upload", async (req, res) => {
      // Handle file uploads from Tencent Mini App
      res.json({
        code: 0,
        message: "success",
        data: {
          fileUrl: "uploaded_file_url"
        }
      });
    });
  }

  private convertTencentNameToMCP(tencentName: string): string {
    // Convert Tencent function names to MCP tool names
    // E.g., "getServices" → "get_services"
    return tencentName
      .replace(/([A-Z])/g, "_$1")
      .toLowerCase()
      .replace(/^_/, "");
  }

  private generateSessionId(): string {
    return `tencent_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
  }

  getApp() {
    return this.app;
  }
}
```

---

## Part 3: Laravel Backend Integration

### 3.1 New API Endpoints Required

Add to `routes/api.php`:

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
    
    // Recommendations API
    Route::post('/recommendations/services', [RecommendationController::class, 'recommendServices']);
    Route::post('/recommendations/products', [RecommendationController::class, 'recommendProducts']);
    
    // FAQ API
    Route::get('/faq', 'FAQController@index');
    
});
```

### 3.2 New Models for MCP Integration

```php
<?php
// app/Models/MCPLead.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCPLead extends Model
{
    protected $table = 'mcp_leads';
    
    protected $fillable = [
        'email',
        'name',
        'company',
        'phone',
        'service_interest',
        'budget_range',
        'conversation_summary',
        'platform_source',
        'status',
        'lead_score',
        'mcp_session_id'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    public function contactSubmission()
    {
        return $this->hasOne(ContactSubmission::class, 'email', 'email');
    }
}
```

### 3.3 Database Migration

```php
<?php
// database/migrations/2026_06_15_create_mcp_leads_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mcp_leads', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('phone')->nullable();
            $table->string('service_interest')->nullable();
            $table->string('budget_range')->nullable();
            $table->longText('conversation_summary')->nullable();
            $table->enum('platform_source', [
                'chatgpt', 'tencent', 'claude', 'slack', 'github', 'web'
            ])->default('mcp-server');
            $table->enum('status', ['new', 'contacted', 'qualified', 'proposal', 'converted'])->default('new');
            $table->integer('lead_score')->default(0);
            $table->string('mcp_session_id')->nullable();
            $table->timestamps();
            
            $table->index('platform_source');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mcp_leads');
    }
};
```

---

## Part 4: Deployment Strategies

### 4.1 OpenAI ChatGPT Apps Deployment

**Step 1**: Deploy MCP Server with HTTPS

```bash
# 1. Set environment variables
export MCP_PUBLIC_URL="https://your-domain.com"
export LARAVEL_API_URL="https://engineerstechbd.com/api/v1"
export LARAVEL_API_KEY="your-api-key"

# 2. Build and start MCP Server
docker build -t engineerstech-mcp:latest .
docker run -d \
  -p 3000:3000 \
  -e MCP_PUBLIC_URL=$MCP_PUBLIC_URL \
  -e LARAVEL_API_URL=$LARAVEL_API_URL \
  --name engineerstech-mcp \
  engineerstech-mcp:latest

# 3. Setup HTTPS reverse proxy (nginx)
# Configure nginx to proxy port 3000 with SSL certificate
```

**Step 2**: Register with OpenAI

1. Go to [https://platform.openai.com/apps](https://platform.openai.com/apps)
2. Create new app
3. Point to your MCP endpoint: `https://your-domain.com/manifest.json`
4. Configure OAuth if needed (for premium features)
5. Submit for review

**Step 3**: Test in ChatGPT

```
User: "I need a software solution for my ecommerce business"
ChatGPT: [Uses MCP to call get_services(), recommend_services(), capture_lead()]
```

### 4.2 Tencent Cloud Mini App Deployment

**Step 1**: Register Tencent Cloud Account

```bash
# Get Tencent Cloud SDK
npm install @tencentcloud/sdk-scf @tencentcloud/sdk-cas

# Configure credentials
export TENCENTCLOUD_SECRET_ID="your-secret-id"
export TENCENTCLOUD_SECRET_KEY="your-secret-key"
```

**Step 2**: Deploy MCP Server to Tencent Cloud SCF (Serverless)

```bash
# Create serverless.yml
cat > serverless.yml << 'EOF'
app: engineerstech
component: scf
name: mcp-server

inputs:
  src: ./
  handler: server.handler
  runtime: nodejs18
  memorySize: 512
  timeout: 30
  environment:
    LARAVEL_API_URL: https://engineerstechbd.com/api/v1
    LARAVEL_API_KEY: your-api-key
  events:
    - http:
        path: /
        method: ALL
  network:
    vpc: your-vpc-id
    subnetId: your-subnet-id
  
# Deploy
serverless deploy
```

**Step 3**: Register Mini App in Tencent Console

1. Tencent Cloud Console → Cloud Mini Programs
2. Create new mini app
3. Configure backend API: `https://your-tencentcloud-url/tencent`
4. Upload mini app package (frontend)
5. Configure MCP Server URL
6. Submit for review

### 4.3 Other MCP Platforms (Anthropic Claude, Slack, etc.)

**Claude (Anthropic)** - Native MCP Support

```bash
# Claude desktop automatically detects MCP servers
# Add to claude_desktop_config.json:

{
  "mcpServers": {
    "engineerstech": {
      "command": "node",
      "args": ["/path/to/engineerstech-mcp/dist/index.js"],
      "env": {
        "LARAVEL_API_URL": "https://engineerstechbd.com/api/v1"
      }
    }
  }
}

# Claude will automatically call MCP tools in conversations
```

**Slack** - MCP to Slack Bot Bridge

```bash
# Slack requires a bridge app that translates between Slack events and MCP

# Use existing bridge: npm install @modelcontextprotocol/server-slack
# Or create custom bridge

npm install @slack/bolt

# Create bridge server (slack-bridge.ts)
# Routes Slack commands/messages → MCP server → Slack responses
```

---

## Part 5: Development & Testing

### 5.1 Local Development Setup

```bash
# Clone MCP server repo
git clone https://github.com/engineerstech/mcp-server.git
cd engineerstech-mcp

# Install dependencies
npm install

# Setup environment
cp .env.example .env
# Edit .env with local Laravel API URL

# Run in development mode
npm run dev

# Test with MCP Inspector
npm run test:mcp-inspector

# Test specific platform adapter
npm run test:chatgpt
npm run test:tencent
```

### 5.2 Testing MCP Tools Locally

```typescript
// test/tools.test.ts

import { MCPServer } from "../src/mcpServer";
import { LaravelAPI } from "../src/backends/laravelAPI";

describe("MCP Tools", () => {
  let mcpServer: MCPServer;
  let laravelAPI: LaravelAPI;

  beforeEach(() => {
    laravelAPI = new LaravelAPI({ baseUrl: "http://localhost:8000/api" });
    mcpServer = new MCPServer(laravelAPI);
  });

  test("get_services returns services list", async () => {
    const result = await mcpServer.callTool("get_services", {});
    expect(result.content).toBeDefined();
    expect(result.content[0].type).toBe("text");
  });

  test("recommend_services recommends relevant services", async () => {
    const result = await mcpServer.callTool("recommend_services", {
      business_type: "ecommerce",
      challenges: ["slow website", "cart abandonment"]
    });
    expect(result.content).toBeDefined();
  });

  test("capture_lead saves lead to database", async () => {
    const result = await mcpServer.callTool("capture_lead", {
      email: "test@example.com",
      name: "Test User",
      service_interest: "Custom Development",
      platform_source: "chatgpt"
    });
    expect(result.content[0].text).toContain("Lead captured");
  });
});
```

### 5.3 Integration Testing with Platforms

```bash
# Test ChatGPT integration
npm run test:chatgpt:integration

# Test Tencent integration
npm run test:tencent:integration

# Test with ngrok (local HTTPS tunnel)
ngrok http 3000
# Update MCP_PUBLIC_URL=https://your-ngrok-url.ngrok.io
# Test with actual ChatGPT/Tencent
```

---

## Part 6: Platform-Specific Configuration

### 6.1 Environment Variables by Platform

```env
# Common
NODE_ENV=production
MCP_PORT=3000
LOG_LEVEL=info

# Laravel Backend
LARAVEL_API_URL=https://engineerstechbd.com/api/v1
LARAVEL_API_KEY=your-api-key
LARAVEL_API_TIMEOUT=10000

# Cache & State
REDIS_URL=redis://localhost:6379
CACHE_TTL=3600

# OpenAI ChatGPT
OPENAI_API_KEY=sk-...
OPENAI_ORG_ID=org-...
MCP_PUBLIC_URL=https://your-domain.com
CHATGPT_ADAPTER_ENABLED=true

# Tencent Cloud
TENCENTCLOUD_SECRET_ID=your-secret-id
TENCENTCLOUD_SECRET_KEY=your-secret-key
TENCENTCLOUD_REGION=ap-beijing
TENCENTCLOUD_ADAPTER_ENABLED=true
TENCENT_SCF_FUNCTION_NAME=mcp-server

# Anthropic Claude
CLAUDE_ADAPTER_ENABLED=true

# Slack (if applicable)
SLACK_BOT_TOKEN=xoxb-...
SLACK_SIGNING_SECRET=...
SLACK_ADAPTER_ENABLED=false

# Email for lead notifications
SMTP_HOST=smtp.sendgrid.net
SMTP_PORT=587
SMTP_USER=apikey
SMTP_PASSWORD=SG.xxx
NOTIFICATION_EMAIL=sales@engineerstechbd.com
```

### 6.2 Docker Deployment Multi-Platform

```dockerfile
# Dockerfile
FROM node:18-alpine

WORKDIR /app

# Install dependencies
COPY package*.json ./
RUN npm ci --only=production

# Copy source
COPY dist ./dist
COPY config ./config

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
  CMD node -e "require('http').get('http://localhost:${MCP_PORT}/health', (r) => {if (r.statusCode !== 200) throw new Error(r.statusCode)})"

# Default to ChatGPT adapter
ENV MCP_ADAPTER=chatgpt
ENV MCP_PORT=3000

EXPOSE 3000

CMD ["node", "dist/index.js"]
```

```yaml
# docker-compose.yml for local multi-platform testing
version: '3.8'

services:
  mcp-server:
    build: .
    ports:
      - "3000:3000"
    environment:
      LARAVEL_API_URL: http://laravel:8000/api/v1
      LARAVEL_API_KEY: test-key
      MCP_ADAPTER: chatgpt
    depends_on:
      - laravel

  laravel:
    image: engineerstech-laravel:latest
    ports:
      - "8000:8000"
    environment:
      DB_CONNECTION: sqlite
      DB_DATABASE: /app/database/local.sqlite

  redis:
    image: redis:7-alpine
    ports:
      - "6379:6379"
```

---

## Part 7: Security & Compliance

### 7.1 Security Measures

```typescript
// src/security/rateLimiter.ts
import rateLimit from "express-rate-limit";

export const apiLimiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutes
  max: 100, // Limit each IP to 100 requests per windowMs
  message: "Too many requests, please try again later."
});

export const leadCaptureLimiter = rateLimit({
  windowMs: 60 * 60 * 1000, // 1 hour
  max: 10, // Max 10 lead captures per hour per IP
  skipSuccessfulRequests: true
});
```

```typescript
// src/security/validator.ts
export function validateLeadInput(input: any): void {
  if (!isValidEmail(input.email)) throw new Error("Invalid email");
  if (input.name && input.name.length > 255) throw new Error("Name too long");
  if (input.phone && !isValidPhone(input.phone)) throw new Error("Invalid phone");
  // Additional validation...
}
```

### 7.2 GDPR & Data Protection

- **Consent**: Always ask before capturing email
- **Data Retention**: Delete leads after 1 year of inactivity
- **Opt-out**: Provide easy unsubscribe mechanism
- **Encryption**: TLS 1.3 for all data in transit
- **Privacy Policy**: Link to privacy.engineerstechbd.com

---

## Part 8: Monitoring & Analytics

### 8.1 Key Metrics to Track

```typescript
// src/monitoring/analytics.ts

export interface MCPMetrics {
  // Tool usage
  toolsCalledTotal: number;
  toolCallsByName: Record<string, number>;
  toolErrorRate: number;
  
  // Lead metrics
  leadsCaptureTotalByPlatform: Record<string, number>;
  leadConversionRate: number;
  averageConversationLength: number;
  
  // Performance
  averageResponseTime: number;
  uptime: number;
  errorRate: number;
  
  // Platform usage
  usageByPlatform: Record<string, number>;
}
```

### 8.2 Logging & Error Tracking

```bash
# Docker logging
docker logs -f engineerstech-mcp

# Integration with Sentry
export SENTRY_DSN=https://xxx@sentry.io/xxx

# CloudWatch (AWS) or similar for cloud deployments
npm install aws-sdk winston-cloudwatch
```

---

## Part 9: Roadmap & Future Enhancements

| Phase | Features | Timeline |
|-------|----------|----------|
| **Phase 1** | Core MCP Server + ChatGPT Adapter | Week 1-2 |
| **Phase 2** | Tencent Cloud Adapter + Testing | Week 3-4 |
| **Phase 3** | Claude Adapter + Documentation | Week 5-6 |
| **Phase 4** | Advanced Lead Scoring + ML Recommendations | Week 7-10 |
| **Phase 5** | Slack/GitHub Integration | Week 11-12 |
| **Phase 6** | Analytics Dashboard | Week 13-14 |

---

## Part 10: Deployment Checklist

### Before Launch (ChatGPT)
- [ ] MCP server fully tested locally
- [ ] All tools return correct formats
- [ ] HTTPS endpoint working with valid certificate
- [ ] Environment variables configured correctly
- [ ] Rate limiting implemented
- [ ] Error handling comprehensive
- [ ] Logging configured
- [ ] Database migrations applied
- [ ] Lead capture working end-to-end
- [ ] OpenAI review passed

### Before Tencent Launch
- [ ] Tencent Cloud account and credentials setup
- [ ] SCF function deployed
- [ ] Mini app frontend created
- [ ] Integration tested
- [ ] Tencent security review passed

### Monitoring Post-Launch
- [ ] Daily check-in first week
- [ ] Monitor error rates
- [ ] Track lead quality
- [ ] User feedback collection
- [ ] Performance optimization

---

## Quick Start Summary

```bash
# Clone repo
git clone https://github.com/engineerstech/mcp-server.git
cd engineerstech-mcp

# Setup
npm install
cp .env.example .env
# Edit .env

# Develop
npm run dev

# Test
npm run test
npm run test:tools

# Build
npm run build

# Deploy
# ChatGPT: npm run deploy:chatgpt
# Tencent: npm run deploy:tencent
# Docker: docker build -t engineerstech-mcp . && docker push ...
```

---

**Document Version**: 1.0  
**Last Updated**: 2026-06-15  
**Maintained By**: engineersTech Engineering Team  
**Contact**: devops@engineerstechbd.com
