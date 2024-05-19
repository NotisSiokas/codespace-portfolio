describe('Writing First Cypress Test 1', () => {
  it('Interacts with the website', () => {
    // 1. Visit the page (https://example.cypress.io).
    cy.visit('https://example.cypress.io');

    // 2. Query for an element (e.g. button)
    cy.get('.home-list > li:nth-child(1) > a').as('getButton');

    // 3. Interact with that element (click button)
    cy.get('@getButton').click();

    // 4. Assert about the content on the page (check if the page title changed)
    cy.url().should('include', '/commands/querying')
  });
});
