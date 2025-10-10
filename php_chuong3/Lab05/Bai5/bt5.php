<?php

    require 'connect.php';

    $stmt = $conn->query("SELECT c.category_name, p.name, p.price
FROM products p
JOIN categories c ON p.category_id = c.category_id
WHERE p.price = (
SELECT MAX(p2.price)
FROM products p2
WHERE p2.category_id = p.category_id
);");
    $products = $stmt->fetchAll(mode: (PDO::FETCH_ASSOC));

?>

<table border="1" cellpadding="5">
    <br>
    <tr>
    <tr>Tìm sản phẩm có giá cao nhất trong từng loại hàng</tr>
    <tr>
        <th>Ten hang</th>
        <th>Ten san pham</th>
        <th>Gia</th>


    </tr>
    <?php foreach($products as $product): ?>
    <tr>

        <td><?=$product['category_name'] ?></td>
        <td><?=$product['name'] ?></td>
        <td><?=$product['price'] ?></td>


        </td>
    </tr>
    <?php endforeach; ?>


</table>