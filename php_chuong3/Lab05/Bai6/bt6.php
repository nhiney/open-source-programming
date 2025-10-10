<?php

    require 'connect.php';

    $stmt = $conn->query("SELECT p.product_id, p.name
FROM products p
LEFT JOIN order_details od ON p.product_id = od.product_id
WHERE od.product_id IS NULL;");
    $products = $stmt->fetchAll(mode: (PDO::FETCH_ASSOC));

?>

<table border="1" cellpadding="5">
    <br>
    <tr>Liệt kê sản phẩm chưa từng được đặt hàng </tr>
    <tr>
        <th>STT</th>
        <th>Ten san pham</th>


    </tr>
    <?php foreach($products as $product): ?>
    <tr>

        <td><?=$product['product_id'] ?></td>
        <td><?=$product['name'] ?></td>


        </td>
    </tr>
    <?php endforeach; ?>


</table>