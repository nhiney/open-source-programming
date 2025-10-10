<?php

    require 'connect.php';

    $stmt = $conn->query("SELECT c.customer_id, c.name, SUM(od.quantity * od.price) AS total_spent
FROM customers c
JOIN orders o ON c.customer_id = o.customer_id
JOIN order_details od ON o.order_id = od.order_id
GROUP BY c.customer_id, c.name
HAVING total_spent > 1000000;");
    $products = $stmt->fetchAll(mode: (PDO::FETCH_ASSOC));

?>

<table border="1" cellpadding="5">
    <br>
    <tr>
    <tr>Danh sách khách hàng và tổng tiền đã mua </tr>
    <tr>
        <th>ma khach hang</th>
        <th>ten khach hang</th>
        <th>tong tien mua</th>


    </tr>
    <?php foreach($products as $product): ?>
    <tr>

        <td><?=$product['customer_id'] ?></td>
        <td><?=$product['name'] ?></td>
        <td><?=$product['total_spent'] ?></td>


        </td>
    </tr>
    <?php endforeach; ?>


</table>