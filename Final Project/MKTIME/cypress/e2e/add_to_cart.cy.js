describe('Adding Products to Cart with Login', () => {
    beforeEach(() => {
      // Visit the login page before each test
      cy.visit('views/login.php');
    });
  
    it('should add a product to the cart after successful login', () => {
      // Login using valid credentials
      cy.get('#email').type('notis@mail.com');
      cy.get('#password').type('123');
      cy.get('form[action="../functions/login_action.php"]').submit();
  
      // Verify successful login 
      cy.url().should('include', 'views/allproducts.php');
      cy.get('.alert-success')
        .should('be.visible')
        .should('contain', 'Login successful! Welcome back!');
  
      // Proceed with adding a product to the cart
      cy.get('.card a[href*="../functions/added.php"]').first().click();
  
      // Verify success message on added_success.php
      cy.get('.alert-success') 
        .should('be.visible')
        .should('contain', 'has been added to your cart'); 
  
      // Click "Continue Shopping" button
      cy.get('a[href="../views/allproducts.php"]').click();
  
  
      
    });
  });
  