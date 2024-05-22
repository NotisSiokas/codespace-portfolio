/////// Guessing game script ///////


// Get elements
const tryBtn = document.getElementById("try-button");
const userGuessSpan = document.getElementById("user-guess");
const resultSpan = document.getElementById("result");

// Generate Random Number when page loads, only one time so it compares with multiples tries
const generatedNumber = Math.floor(Math.random() * 100) + 1;

// Get User guess and excecute the comparisson game
tryBtn.addEventListener("click", function () {
    const userInput = document.getElementById("user-input").value;
    const userGuess = Number(userInput);
  
    // Second level of checking for valid number, fist was HTML
    if (userGuess >= 1 && userGuess <= 100 && Number.isInteger(userGuess)) {
      userGuessSpan.textContent = userGuess;
      
      // User's comparisson with generated random number
      if (userGuess < generatedNumber) {
        resultSpan.textContent = "Try a higher number";
      } 
      else if (userGuess > generatedNumber) {
        resultSpan.textContent = "Try a lower number";
      } 
      else {
        resultSpan.textContent = "You're correct!";
      }
      
      // Clear the input box every time user tries a number
      document.getElementById("user-input").value = "";
    } else {
      resultSpan.textContent = "Please enter a valid whole number between 1 and 100";
    }
  });
