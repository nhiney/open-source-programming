<?php
// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "lab3_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Câu SQL: tính tổng số lượng và tổng doanh thu theo sản phẩm
$sql = "
SELECT p.product_id,p.name,COUNT(od.product_id) AS time_order
FROM products p
LEFT JOIN order_details od ON od.product_id = p.product_id
GROUP BY p.product_id;
";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Liệt kê tất cả sản phẩm và số lần được đặt hàng (nếu chưa đặt thì là 0).</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center;">Liệt kê tất cả sản phẩm và số lần được đặt hàng (nếu chưa đặt thì là 0).</h2>
    <table>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Tổng doanh thu</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                                                <td>" . number_format($row['time_order'], 0, ',', '.') . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php $conn->close(); ?>