<?php
session_start(); 

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === "admin" && $pass === "123") {
        $_SESSION['user'] = $user;          
        header("Location: upload.php");      
        exit();
    } else {
        echo "Sai username hoặc password!";
    }
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Đăng nhập">
</form>
