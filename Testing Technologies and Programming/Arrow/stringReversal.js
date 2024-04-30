//Coding Task 1

// Write a function expression called reverseString(). 
//It should accept a single argument representing a person's name. 


// Function: reverseString
// Purpose: Reverses a given input string.
function reverseString(str) { 
    // 1. Split the string into a character array:
    const characterArray = str.split(""); 
  
    // 2. Reverse the array using the 'reduce' method:
    const reversedString = characterArray.reduce((acc, char) => char + acc, "");
  
    // 3. Log the reversed string:
    console.log(reversedString); 
  }
  
  // Test Cases:
  reverseString("John");  
  reverseString("James");
  reverseString("TENET"); 
  reverseString("Notis"); 
  