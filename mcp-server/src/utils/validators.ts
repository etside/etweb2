export function isValidEmail(email: string): boolean {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

export function isValidPhone(phone: string): boolean {
  // Basic phone validation - can be customized per country
  const phoneRegex = /^[\d\s\-\+\(\)]{7,}$/;
  return phoneRegex.test(phone);
}

export function sanitizeInput(input: string): string {
  // Remove potentially dangerous characters
  return input.replace(/[<>\"']/g, "");
}

export function validateLeadInput(input: any): string | null {
  if (!input.email) return "Email is required";
  if (!isValidEmail(input.email)) return "Invalid email format";
  if (input.name && input.name.length > 255)
    return "Name must be less than 255 characters";
  if (input.phone && !isValidPhone(input.phone)) return "Invalid phone format";
  if (
    input.company &&
    input.company.length > 255
  )
    return "Company must be less than 255 characters";
  return null;
}
