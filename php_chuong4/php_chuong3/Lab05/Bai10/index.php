<?php
// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "lab3_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Câu SQL: tính tổng số lượng và tổng doanh thu theo sản phẩm
$sql = "
SELECT *
FROM (
    SELECT 
        c.customer_id,
        c.name,
        SUM(od.quantity * od.price) AS total_spent,
        RANK() OVER (ORDER BY SUM(od.quantity * od.price) DESC) AS rank_position
    FROM customers c
    JOIN orders o ON c.customer_id = o.customer_id
    JOIN order_details od ON o.order_id = od.order_id
    GROUP BY c.customer_id, c.name
) AS ranked
WHERE rank_position <= 5;
";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Liệt kê 5 khách hàng chi tiêu nhiều nhất.</title>
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
    <h2 style="text-align:center;">Liệt kê 5 khách hàng chi tiêu nhiều nhất.</h2>
    <table>
        <tr>
            <th>Tên khách hàng</th>
            <th>Tổng chi tiêu</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                                                <td>" . number_format($row['total_spent'], 0, ',', '.') . " VND</td>
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