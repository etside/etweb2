import express, { Express, Request, Response } from "express";
import { logger } from "../utils/logger.js";

export class TencentAdapter {
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
  }

  private setupRoutes(): void {
    // Health check
    this.app.get("/health", (req: Request, res: Response) => {
      res.json({ status: "ok", platform: "tencent", timestamp: new Date() });
    });

    // Tencent Mini App Backend API
    this.app.post("/call-function", async (req: Request, res: Response) => {
      try {
        const { functionName, parameters, requestId, sessionId } = req.body;

        logger.info("Tencent call received", { functionName });

        // Convert Tencent parameter format to MCP format
        const mcpMethodName = this.convertTencentNameToMCP(functionName);
        const result = await this.mcpServer.callTool(mcpMethodName, parameters);

        res.json({
          requestId,
          sessionId,
          code: 0,
          message: "success",
          data: result,
          timestamp: new Date(),
        });
      } catch (error) {
        logger.error("Tencent call error", error);
        res.status(400).json({
          code: -1,
          message: error instanceof Error ? error.message : "Unknown error",
          requestId: req.body.requestId,
        });
      }
    });

    // Tencent Mini App Session Management
    this.app.post("/create-session", async (req: Request, res: Response) => {
      const sessionId = this.generateSessionId();

      logger.info("Session created", { sessionId });

      res.json({
        code: 0,
        message: "success",
        data: {
          sessionId,
          expiresIn: 3600,
          timestamp: new Date(),
        },
      });
    });

    // Tencent File Upload Handler
    this.app.post("/upload", async (req: Request, res: Response) => {
      logger.info("File upload received");

      // Handle file uploads from Tencent Mini App
      res.json({
        code: 0,
        message: "success",
        data: {
          fileUrl: `https://storage.engineerstechbd.com/uploads/${Date.now()}`,
        },
      });
    });

    // Tencent App Info
    this.app.get("/app-info", (req: Request, res: Response) => {
      res.json({
        code: 0,
        data: {
          appName: "engineersTech Sales Assistant",
          appVersion: "1.0.0",
          appId: "engineerstech-mcp-tencent",
          supportedRegions: ["ap-beijing", "ap-shanghai", "ap-guangzhou"],
        },
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

  public getApp(): Express {
    return this.app;
  }
}
