<?php
$filename = "note.txt";

if (isset($_POST['content'])) {
    $content = $_POST['content'] . "\n";
    file_put_contents($filename, $content, FILE_APPEND);
}

if (file_exists($filename)) {
    echo "<h3>Nội dung trong file:</h3>";
    echo nl2br(file_get_contents($filename));
}
?>

<form method="post">
    Nhập nội dung: <br>
    <textarea name="content" rows="4" cols="50" required></textarea><br>
    <input type="submit" value="Lưu">
</form>