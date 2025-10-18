<?php
if (isset($_FILES['avatar'])) {
    $f = $_FILES['avatar'];
    if ($f['error'] === 0) {
        $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($ext), $allowed)) {
            echo "Only images are allowed.";
            exit;
        }
        $target = 'uploads/' . time() . "_" . basename($f['name']);
        if (move_uploaded_file($f['tmp_name'], $target)) {
            echo "Upload su!<br>";
            echo "<img src='$target' style='max-width:300px;'>";
        } else echo "Unable to move the file.";
    } else echo "Upload error: " . $f['error'];
} else echo "No file was sent.";
