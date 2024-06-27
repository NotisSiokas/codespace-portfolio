describe('User Logout', () => {
    beforeEach(() => {
      // Log in before each test
      cy.visit('views/login.php');
      cy.get('#email').type('notis@mail.com');
      cy.get('#password').type('123');
      cy.get('form[action="../functions/login_action.php"]').submit();
    
  
      // Verify login success 
      cy.url().should('include', 'views/allproducts.php');
    });
  
    it('should successfully log out and redirect to login page', () => {
      // Simulate logout action 
      cy.get('a').contains('Logout').click();
  
      // Verify redirection to the login page
      cy.url().should('include', 'views/login.php');
  
      // Verify the login form is visible
      cy.get('#email').should('be.visible');
      cy.get('#password').should('be.visible');
    });
  });
  