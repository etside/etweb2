import { Server, Tool } from "@modelcontextprotocol/sdk/server/index.js";
import { LaravelAPI } from "../backends/laravelAPI.js";
import { logger } from "../utils/logger.js";

export function registerLeadTools(server: Server, laravelAPI: LaravelAPI) {
  // Tool: Capture lead
  server.setRequestHandler("tools/call", async (request) => {
    if (request.params.name === "capture_lead") {
      try {
        const {
          email,
          name,
          company,
          phone,
          service_interest,
          budget_range,
          conversation_summary,
          platform_source,
        } = request.params.arguments || {};

        if (!email) {
          return {
            content: [
              {
                type: "text",
                text: "Error: email parameter is required",
              },
            ],
            isError: true,
          };
        }

        // Validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          return {
            content: [
              {
                type: "text",
                text: "Error: Invalid email format",
              },
            ],
            isError: true,
          };
        }

        const response = await laravelAPI.post("/leads", {
          email,
          name: name || "Unknown",
          company: company || "Unknown",
          phone: phone || null,
          service_interest: service_interest || "Not specified",
          budget_range: budget_range || "Not specified",
          conversation_summary: conversation_summary || null,
          platform_source: platform_source || "mcp-server",
          status: "new",
        });

        logger.info("Lead captured", { email, platform_source });

        return {
          content: [
            {
              type: "text",
              text: `Lead captured successfully! ID: ${response.data.id}\nWe'll follow up within 24 hours.`,
            },
          ],
        };
      } catch (error) {
        logger.error("Error in capture_lead:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error capturing lead: ${error instanceof Error ? error.message : "Unknown error"}`,
            },
          ],
          isError: true,
        };
      }
    }

    // Tool: Get lead status
    if (request.params.name === "get_lead_status") {
      try {
        const { lead_id } = request.params.arguments || {};

        if (!lead_id) {
          return {
            content: [
              {
                type: "text",
                text: "Error: lead_id parameter is required",
              },
            ],
            isError: true,
          };
        }

        const response = await laravelAPI.get(`/leads/${lead_id}`);

        logger.info("get_lead_status called", { lead_id });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in get_lead_status:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error fetching lead: ${error instanceof Error ? error.message : "Unknown error"}`,
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
}
