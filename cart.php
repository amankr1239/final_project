<?php
session_start();
include("db.php");

// Start cart if not set
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Add to cart
if (isset($_GET["add"])) {
    $id = $_GET["add"];
    $_SESSION["cart"][] = $id;
    echo "<script>alert('Product added to cart!'); window.location.href='index.php';</script>";
}

// Remove from cart
if (isset($_GET["remove"])) {
    $id = $_GET["remove"];
    if (($key = array_search($id, $_SESSION["cart"])) !== false) {
        unset($_SESSION["cart"][$key]);
    }
    echo "<script>alert('Item removed from cart!'); window.location.href='cart.php';</script>";
}

// Dummy product list (match with index.php)
$products = [
    1 => ["name" => "Smartphone", "price" => 7999, "image" => "images/smartphone.jpg"],
    2 => ["name" => "Wireless Headphones", "price" => 1499, "image" => "images/headphones.jpg"],
    3 => ["name" => "Bluetooth Speaker", "price" => 999, "image" => "images/speaker.jpg"]
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top-bar">
        <span>My Cart</span>
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <h2>Your Shopping Cart</h2>

    <?php
    $total = 0;
    if (count($_SESSION["cart"]) > 0):
        foreach ($_SESSION["cart"] as $id):
            $item = $products[$id];
            $total += $item["price"];
    ?>
        <div class="product-card">
            <img src="<?php echo $item['image']; ?>" alt="">
            <h3><?php echo $item['name']; ?></h3>
            <p>₹<?php echo $item['price']; ?></p>
            <a href="cart.php?remove=<?php echo $id; ?>" class="btn">Remove</a>
        </div>
    <?php
        endforeach;
    ?>
        <h3 style="clear:both; padding: 20px;">Total: ₹<?php echo $total; ?></h3>
        <a href="checkout.php" class="btn" style="margin-left: 20px;">Proceed to Checkout</a>
    <?php else: ?>
        <p style="padding: 20px;">Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>
