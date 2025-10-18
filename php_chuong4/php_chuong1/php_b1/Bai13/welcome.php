<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
echo "Hallo, " . htmlspecialchars($_SESSION['user']);
echo "<p><a href='logout.php'>Logout</a></p>";
