<?php
session_start();
include("db.php");

// Dummy products (you can later load from DB)
$products = [
    ["id" => 1, "name" => "Smartphone", "price" => 7999, "image" => "images/smartphone.jpg"],
    ["id" => 2, "name" => "Wireless Headphones", "price" => 1499, "image" => "images/headphones.jpg"],
    ["id" => 3, "name" => "Bluetooth Speaker", "price" => 999, "image" => "images/speaker.jpg"]
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Site - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="top-bar">
    <span>Welcome <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?></span>
    <a href="index.php">Home</a>
    <a href="cart.php">Cart</a>
    <a href="contact.php">Contact</a>
    <?php if (isset($_SESSION['username'])): ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
</div>

<h2>Featured Products</h2>

<?php foreach ($products as $product): ?>
    <div class="product-card">
        <img src="<?php echo $product['image']; ?>" alt="Product Image">
        <h3><?php echo $product['name']; ?></h3>
        <p>₹<?php echo $product['price']; ?></p>
        <a href="cart.php?add=<?php echo $product['id']; ?>" class="btn">Add to Cart</a>
    </div>
<?php endforeach; ?>

</body>
</html>
