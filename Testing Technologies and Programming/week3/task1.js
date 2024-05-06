// User Class Definition
class User {
    // Constructor: Initializes a new User object 
    constructor(firstName, lastName) {
      // Combines the provided first and last names into a single username
      this.username = firstName + " " + lastName;
    }
  
    // hello Method: Provides a greeting using the stored username
    hello() {
      console.log(`hello, ${this.username}`); // Logs the greeting to the console
    }
  }
  
  // Input variables for names
  firstName = 'John'
  lastName = 'Doe'
  
  // Create a User object with the name "John Doe"
  const user1 = new User(firstName, lastName); 
  
  // Create another User object with the name "Jane Doe"
  const user2 = new User("Jane", lastName);
  
  // Call the 'hello' method for each User object
  user1.hello(); // Output: hello, John Doe
  user2.hello(); // Output: hello, Jane Doe
  