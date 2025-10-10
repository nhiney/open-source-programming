<?php
function toUpperCase($str)
{
    return strtoupper($str);
}

if (isset($_POST['text'])) {
    $text = $_POST['text'];
    echo "Chuỗi viết hoa: " . toUpperCase($text);
}
?>

<form method="post">
    Nhập chuỗi: <input type="text" name="text" required>
    <input type="submit" value="Chuyển thành chữ hoa">
</form>