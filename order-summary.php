<?php
session_start();

$products = [
    1 => ["name" => "Smartphone", "price" => 7999, "image" => "images/smartphone.jpg"],
    2 => ["name" => "Wireless Headphones", "price" => 1499, "image" => "images/headphones.jpg"],
    3 => ["name" => "Bluetooth Speaker", "price" => 999, "image" => "images/speaker.jpg"]
];

$order = $_SESSION["order"] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Summary</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top-bar">
        <span>Order Summary</span>
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <h2>Thank you for your order!</h2>

    <?php if ($order): ?>
        <div style="padding: 20px;">
            <p><strong>Name:</strong> <?= $order["name"] ?></p>
            <p><strong>Phone:</strong> <?= $order["phone"] ?></p>
            <p><strong>Address:</strong> <?= $order["address"] ?></p>
            <p><strong>Payment Method:</strong> <?= $order["payment"] ?></p>
            <h3>Products Ordered:</h3>
            <ul>
                <?php
                $total = 0;
                foreach ($order["cart"] as $id):
                    $item = $products[$id];
                    $total += $item["price"];
                ?>
                    <li><?= $item["name"] ?> - ₹<?= $item["price"] ?></li>
                <?php endforeach; ?>
            </ul>
            <h3>Total Amount: ₹<?= $total ?></h3>
        </div>
    <?php else: ?>
        <p style="padding: 20px;">No order found.</p>
    <?php endif; ?>
</body>
</html>
