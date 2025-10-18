<?php
$students = [
    ["name" => "Nguyen Van A", "score" => 7.5],
    ["name" => "Nguyen Van B", "score" => 8.9],
    ["name" => "Le Van C", "score" => 9.2],
    ["name" => "Pham Thi D", "score" => 8.0],
];

function findTopStudent($students)
{
    $top = $students[0];
    foreach ($students as $student) {
        if ($student["score"] > $top["score"]) {
            $top = $student;
        }
    }
    return $top;
}

$topStudent = findTopStudent($students);
echo "Sinh viên có điểm cao nhất: " . $topStudent["name"] . " - Điểm: " . $topStudent["score"];
