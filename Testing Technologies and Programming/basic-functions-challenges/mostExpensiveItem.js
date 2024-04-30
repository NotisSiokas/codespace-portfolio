//Coding Task 3

// Write a function expression called mostExpensiveItem(). 
//It should accept an array of items as a single argument. 
//It should return the item that has the most cost tied up, calculated by the amount in stock * price.

// Test Data
[
   { item: "irn bru", price: 3.25, stock: 50 },
   { item: "fanta", price: 3.98, stock: 45 },
   { item: "diet coke", price: 4.40, stock: 38 }, 
   { item: "7up", price: 3.99, stock: 42 }, 
]


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
  