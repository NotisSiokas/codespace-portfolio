describe('MKTIME E-commerce API Tests (Users - Create & Update)', () => {
    let createdUserId;  

    it('creates a new user with valid data', () => {
        const newUserData = {
            first_name: "John",
            last_name: "Doe",
            email: `test${Date.now()}@example.com`, 
            password: "securepassword", 
            confirm_password: "securepassword", 
            street_address: "123 Test Street",
            address_line_2: "Apt 1",
            city: "TestCity",
            postal_code: "12345",
            phone_number: "+1234567890"
        };
        
        cy.request('POST', 'http://localhost:3000/api/user/register', newUserData)
            .should((response) => {
                expect(response.status).to.eq(200);
                expect(response.body).to.have.property('success', true);
                expect(response.body).to.have.property('message', 'Registration successful!');
                expect(response.body).to.have.property('userId').that.is.a('number'); 
                createdUserId = response.body.userId; // Store the created ID
            });
    });
    
    it('updates all user details with valid data', () => {

        const updatedUserData = {
            "first_name": "Updated John",
            "last_name": "Updated Doe",
            "email": `updated${Date.now()}@example.com`, // Dynamic email
            "street_address": "456 Elm Street",
            "address_line_2": "Suite 101",
            "city": "Updated City",
            "postal_code": "67890",
            "phone_number": "+15555554321"
          };

          cy.request('PUT', `http://localhost:3000/api/users/${createdUserId}`, updatedUserData)
            .then((response) => {
                expect(response.status).to.eq(200);
                expect(response.body).to.have.property('success', true);
                expect(response.body).to.have.property('message', 'User details updated successfully');
                expect(response.body.data.first_name).to.eq(updatedUserData.first_name);
                expect(response.body.data.last_name).to.eq(updatedUserData.last_name);
                // Add more assertions for the fields you're updating
  });
    });
});
