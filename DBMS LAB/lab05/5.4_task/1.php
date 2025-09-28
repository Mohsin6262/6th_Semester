<?php
// Define a class named Car
class Car {
    public $brand;
    public $model;

    // Constructor to initialize properties
    public function __construct($brand, $model) {
        $this->brand = $brand;
        $this->model = $model;
    }

    // Method to display car info
    public function displayInfo() {
        echo "Brand: " . $this->brand . ", Model: " . $this->model . "<br>";
    }
}

// Create objects (instances) of the Car class
$car1 = new Car("Toyota", "Camry");
$car2 = new Car("Honda", "Accord");

// Call the method
$car1->displayInfo();
$car2->displayInfo();
?>
