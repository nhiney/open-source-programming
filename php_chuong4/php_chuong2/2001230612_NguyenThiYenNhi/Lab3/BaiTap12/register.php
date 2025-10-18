<?php
$host = "localhost";
$user = "root";     
$pass = "";         
$db   = "lab3";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($username == '' || $email == '' || $password == '') {
    die("Vui lòng nhập đầy đủ thông tin.");
}

$hashed = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed);

if ($stmt->execute()) {
    echo "<h3>Đăng ký thành công!</h3>";
    echo "<a href='register.html'>Quay lại</a>";
} else {
    echo "Lỗi: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
