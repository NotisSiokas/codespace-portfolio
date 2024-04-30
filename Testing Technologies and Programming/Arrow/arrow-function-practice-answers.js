//Below are the answers for 6 quiz questions as part of the Testing Technologies and Programming Course in CodeSpace

// Q1 Write an arrow function expression called greet(). 
// It should accept a single argument representing a person's name. 

// Answer:
const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question('What is your name: ', (name) => {
  console.log(greet(name));
  rl.close();
});

let greet = name => "Hi " + name + "!";

// Q2 Convert the function isEven() into an equivalent arrow function.

function isEven(num){
  return num % 2 === 0;
}

// Answer:

let isEven = (num) => num % 2 === 0;
  
  let result = isEven(10);
  console.log(result); 
  
// Q3 Convert the following JavaScript function declaration to arrow function syntax:

const counterFunc = (counter) => {
    if (counter > 100) {
      counter = 0;
    } else {
      counter++;
    }
    return counter;
  };
  
  // Initial counter value
  let currentCount = 0; 
  
  // Call the counter function a few times
  for (let i = 0; i < 5; i++) {
    currentCount = counterFunc(currentCount);
    console.log(currentCount); 
  }
  

// Q4 Write an arrow function for the following JavaScript function:

let nameAge = (name, age) => {
    console.log("Hello " + name);
    console.log("You are " + age + " years old");
}
  
  // Call the function with specific name and age values:
  nameAge("Notis", 25);  
  nameAge("Vasilis", 31); 

// Q5 Write the arrow function for the following:

const printOnly = () => console.log("printing");

// Q6 Write the arrow function for the following:

function sum(num1, num2) {
    return num1 + num2
}

let sum = (num1, num2) => num1 + num2;
