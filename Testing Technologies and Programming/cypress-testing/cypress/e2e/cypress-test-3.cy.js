describe('Writing First Cypress Test 3', () => {
    it('Interacts with action button and canvas', () => {
      // 1. Visit this page (https://example.cypress.io/commands/actions)
      cy.visit('https://example.cypress.io/commands/actions');
  
      // 2. Query for the action button with a class ".action-btn" and click on it
      cy.get('.action-btn').click();
  
      // 3. Query for the element with an id "#action-canvas" and click on it
      cy.get('#action-canvas').click();
  
      // 4. Query for the element with an id "#action-canvas" and click on the "topLeft"
      cy.get('#action-canvas').click('topLeft');
  
      // 5. Query for the element with an id "#action-canvas" and click on the "bottomRight"
      cy.get('#action-canvas').click('bottomRight');
    });
  });
  