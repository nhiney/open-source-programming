<?php
if (isset($_GET['r']) && is_numeric($_GET['r'])) {
    $r = (float)$_GET['r'];
    $radius = 2 * pi() * $r;
    $acreage = pi() * $r * $r;
    echo "Radius: $r<br>";
    echo "Perimeter: " . round($radius, 4) . "<br>";
    echo "Acreage: " . round($acreage, 4);
} else {
    echo "Please enter a valid radius.";
}
