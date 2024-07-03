describe('MKTIME E-commerce API Tests (Users)', () => {
    beforeEach(() => {
    });
  
    describe('/api/users', () => {
      it('returns a successful response (status 200) with correct content type for GET all users', () => {
        cy.request('GET', 'http://localhost:3000/api/users')
          .should((response) => {
            expect(response.status).to.eq(200);
            expect(response.headers['content-type']).to.include('application/json');
          });
      });
  
      it('returns an array of users with correct structure for GET all users', () => {
        cy.request('GET', 'http://localhost:3000/api/users')
          .should((response) => {
            expect(response.body).to.be.an('array');
            expect(response.body[0]).to.have.any.keys(
                'id', 'first_name', 'last_name', 'email', 
                'street_address', 'address_line_2', 'city', 'postal_code', 'phone_number'
            ); 
          });
      });
      
      it('responds within an acceptable time frame (e.g., 500ms) for GET all users', () => {
        cy.request('GET', 'http://localhost:3000/api/users')
          .its('duration').should('be.lessThan', 300); 
      });
  
    //   it('returns an error response when there is a server error for GET all users', () => {
    //     cy.request({
    //       method: 'GET',
    //       url: 'http://localhost:3000/api/users',
    //       failOnStatusCode: false 
    //     }).should((response) => {
    //       expect(response.status).to.not.eq(200); 
    //       expect(response.body).to.have.property('error'); 
    //     });
    //   });
    });
  
    describe('/api/users/{id}', () => {
      it('returns a successful response (status 200) with a single user for GET by ID', () => {
        cy.request('GET', 'http://localhost:3000/api/users/1')  
          .should((response) => {
            expect(response.status).to.eq(200);
            expect(response.headers['content-type']).to.include('application/json');
            expect(response.body).to.have.any.keys(
              'id', 'first_name', 'last_name', 'email', 
              'street_address', 'address_line_2', 'city', 'postal_code', 'phone_number'
            ); 
          });
      });

      it('responds within an acceptable time frame (e.g., 500ms) for GET by ID', () => {
        cy.request('GET', 'http://localhost:3000/api/users/1')
          .its('duration').should('be.lessThan', 300);  
      });
  
      it('returns a "User not found" error for an invalid ID', () => {
        cy.request({
          method: 'GET',
          url: 'http://localhost:3000/api/users/1200392', // invalid ID
          failOnStatusCode: false
        }).should((response) => {
          expect(response.status).to.eq(404);
          expect(response.body).to.deep.equal({ error: 'User not found' }); 
        });
      });

    });

    describe('/api/users/{id} (PUT)', () => {
      let createdUserId;  
    
      it('creates a new user with valid data and updates all user details', () => {
        const newUserData = {
          first_name: "Jon 1",
          last_name: "For Update",
          email: `test${Date.now()}@example.com`, // Unique email for each test
          password: "securepassword", 
          confirm_password: "securepassword", 
          street_address: "123 Test Street",
          address_line_2: "Apt 1",
          city: "TestCity",
          postal_code: "12345",
          phone_number: "+1234567890"
        };
    
        cy.request('POST', 'http://localhost:3000/api/user/register', newUserData)
          .then((response) => {
            expect(response.status).to.eq(200);
            expect(response.body).to.have.property('success', true);
            expect(response.body).to.have.property('message', 'Registration successful!');
            createdUserId = response.body.userId; // Correctly extract userId
    
            const updatedUserData = {
              "first_name": "John",
              "last_name": "Doe",
              "email": "updated_johndoe@example.com",
              "street_address": "456 Elm Street",
              "address_line_2": "Suite 101",
              "city": "New City",
              "postal_code": "67890",
              "phone_number": "+15555554321"
            };
    
            // updating the user details
            return cy.request('PUT', `http://localhost:3000/api/users/${createdUserId}`, updatedUserData);
          })
          .then((response) => {
            expect(response.status).to.eq(200);
            expect(response.body).to.have.property('success', true);
            expect(response.body).to.have.property('message', 'User details updated successfully');
            expect(response.body.data).to.deep.equal(updatedUserData);
          });
      });
    });
    
    
    
  });
  