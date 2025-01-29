<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Welcome, <?= $_SESSION['name'] ?>!</h1>
<a href="menu.php">View Menu</a> | <a href="cart.php">View Cart</a> | <a href="logout.php">Logout</a>
