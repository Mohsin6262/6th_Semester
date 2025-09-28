<?php
// Base class (Parent)
class Animal {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function sound() {
        echo "Some generic sound<br>";
    }
}

// Derived class (Child) inheriting from Animal
class Dog extends Animal {
    // Overriding the sound method
    public function sound() {
        echo $this->name . " says: Woof!<br>";
    }
}

$genericAnimal = new Animal("Animal");
$genericAnimal->sound();

$dog = new Dog("Buddy");
$dog->sound();
?>
