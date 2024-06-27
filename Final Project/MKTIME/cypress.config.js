const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: 'http://localhost:3000/',
    setupNodeEvents(on, config) {
      // Implement node event listeners here
      config.failOnStatusCode = false; // Set failOnStatusCode to false
      return config; // Return the modified config object
    }
  }
});