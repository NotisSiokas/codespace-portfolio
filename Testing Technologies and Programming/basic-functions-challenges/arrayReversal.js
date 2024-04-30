//Coding Task 2 

// Write a function expression called reverseArray(). 
//It should accept an array as a single argument. 
//It should return a reversed array and it should work for any data type.

// Example Usage:
reverseArray([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]); // Reverse an array of numbers
reverseArray(["I", "like", "JavaScript"]);     // Reverse an array of words

// Function: reverseArray
// Purpose:  Reverses the elements within a given array.
function reverseArray(array) {
  const reversed = []; // Create an empty array to store the reversed elements

  // Iterate through the input array in reverse order:
  for (let i = array.length - 1; i >= 0; i--) {
    reversed.push(array[i]); // Append the current element to the 'reversed' array
  }

  return reversed; // Return the newly created reversed array
}

// Store the results of the function calls:
const reversedNumbers = reverseArray([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
const reversedWords = reverseArray(["I", "like", "JavaScript"]);

// Log the reversed arrays to the console:
console.log(reversedNumbers); 
console.log(reversedWords); 
