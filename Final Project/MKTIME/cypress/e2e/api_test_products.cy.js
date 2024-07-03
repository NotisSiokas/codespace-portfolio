describe('MKTIME E-commerce API Tests (Products)', () => {
  
    describe('/api/products (POST)', () => {
      it('creates a new product with valid data', () => {
        const newProduct = {
          name: "New Watch Model",
          description: "A brand new watch with innovative features.",
          price: 1499.99,
          image_url: "https://www.example.com/images/new_watch.jpg",
          stock: 100
        };
  
        cy.request('POST', 'http://localhost:3000/api/products', newProduct)
          .should((response) => {
            expect(response.status).to.eq(200);
            expect(response.body).to.have.property('success', true);
            expect(response.body).to.have.property('message', 'Product created successfully');
            expect(response.body).to.have.property('product_id').that.is.a('number'); 
          });
      });
  
      it('returns an error response when creating a product with invalid data', () => {
        const invalidProduct = {
          // Missing required fields
          description: "This product is missing a name and price."
        };
  
        cy.request({
          method: 'POST',
          url: 'http://localhost:3000/api/products',
          body: invalidProduct,
          failOnStatusCode: false
        }).should((response) => {
          expect(response.status).to.eq(200); // Should return 200
          expect(response.body).to.have.property('error');
          expect(response.body.error).to.contain('Missing required field'); 
        });
      });
    });
  
    describe('/api/products/{id} (DELETE)', () => {
        let existingProductId; // Variable to store the ID of an existing product
    
        beforeEach(() => {
          // Create a new product before each test 
          const newProduct = {
            name: "Test Product",
            description: "This product is for testing delete functionality.",
            price: 99.99,
            image_url: "https://example.com/test_product.jpg",
            stock: 5
          };
    
          cy.request('POST', 'http://localhost:3000/api/products', newProduct)
            .then((response) => {
              existingProductId = response.body.product_id; 
            });
        });
    
        it('deletes a product with a valid ID', () => {
          cy.request('DELETE', `http://localhost:3000/api/products/${existingProductId}`) // Using the created product ID
            .should((response) => {
              expect(response.status).to.eq(200);
              expect(response.body).to.have.property('success', true);
              expect(response.body).to.have.property('message', 'Product deleted successfully');
            });
    
          
        });
    
        it('returns a "Product not found" error for an invalid ID', () => {
          const invalidProductId = 1233334; // Assuming this ID doesn't exist
          cy.request({
            method: 'DELETE',
            url: `http://localhost:3000/api/products/${invalidProductId}`,
            failOnStatusCode: false 
          }).should((response) => {
            expect(response.status).to.eq(200); // should return 200 not 404
            expect(response.body).to.deep.equal({ error: 'Product not found' }); 
          });
        });
    
        it('responds within an acceptable time frame (e.g., 500ms)', () => {
          cy.request('DELETE', `http://localhost:3000/api/products/${existingProductId}`)
            .its('duration').should('be.lessThan', 500); 
        });
      });
  });
  