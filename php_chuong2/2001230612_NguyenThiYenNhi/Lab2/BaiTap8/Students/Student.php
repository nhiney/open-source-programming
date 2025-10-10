<?php
namespace BaiTap8\Students;

require_once __DIR__ . "/../../Person.php";

class Student extends \Person {
    private $studentID;

    public function __construct($name, $age, $studentID) {
        parent::__construct($name, $age);
        $this->studentID = $studentID;
    }

    public function displayInfo() {
        parent::displayInfo();
        echo "Student ID: $this->studentID <br>";
    }
}
