// Q1

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

// Q2

let isEven = (num) => num % 2 === 0;
  
  let result = isEven(10);
  console.log(result); 
  
// Q3

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
  

// Q4

let nameAge = (name, age) => {
    console.log("Hello " + name);
    console.log("You are " + age + " years old");
}
  
  // Call the function with specific name and age values:
  nameAge("Notis", 25);  
  nameAge("Vasilis", 31); 

// Q5

const printOnly = () => console.log("printing");

// Q6

function sum(num1, num2) {
    return num1 + num2
}

let sum = (num1, num2) => num1 + num2;
