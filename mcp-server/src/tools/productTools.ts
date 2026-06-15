import { Server, Tool } from "@modelcontextprotocol/sdk/server/index.js";
import { LaravelAPI } from "../backends/laravelAPI.js";
import { logger } from "../utils/logger.js";

export function registerProductTools(server: Server, laravelAPI: LaravelAPI) {
  // Tool: Get all products
  server.setRequestHandler("tools/call", async (request) => {
    if (request.params.name === "get_products") {
      try {
        const { category, limit = 10 } = request.params.arguments || {};

        const response = await laravelAPI.get("/products", {
          params: { category, limit },
        });

        logger.info("get_products called", { category, limit });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in get_products:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error fetching products: ${error instanceof Error ? error.message : "Unknown error"}`,
            },
          ],
          isError: true,
        };
      }
    }

    // Tool: Get product details
    if (request.params.name === "get_product_details") {
      try {
        const { product_id } = request.params.arguments || {};

        if (!product_id) {
          return {
            content: [
              {
                type: "text",
                text: "Error: product_id parameter is required",
              },
            ],
            isError: true,
          };
        }

        const response = await laravelAPI.get(`/products/${product_id}`);

        logger.info("get_product_details called", { product_id });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in get_product_details:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error fetching product: ${error instanceof Error ? error.message : "Unknown error"}`,
            },
          ],
          isError: true,
        };
      }
    }

    // Tool: Recommend products
    if (request.params.name === "recommend_products") {
      try {
        const { use_case, budget } = request.params.arguments || {};

        const response = await laravelAPI.post("/recommendations/products", {
          use_case,
          budget,
          max_results: 5,
        });

        logger.info("recommend_products called", { use_case, budget });

        return {
          content: [
            {
              type: "text",
              text: JSON.stringify(response.data, null, 2),
            },
          ],
        };
      } catch (error) {
        logger.error("Error in recommend_products:", error);
        return {
          content: [
            {
              type: "text",
              text: `Error recommending products: ${error instanceof Error ? error.message : "Unknown error"}`,
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
