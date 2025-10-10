<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    if ($user === 'admin' && $pass === '123') {
        $_SESSION['user'] = $user;
        header('Location: welcome.php');
        exit;
    } else $err = "Incorrect login information.";
}
?>
<form method="post">
    Username: <input name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>
<?php if (!empty($err)) echo "<p style='color:red;'>$err</p>"; ?>