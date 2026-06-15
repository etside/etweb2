import axios, { AxiosInstance, AxiosRequestConfig } from "axios";
import { logger } from "../utils/logger.js";

export interface LaravelAPIConfig {
  baseUrl: string;
  apiKey?: string;
  timeout?: number;
}

export class LaravelAPI {
  private client: AxiosInstance;
  private baseUrl: string;

  constructor(config: LaravelAPIConfig) {
    this.baseUrl = config.baseUrl;

    this.client = axios.create({
      baseURL: config.baseUrl,
      timeout: config.timeout || 10000,
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        ...(config.apiKey && { Authorization: `Bearer ${config.apiKey}` }),
      },
    });

    // Add response interceptor for error handling
    this.client.interceptors.response.use(
      (response) => response,
      (error) => {
        logger.error("Laravel API error:", {
          status: error.response?.status,
          message: error.response?.data?.message || error.message,
          url: error.config?.url,
        });
        throw error;
      }
    );
  }

  async get(endpoint: string, config?: AxiosRequestConfig) {
    logger.debug(`GET ${endpoint}`, { config });
    return this.client.get(endpoint, config);
  }

  async post(endpoint: string, data?: any, config?: AxiosRequestConfig) {
    logger.debug(`POST ${endpoint}`, { data });
    return this.client.post(endpoint, data, config);
  }

  async patch(endpoint: string, data?: any, config?: AxiosRequestConfig) {
    logger.debug(`PATCH ${endpoint}`, { data });
    return this.client.patch(endpoint, data, config);
  }

  async put(endpoint: string, data?: any, config?: AxiosRequestConfig) {
    logger.debug(`PUT ${endpoint}`, { data });
    return this.client.put(endpoint, data, config);
  }

  async delete(endpoint: string, config?: AxiosRequestConfig) {
    logger.debug(`DELETE ${endpoint}`);
    return this.client.delete(endpoint, config);
  }
}
