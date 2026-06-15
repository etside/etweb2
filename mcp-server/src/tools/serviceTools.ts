import { Server, Tool } from "@modelcontextprotocol/sdk/server/index.js";
import { LaravelAPI } from "../backends/laravelAPI.js";
import { logger } from "../utils/logger.js";

export function registerServiceTools(server: Server, laravelAPI: LaravelAPI) {
  // Tool: Get all services
  server.setRequestHandler("tools/call", async (request) => {
    if (request.params.name === "get_services") {
      try {
        const { category, limit = 10 } = request.params.arguments || {};

        const response = await laravelAPI.get("/services", {
          params: { category, limit },
        });

        logger.info("get_services called", { category, limit });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in get_services:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error fetching services: ${error instanceof Error ? error.message : "Unknown error"}`,
            },
          ],
          isError: true,
        };
      }
    }

    // Tool: Get service details
    if (request.params.name === "get_service_details") {
      try {
        const { service_id } = request.params.arguments || {};

        if (!service_id) {
          return {
            content: [
              {
                type: "text",
                text: "Error: service_id parameter is required",
              },
            ],
            isError: true,
          };
        }

        const response = await laravelAPI.get(`/services/${service_id}`);

        logger.info("get_service_details called", { service_id });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in get_service_details:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error fetching service: ${error instanceof Error ? error.message : "Unknown error"}`,
            },
          ],
          isError: true,
        };
      }
    }

    // Tool: Recommend services
    if (request.params.name === "recommend_services") {
      try {
        const { business_type, challenges } = request.params.arguments || {};

        if (!business_type || !challenges) {
          return {
            content: [
              {
                type: "text",
                text: "Error: business_type and challenges parameters are required",
              },
            ],
            isError: true,
          };
        }

        const response = await laravelAPI.post("/recommendations/services", {
          business_type,
          challenges: Array.isArray(challenges) ? challenges : [challenges],
          max_results: 5,
        });

        logger.info("recommend_services called", {
          business_type,
          challenges,
        });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in recommend_services:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error recommending services: ${error instanceof Error ? error.message : "Unknown error"}`,
            },
          ],
          isError: true,
        };
      }
    }

    return {
      content: [
        {
          type: "text",
          text: "Unknown tool",
        },
      ],
      isError: true,
    };
  });

  // Define tools for discovery
  const tools: Tool[] = [
    {
      name: "get_services",
      description:
        "Retrieve all services offered by engineersTech with optional filtering",
      inputSchema: {
        type: "object" as const,
        properties: {
          category: {
            type: "string",
            description:
              "Filter by category (optional): development, consulting, ai, devops",
          },
          limit: {
            type: "number",
            description: "Number of results (default: 10)",
          },
        },
      },
    },
    {
      name: "get_service_details",
      description: "Get detailed information about a specific service",
      inputSchema: {
        type: "object" as const,
        properties: {
          service_id: {
            type: "string",
            description: "Service ID or slug",
          },
        },
        required: ["service_id"],
      },
    },
    {
      name: "recommend_services",
      description:
        "Recommend services based on user's business needs and challenges",
      inputSchema: {
        type: "object" as const,
        properties: {
          business_type: {
            type: "string",
            description:
              "Type of business (e.g., ecommerce, saas, startup, enterprise)",
          },
          challenges: {
            type: "array",
            items: { type: "string" },
            description: "Key business challenges or needs",
          },
        },
        required: ["business_type", "challenges"],
      },
    },
  ];

  // Register tools with server
  tools.forEach((tool) => {
    server.setRequestHandler("tools/list", async () => {
      return { tools };
    });
  });
}
