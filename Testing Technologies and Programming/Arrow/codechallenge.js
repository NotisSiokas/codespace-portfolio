//Coding Task 1


// Building the function that reverses the input text
function reverseString(str){ 
    const reversedString =  str.split("").reduce((acc, char) => char + acc, ""); //splits the string and rebuilts it reversed
    console.log(reversedString); 
} 
reverseString("John"); 
reverseString("James");
reverseString("TENET");
reverseString("Notis")


//Coding Task 2 

function reverseArray(array) {
    const reversed = [];
    for (let i = array.length - 1; i >= 0; i--) {
      reversed.push(array[i]); 
    }
    return reversed;
  }

// Returned Arrays const:
const reversedNumbers = reverseArray([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
const reversedWords = reverseArray(["I", "like", "JavaScript"]);

// Reversed Arrays log:
console.log(reversedNumbers); 
console.log(reversedWords); 

// 

// Sample Data
const inventory = [
    { item: "irn bru", price: 3.25, stock: 50 },
    { item: "fanta", price: 3.98, stock: 45 },
    { item: "diet coke", price: 4.40, stock: 38 }, 
    { item: "7up", price: 3.99, stock: 42 }, 
  ];

// Function calculatin most expensive item
  const mostExpensiveItem = (inventory) => {
    let mostExpensive = null; 
    let highestCost = 0;
  
    // For loop
    for (const item of inventory) {
       // Calculate the total cost for the current item
       const totalCost = item.price * item.stock; // multiplies the price and stock from inventory
       // Check if this item is the most expensive so far:
       if (totalCost > highestCost) {
         // Update the most expensive item:
         mostExpensive = item;
         // Update the highest cost:
         highestCost = totalCost;
       }
    }
  
    return mostExpensive;
  }
    
  const mostValuableItem = mostExpensiveItem(inventory);
  console.log(mostValuableItem);
  