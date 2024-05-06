class User {
    // Constructor: Initializes a new User object.
    constructor(firstName, lastName) {
      // Assigns the provided first name to the 'firstName' property.
      this.firstName = firstName; 
      // Assigns the provided last name to the 'lastName' property.
      this.lastName = lastName;
    }
  
    // Getter: Returns the calculated full name.
    get fullname() {
      // Combines 'firstName' and 'lastName' into a single string with a space.
      return this.firstName + " " + this.lastName;  
    }
  
   // Setter: Allows updating the full name and automatically splits it.
    set fullname(fullname) {
      // Splits the provided 'fullname' into separate first and last names
      const [newFirstName, newLastName] = fullname.split(" ");  
  
      // Updates the 'firstName' property with the extracted first name.
      this.firstName = newFirstName; 
      // Updates the 'lastName' property with the extracted last name.
      this.lastName = newLastName; 
    }
  
    // hello Method: Returns a simple greeting.
    hello() {
      return "Hello World!"; 
    } 
  }
  
  // Input variables for names
  firstName = 'Notis'; 
  lastName = 'Siokas'; 
  
  // Creates a new User object with the name "Notis Siokas".
  const user = new User(firstName, lastName);
  
  // Prints the greeting, followed by the user's first and last name.
  console.log(user.hello(), "My name is", user.firstName, user.lastName); 
  