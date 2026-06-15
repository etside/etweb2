import { Server, Tool } from "@modelcontextprotocol/sdk/server/index.js";
import { LaravelAPI } from "../backends/laravelAPI.js";
import { logger } from "../utils/logger.js";

export function registerProjectTools(server: Server, laravelAPI: LaravelAPI) {
  // Tool: Get projects (portfolio)
  server.setRequestHandler("tools/call", async (request) => {
    if (request.params.name === "get_projects") {
      try {
        const { category, limit = 10 } = request.params.arguments || {};

        const response = await laravelAPI.get("/projects", {
          params: { category, limit },
        });

        logger.info("get_projects called", { category, limit });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in get_projects:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error fetching projects: ${error instanceof Error ? error.message : "Unknown error"}`,
            },
          ],
          isError: true,
        };
      }
    }

    // Tool: Get project details
    if (request.params.name === "get_project_details") {
      try {
        const { project_id } = request.params.arguments || {};

        if (!project_id) {
          return {
            content: [
              {
                type: "text",
                text: "Error: project_id parameter is required",
              },
            ],
            isError: true,
          };
        }

        const response = await laravelAPI.get(`/projects/${project_id}`);

        logger.info("get_project_details called", { project_id });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in get_project_details:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error fetching project: ${error instanceof Error ? error.message : "Unknown error"}`,
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
