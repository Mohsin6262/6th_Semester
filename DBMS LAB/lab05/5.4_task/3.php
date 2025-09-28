<?php
// Base class
class Shape {
    public function draw() {
        echo "Drawing a shape<br>";
    }
}

// Derived classes
class Circle extends Shape {
    public function draw() {
        echo "Drawing a circle<br>";
    }
}

class Square extends Shape {
    public function draw() {
        echo "Drawing a square<br>";
    }
}

// Polymorphism in action
function drawShape(Shape $shape) {
    $shape->draw();
}

$shape = new Shape();
$circle = new Circle();
$square = new Square();

drawShape($shape);
drawShape($circle);
drawShape($square);
?>
