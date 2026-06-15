import express, { Express, Request, Response } from "express";
import cors from "cors";
import { logger } from "../utils/logger.js";

export class ChatGPTAdapter {
  private app: Express;
  private mcpServer: any;

  constructor(mcpServer: any) {
    this.mcpServer = mcpServer;
    this.app = express();
    this.setupMiddleware();
    this.setupRoutes();
  }

  private setupMiddleware(): void {
    this.app.use(express.json());
    this.app.use(
      cors({
        origin: process.env.CORS_ORIGIN?.split(",") || ["http://localhost:3000"],
        credentials: true,
      })
    );

    // Logging middleware
    this.app.use((req: Request, res: Response, next) => {
      logger.debug(`${req.method} ${req.path}`);
      next();
    });
  }

  private setupRoutes(): void {
    // Health check
    this.app.get("/health", (req: Request, res: Response) => {
      res.json({ status: "ok", platform: "chatgpt", timestamp: new Date() });
    });

    // Manifest endpoint (ChatGPT discovery)
    this.app.get("/.well-known/manifest.json", (req: Request, res: Response) => {
      res.json({
        schema_version: "1.0.0",
        name_for_human: "engineersTech Sales Assistant",
        name_for_model: "engineerstech_sales_assistant",
        description_for_human:
          "AI-powered sales assistant helping you find the perfect software solution for your business",
        description_for_model:
          "You are engineersTech AI Sales Assistant. Help users discover relevant services and products. Always ask about their business needs before recommending. Be consultative, not pushy.",
        auth: {
          type: "none",
        },
        api: {
          type: "openapi",
          url: `${process.env.MCP_PUBLIC_URL || "http://localhost:3000"}/.openapi.json`,
          is_user_facing: true,
        },
        logo_url: "https://engineerstechbd.com/logo.svg",
        contact_email: "sales@engineerstechbd.com",
        legal_info_url: "https://engineerstechbd.com/legal",
      });
    });

    // OpenAPI spec
    this.app.get("/.openapi.json", (req: Request, res: Response) => {
      res.json(this.generateOpenAPISpec());
    });

    // MCP endpoint - ChatGPT calls this
    this.app.post("/mcp", async (req: Request, res: Response) => {
      try {
        const { method, params } = req.body;

        logger.info("MCP call received", { method });

        // Call MCP server tool
        const result = await this.mcpServer.callTool(method, params);

        res.json({
          result: result,
          success: true,
          timestamp: new Date(),
        });
      } catch (error) {
        logger.error("MCP call error", error);
        res.status(400).json({
          error: error instanceof Error ? error.message : "Unknown error",
          success: false,
        });
      }
    });

    // 404 handler
    this.app.use((req: Request, res: Response) => {
      res.status(404).json({ error: "Not found" });
    });
  }

  private generateOpenAPISpec() {
    return {
      openapi: "3.0.0",
      info: {
        title: "engineersTech Sales Assistant API",
        version: "1.0.0",
        description: "AI-powered sales assistant for engineersTech",
      },
      servers: [
        {
          url: process.env.MCP_PUBLIC_URL || "http://localhost:3000",
        },
      ],
      paths: {
        "/health": {
          get: {
            summary: "Health check",
            responses: {
              "200": {
                description: "Server is healthy",
              },
            },
          },
        },
        "/mcp": {
          post: {
            summary: "Call MCP tool",
            requestBody: {
              required: true,
              content: {
                "application/json": {
                  schema: {
                    type: "object",
                    properties: {
                      method: { type: "string" },
                      params: { type: "object" },
                    },
                    required: ["method"],
                  },
                },
              },
            },
            responses: {
              "200": {
                description: "Tool executed successfully",
              },
              "400": {
                description: "Error executing tool",
              },
            },
          },
        },
      },
    };
  }

  public getApp(): Express {
    return this.app;
  }
}
