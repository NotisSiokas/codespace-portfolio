class User {
  // Constructor: Initializes a User object with a username
  constructor(username) { 
    this._username = username; // Stores the username with a '_' prefix (common convention to indicate a private property)
  }

  // Getter for username: Provides a way to access the username property 
  get username() {
    return this._username; 
  }

  // Setter for username: Allows controlled modification of the username property
  set username(newUsername) {
    this._username = newUsername; 
  }
}

class Admin extends User { 
  // expressYourRole Method: Returns the string "Admin" to identify the role 
  expressYourRole() {
    return "Admin";
  }

  // sayHello Method: Provides a custom greeting for admin users
  sayHello() {
    return `Hello admin, ${this.username}`; 
  }
}

// Create an Admin object with the username "Balthazar"
const admin = new Admin("Balthazar");

// Call the sayHello method to display the admin greeting
console.log(admin.sayHello());  // Output: Hello admin, Balthazar 
