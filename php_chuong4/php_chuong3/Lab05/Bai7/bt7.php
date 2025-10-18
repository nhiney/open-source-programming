<?php

    require 'connect.php';

    $stmt = $conn->query("SELECT c.customer_id, c.name, SUM(od.quantity) AS total_items
FROM customers c
JOIN orders o ON c.customer_id = o.customer_id
JOIN order_details od ON o.order_id = od.order_id
GROUP BY c.customer_id, c.name
ORDER BY total_items DESC
LIMIT 1;");
    $products = $stmt->fetchAll(mode: (PDO::FETCH_ASSOC));

?>

<table border="1" cellpadding="5">
    <br>
    <tr>Khach hang mua nhieu san pham nhat </tr>
    <tr>
        <th>Ma Khach Hang</th>
        <th>Ten Khach Hang</th>
        <th>So luong san pham</th>


    </tr>
    <?php foreach($products as $product): ?>
    <tr>

        <td><?=$product['customer_id'] ?></td>
        <td><?=$product['name'] ?></td>
        <td><?=$product['total_items'] ?></td>



        </td>
    </tr>
    <?php endforeach; ?>


</table>