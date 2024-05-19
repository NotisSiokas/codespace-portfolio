describe('Writing First Cypress Test 2', () => {
    it('Interacts with the email input field', () => {
      // 1. Visit the page
      cy.visit('https://example.cypress.io/commands/actions');
  
      // 2. Query for the email input field
      cy.get('.action-email').as('emailField'); 

      // 3. Type your email address
      const yourEmailAddress = 'notis@email.com'; 
      cy.get('@emailField').type(yourEmailAddress);
  
      // 4. Assert about the content of the input field
      cy.get('@emailField').should('have.value', yourEmailAddress);
    });
  });
  