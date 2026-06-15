import { describe, it, expect } from "vitest";
import {
  isValidEmail,
  isValidPhone,
  sanitizeInput,
  validateLeadInput,
} from "../../src/utils/validators";

describe("Input Validators", () => {
  describe("isValidEmail", () => {
    it("should validate correct email addresses", () => {
      expect(isValidEmail("test@example.com")).toBe(true);
      expect(isValidEmail("user.name+tag@example.co.uk")).toBe(true);
    });

    it("should reject invalid email addresses", () => {
      expect(isValidEmail("invalid-email")).toBe(false);
      expect(isValidEmail("@example.com")).toBe(false);
      expect(isValidEmail("user@")).toBe(false);
    });
  });

  describe("isValidPhone", () => {
    it("should validate correct phone numbers", () => {
      expect(isValidPhone("123-456-7890")).toBe(true);
      expect(isValidPhone("+1 (123) 456-7890")).toBe(true);
      expect(isValidPhone("1234567890")).toBe(true);
    });

    it("should reject invalid phone numbers", () => {
      expect(isValidPhone("123")).toBe(false);
      expect(isValidPhone("")).toBe(false);
    });
  });

  describe("sanitizeInput", () => {
    it("should remove dangerous characters", () => {
      expect(sanitizeInput("<script>alert('xss')</script>")).toBe(
        "scriptalertxssscript"
      );
      expect(sanitizeInput("Normal text")).toBe("Normal text");
    });
  });

  describe("validateLeadInput", () => {
    it("should accept valid lead input", () => {
      const result = validateLeadInput({
        email: "test@example.com",
        name: "John Doe",
        company: "Acme Corp",
      });
      expect(result).toBeNull();
    });

    it("should reject missing email", () => {
      const result = validateLeadInput({
        name: "John Doe",
      });
      expect(result).toBe("Email is required");
    });

    it("should reject invalid email", () => {
      const result = validateLeadInput({
        email: "invalid-email",
      });
      expect(result).toBe("Invalid email format");
    });

    it("should reject name exceeding 255 characters", () => {
      const longName = "a".repeat(256);
      const result = validateLeadInput({
        email: "test@example.com",
        name: longName,
      });
      expect(result).toBe("Name must be less than 255 characters");
    });
  });
});
