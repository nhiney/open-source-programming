<?php

    require 'connect.php';

    $stmt = $conn->query("SELECT c.category_name, COUNT(p.product_id) AS total_products
FROM categories c
LEFT JOIN products p ON c.category_id = p.category_id
GROUP BY c.category_name;");
    $products = $stmt->fetchAll(mode: (PDO::FETCH_ASSOC));

?>

<table border="1" cellpadding="5">
    <br>
    <tr>Thống kê số lượng sản phẩm trong từng loại hàng</tr>
    <tr>
        <th>phone</th>
        <th>so luong</th>


    </tr>
    <?php foreach($products as $product): ?>
    <tr>

        <td><?=$product['category_name'] ?></td>
        <td><?=$product['total_products'] ?></td>


        </td>
    </tr>
    <?php endforeach; ?>


</table>