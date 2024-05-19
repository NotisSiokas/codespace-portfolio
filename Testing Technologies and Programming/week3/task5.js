// Create abstract class for User
class User {
    // Class constructor with a default username
    constructor() {
      this._username = "";
    }
  
    // Abstract method to be implemented by subclasses
    stateYourRole() {
      throw new Error("Method 'stateYourRole' must be implemented");
    }
  
    // Getter for username
    get username() {
      return this._username;
    }
  
    // Setter for username
    set username(username) {
      this._username = username;
    }
  }
  
  // Create a subclass for Admin
  class Admin extends User {
    // Implementation of the abstract method
    stateYourRole() {
      return "admin";
    }
  }
  
  // Create a subclass for Viewer
  class Viewer extends User {
    // Implementation of the abstract method
    stateYourRole() {
      return "viewer";
    }
  }
  
  // Create an object for admin
  const admin = new Admin();
  admin.username = "Balthazar";
  console.log("Admin's name: ", admin.username);
  console.log("Admin's role: ", admin.stateYourRole()); // Output: Admin's role: admin
  
  // Create an object for viewer
  const viewer = new Viewer();
  viewer.username = "Melchior";
  console.log("Viewrs's name: ", viewer.username);
  console.log("Viewer's role: ", viewer.stateYourRole()); // Output: Viewer's role: viewer