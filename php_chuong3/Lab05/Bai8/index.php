<?php
// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "lab3_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Câu SQL: tính tổng số lượng và tổng doanh thu theo sản phẩm
$sql = "
    SELECT p.name, 
           COALESCE(SUM(od.quantity),0) AS total_quantity, 
           COALESCE(SUM(od.price * od.quantity),0) AS total_revenue
    FROM products p
    LEFT JOIN order_details od ON od.product_id = p.product_id
    GROUP BY p.product_id, p.name
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thống kê tổng số lượng và doanh thu của từng loại sản phẩm.</title>
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
    <h2 style="text-align:center;">Thống kê tổng số lượng và doanh thu của từng loại sản phẩm.</h2>
    <table>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Tổng số lượng</th>
            <th>Tổng doanh thu</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['total_quantity']}</td>
                        <td>" . number_format($row['total_revenue'], 0, ',', '.') . " đ</td>
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