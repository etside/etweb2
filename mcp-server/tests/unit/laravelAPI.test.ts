import { describe, it, expect, beforeEach } from "vitest";
import { LaravelAPI } from "../backends/laravelAPI";

describe("LaravelAPI Client", () => {
  let api: LaravelAPI;

  beforeEach(() => {
    api = new LaravelAPI({
      baseUrl: "http://localhost:8000/api/v1",
      apiKey: "test-key",
      timeout: 5000,
    });
  });

  it("should create API client with correct base URL", () => {
    expect(api).toBeDefined();
  });

  it("should have get method", () => {
    expect(api.get).toBeDefined();
    expect(typeof api.get).toBe("function");
  });

  it("should have post method", () => {
    expect(api.post).toBeDefined();
    expect(typeof api.post).toBe("function");
  });

  it("should have patch method", () => {
    expect(api.patch).toBeDefined();
    expect(typeof api.patch).toBe("function");
  });

  it("should have delete method", () => {
    expect(api.delete).toBeDefined();
    expect(typeof api.delete).toBe("function");
  });
});
