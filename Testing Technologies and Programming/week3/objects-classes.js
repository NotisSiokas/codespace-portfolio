class Car {
    constructor(make, model) {
      this.make = make;
      this.model = model;
    }
  
    drive() {
      console.log('Vroom!');
    }
  }

  const myCar = new Car('Toyota', 'C-HR');
console.log(myCar.make); // Output: Toyota
myCar.drive(); // Output: Vroom!