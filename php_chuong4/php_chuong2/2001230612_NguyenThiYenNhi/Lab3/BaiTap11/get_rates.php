<?php

header("Content-Type: application/json; charset=utf-8");

$base = isset($_GET['base']) ? strtoupper($_GET['base']) : 'USD';

$url = "https://open.er-api.com/v6/latest/" . urlencode($base);

// Lấy dữ liệu từ API
$response = file_get_contents($url);

if ($response === false) {
    echo json_encode([
        "ok" => false,
        "error" => "Không lấy được dữ liệu từ API"
    ]);
    exit;
}

$data = json_decode($response, true);


if (!isset($data["result"]) || $data["result"] !== "success") {
    echo json_encode([
        "ok" => false,
        "error" => "Dữ liệu API không hợp lệ"
    ]);
    exit;
}

echo json_encode([
    "ok" => true,
    "base" => $data["base_code"],
    "date" => $data["time_last_update_utc"],
    "rates" => $data["rates"]
], JSON_UNESCAPED_UNICODE);
