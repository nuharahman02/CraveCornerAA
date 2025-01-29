<?php
session_start();
include 'config.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<h1>Cart</h1>
<table>
    <tr><th>Item</th><th>Quantity</th><th>Price</th></tr>
    <?php foreach ($cart as $id => $quantity): 
        $sql = "SELECT * FROM products WHERE id=$id";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();
        $total += $product['price'] * $quantity;
    ?>
        <tr>
            <td><?= $product['name'] ?></td>
            <td><?= $quantity ?></td>
            <td>TK <?= $product['price'] * $quantity ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p>Total: TK <?= $total ?></p>
<a href="checkout.php">Checkout</a>
