import { Server } from "@modelcontextprotocol/sdk/server/index.js";
import { StdioServerTransport } from "@modelcontextprotocol/sdk/server/stdio.js";
import * as fs from "fs";
import * as path from "path";
import { fileURLToPath } from "url";
import { registerServiceTools } from "./tools/serviceTools.js";
import { registerProductTools } from "./tools/productTools.js";
import { registerProjectTools } from "./tools/projectTools.js";
import { registerLeadTools } from "./tools/leadTools.js";
import { LaravelAPI } from "./backends/laravelAPI.js";
import { logger } from "./utils/logger.js";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const server = new Server({
  name: "engineersTech Sales Assistant",
  version: "1.0.0",
});

// Initialize backend API client
const laravelAPI = new LaravelAPI({
  baseUrl: process.env.LARAVEL_API_URL || "http://localhost:8000/api/v1",
  apiKey: process.env.LARAVEL_API_KEY || "",
  timeout: parseInt(process.env.LARAVEL_API_TIMEOUT || "10000", 10),
});

// Register all tools
logger.info("Registering tools...");
registerServiceTools(server, laravelAPI);
registerProductTools(server, laravelAPI);
registerProjectTools(server, laravelAPI);
registerLeadTools(server, laravelAPI);

// Health check endpoint
server.setRequestHandler("resources/list", async () => {
  return {
    resources: [
      {
        uri: "service://all",
        name: "Services Catalog",
        description: "Complete list of engineersTech services",
        mimeType: "application/json",
      },
      {
        uri: "product://all",
        name: "Products Catalog",
        description: "Complete list of engineersTech products",
        mimeType: "application/json",
      },
      {
        uri: "project://all",
        name: "Projects Portfolio",
        description: "Case studies and completed projects",
        mimeType: "application/json",
      },
    ],
  };
});

// Resource templates
server.setResourceTemplates([
  {
    uriTemplate: "service://{serviceId}",
    name: "Service Details",
    description: "Detailed service information",
    mimeType: "application/json",
  },
  {
    uriTemplate: "product://{productId}",
    name: "Product Info",
    description: "Product specifications and pricing",
    mimeType: "application/json",
  },
  {
    uriTemplate: "project://{projectId}",
    name: "Project Case Study",
    description: "Portfolio project details and results",
    mimeType: "application/json",
  },
]);

// Start server
async function main() {
  const transport = new StdioServerTransport();
  await server.connect(transport);
  logger.info("engineersTech MCP Server started successfully");
}

main().catch((error) => {
  logger.error("Failed to start MCP server:", error);
  process.exit(1);
});
