describe('User Login', () => {
    beforeEach(() => {
        cy.visit('views/login.php');
    });

    it('should successfully log in a valid user', () => {
        // Fill out the login form (replace with your actual credentials or use environment variables)
        cy.get('#email').type('notis@mail.com');
        cy.get('#password').type('123');

        // Submit the form
        cy.get('button[type="submit"]').click();

        // Assertions
        cy.url().should('include', '/dashboard');
        cy.contains('Welcome, Test User').should('be.visible');
    });

    it('should display an error for invalid credentials', () => {
        cy.get('#email').type('wronguser@example.com');
        cy.get('#password').type('wrongpassword');

        // Submit the form
        cy.get('button[type="submit"]').click();

        // Assertions
        cy.get('.alert-danger')
            .should('be.visible')
            .should('contain', 'Invalid email or password');
    });
});
