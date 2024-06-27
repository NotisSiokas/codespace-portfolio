describe('User Login', () => {
    beforeEach(() => {
        cy.visit('views/login.php');
    });

    it('should successfully log in with valid credentials', () => {
        // Fill out the login form
        cy.get('#email').type('notis@mail.com');
        cy.get('#password').type('123');

        // Submit the form using the specific form ID
        cy.get('form[action="../functions/login_action.php"]').submit();

        // Assertions
        cy.url().should('include', 'views/allproducts.php');
        cy.get('.alert-success')
            .should('be.visible')
            .should('contain', 'Login successful! Welcome back!'); 
    });
});
