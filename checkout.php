<?php
session_start();
include 'config.php';

$cart = $_SESSION['cart'];
$total = 0;

foreach ($cart as $id => $quantity) {
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
    $total += $product['price'] * $quantity;
}

// Save the order (you can expand this)
unset($_SESSION['cart']);
echo "Order placed successfully! Total: TK $total";
?>
