<?php

spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    require_once __DIR__ . "/" . $class . ".php";
});

use BaiTap8\Students\Student;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age  = $_POST["age"];
    $id   = $_POST["studentID"];

    $student = new Student($name, $age, $id);

    echo "<h2>Kết quả</h2>";
    $student->displayInfo();
}
