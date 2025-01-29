<?php
include 'config.php';
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<h1>Menu</h1>
<div class="menu">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="menu-item">
            <h3><?= $row['name'] ?></h3>
            <p>Price: TK <?= $row['price'] ?></p>
            <a href="add_to_cart.php?id=<?= $row['id'] ?>">Add to Cart</a>
        </div>
    <?php endwhile; ?>
</div>
