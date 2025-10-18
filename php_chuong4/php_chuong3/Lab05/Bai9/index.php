<?php
// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "lab3_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Câu SQL: tính tổng số lượng và tổng doanh thu theo sản phẩm
$sql = "
SELECT product_id, name, total_quantity
FROM (
    SELECT 
        p.product_id,
        p.name,
        SUM(od.quantity) AS total_quantity,
        RANK() OVER (ORDER BY SUM(od.quantity) DESC) AS ranking
    FROM products p
    JOIN order_details od ON p.product_id = od.product_id
    GROUP BY p.product_id, p.name
) ranked
WHERE ranking <= 3;

";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tìm 3 sản phẩm bán chạy nhất (theo số lượng bán ra).</title>
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
    <h2 style="text-align:center;">Tìm 3 sản phẩm bán chạy nhất (theo số lượng bán ra).</h2>
    <table>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Tổng số lượng</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['total_quantity']}</td>
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