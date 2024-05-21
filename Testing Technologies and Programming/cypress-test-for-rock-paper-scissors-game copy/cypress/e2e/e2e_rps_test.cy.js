// e2e test for Rock Paper Scissors game

describe('Rock Paper Scissors Game', () => {
  beforeEach(() => {
    cy.visit('index.html'); 
  });

  it('loads the index file and displays the basic UI elements', () => {
    // Check if the title is correct
    cy.title().should('eq', 'RPS Game');

    // Check if the buttons are present
    cy.get('.options').should('exist');
    cy.get('#rock').should('exist').and('have.text', 'Rock');
    cy.get('#paper').should('exist').and('have.text', 'Paper');
    cy.get('#scissors').should('exist').and('have.text', 'Scissors');

    // Check if the result display areas are present
    cy.get('#user-option').should('exist');
    cy.get('#computer-option').should('exist');
    cy.get('#result').should('exist');
  });
  
  it('should display "Rock" when the Rock button is clicked', () => {
    cy.get('#rock').click();
    cy.get('#user-option').should('have.text', 'Rock');
  });

  it('should display "Paper" when the Paper button is clicked', () => {
    cy.get('#paper').click();
    cy.get('#user-option').should('have.text', 'Paper');
  });

  it('should display "Scissors" when the Scissors button is clicked', () => {
    cy.get('#scissors').click();
    cy.get('#user-option').should('have.text', 'Scissors');
  });

  it('should display initial state correctly', () => {
    cy.get('#user-option').should('have.text', '');
    cy.get('#computer-option').should('have.text', '');
    cy.get('#result').should('have.text', '');
  });

  const options = ['Rock', 'Paper', 'Scissors'];
  options.forEach(option => {
    it(`should play a round when ${option} is clicked`, () => {
      cy.get(`#${option.toLowerCase()}`).click();
      cy.get('#user-option').should('have.text', option);
      cy.get('#computer-option').should('not.have.text', ''); 
      cy.get('#result').should('not.have.text', ''); 

      cy.get('#computer-option').should('not.have.text', '');
      cy.get('#result').should('not.have.text', '');
    });
  });
});