<?php
if (isset($_POST['score'])) {
    $s = (float)$_POST['score'];
    if ($s >= 8) $rank = "Good academic performance";
    elseif ($s >= 6.5) $rank = "Fair academic performance";
    elseif ($s >= 5) $rank = "Average academic performance";
    else $rank = "Low academic performance";
    echo "Grade: $s — Grade classification: $rank";
} else echo "Your grades have not yet been submitted..";
