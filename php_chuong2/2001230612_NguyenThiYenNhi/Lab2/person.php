<?php
class Person {
    protected $name;
    protected $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age  = $age;
    }

    public function displayInfo() {
        echo "Name: $this->name, Age: $this->age <br>";
    }
}
