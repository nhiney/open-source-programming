<?php

    require 'connect.php';

    $stmt = $conn->query("SELECT o.order_date, SUM(od.quantity * od.price) AS total_revenue
FROM orders o
JOIN order_details od ON o.order_id = od.order_id
GROUP BY o.order_date;");
    $products = $stmt->fetchAll((PDO::FETCH_ASSOC));

?>

<table border="1" cellpadding="5">
    <br>
    <tr>tong doanh thu tung ngay</tr>
    <tr>
        <th>ngay</th>
        <th>tong doanh thu</th>


    </tr>
    <?php foreach($products as $product): ?>
    <tr>

        <td><?=$product['order_date'] ?></td>
        <td><?=$product['total_revenue'] ?></td>


        </td>
    </tr>
    <?php endforeach; ?>


</table>