describe('Homepage Test', () => {
  it('loads the homepage', () => {
    cy.visit('/views/home.php', { failOnStatusCode: false });
    cy.title().should('contain', 'Shop Homepage - Start Bootstrap Template');
  });
});
