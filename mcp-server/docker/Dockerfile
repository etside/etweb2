FROM node:18-alpine

WORKDIR /app

# Install dependencies
COPY package*.json ./
RUN npm ci --only=production

# Copy built application
COPY dist ./dist

# Create logs directory
RUN mkdir -p logs

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
  CMD node -e "require('http').get('http://localhost:' + (process.env.MCP_PORT || 3000) + '/health', (r) => {if (r.statusCode !== 200) throw new Error(r.statusCode)})"

# Environment defaults
ENV NODE_ENV=production
ENV MCP_PORT=3000
ENV MCP_HOST=0.0.0.0
ENV LOG_LEVEL=info

EXPOSE 3000

CMD ["node", "dist/index.js"]
