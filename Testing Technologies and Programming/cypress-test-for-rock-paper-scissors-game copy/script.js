// Get the buttons
const rockBtn = document.getElementById("rock");
const paperBtn = document.getElementById("paper");
const scissorsBtn = document.getElementById("scissors");

// Get the spans
const userOptionSpan = document.getElementById("user-option");
const computerOptionSpan = document.getElementById("computer-option");
const resultSpan = document.getElementById("result");

// Define the options
const options = ["Rock", "Paper", "Scissors"];

// Add click events to the buttons

// Rock Button
rockBtn.addEventListener("click", function() {
    // Call the playGame function
    // and pass on the value of the button
    // Just for debug
    console.log(options[0]);
    playGame(options[0]);
});

// Paper Button
paperBtn.addEventListener("click", function(){
    // Call the playGame function
    // and pass on the value button
    // Just for debug
    console.log(options[1]);
    playGame(options[1])

});

// Scissors Button
scissorsBtn.addEventListener("click", function(){
    // Call the playGame function
    // and pass on the value button
    // Just for debug
    console.log(options[2]);
    playGame(options[2])

});


// Play the game function
function playGame(userOption) {
    // Just for debug
    console.log(userOption);
    
    // Set the user option
    userOptionSpan.innerHTML = userOption;

    // Get the computer option
    const computerOption = options[Math.floor(Math.random() * options.length)];
    // Just for debug
    console.log(computerOption)
    // Set the computer option
    computerOptionSpan.innerHTML = computerOption;

    // Compare the options
    // A Draw
    if (userOption === computerOption) {
        resultSpan.innerHTML= "It is a tie!"
    }
    // User win
    // Rock VS Scissors
    else if (userOption === "Rock" && computerOption === "Scissors"){
        resultSpan.innerHTML= "You win!"

    }

    // Paper VS Rock
    else if (userOption === "Paper" && computerOption === "Rock"){
        resultSpan.innerHTML= "You win!"

    }

    // Scissors VS Paper
    else if (userOption === "Scissors" && computerOption === "Paper"){
        resultSpan.innerHTML= "You win!"
    }

    // Otherwise
    // We lose...
    else {
        resultSpan.innerHTML = "You Lose!"
    }
}