// traditional function
function greet(name) {
    return "hello, my name is " + name
 }

console.log(greet("Notis"))

// traditional anonymous function

let greet1 = function(name) {
    return "hello, my name is " + name
 }

console.log(greet1("Maira"))

// arrow function
let greet2 = (name) => {
    return "hello, my name is " + name
 }

console.log(greet2("Vasilis"))

// if you have zero parameters, or more than one, you will still need the bracket
let greet3 = name => "hello, my name is " + name
console.log(greet3("Driss"))

let weather = temp => "The temperature is " + temp
console.log(weather(2))