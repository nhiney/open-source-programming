<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    setcookie("username", $name, time() + (86400 * 30), "/");
    echo "Xin chào, $name. Tên của bạn đã được lưu!";
} elseif (isset($_COOKIE['username'])) {
    echo "Chào mừng quay lại, " . $_COOKIE['username'] . "!";
} else {
?>
    <form method="post">
        Nhập tên của bạn: <input type="text" name="name" required>
        <input type="submit" value="Lưu tên">
    </form>
<?php
}
