describe('User Registration', () => {
    beforeEach(() => {
        cy.visit('views/register.php');
    });

    it('should successfully register a new user', () => {
        // Fill out the registration form
        cy.get('#first_name').type('Test');
        cy.get('#last_name').type('User');

        // Generate a unique email to avoid conflicts
        const randomEmail = `testuser${Math.floor(Math.random() * 10000)}@example.com`;
        cy.get('#email').type(randomEmail);

        cy.get('#password').type('password123');
        cy.get('#confirm_password').type('password123');

        cy.get('#street_address').type('123 Main St');
        cy.get('#city').type('Anytown');
        cy.get('#postal_code').type('12345');
        cy.get('#phone_number').type('123-456-7890');

        // Submit the form
        cy.get('form[action="../controllers/UserController.php?action=register"] button[type="submit"]').click();

        // Assertions
        cy.get('.alert-success')
            .should('be.visible')
            .should('contain', 'Registration successful!');
    });
});
