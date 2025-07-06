<?php
session_start();
include("db.php");

// Sample product data (match with index.php/cart.php)
$products = [
    1 => ["name" => "Smartphone", "price" => 7999],
    2 => ["name" => "Wireless Headphones", "price" => 1499],
    3 => ["name" => "Bluetooth Speaker", "price" => 999]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST["name"];
    $phone   = $_POST["phone"];
    $address = $_POST["address"];
    $payment = $_POST["payment"];
    $cart    = $_SESSION["cart"] ?? [];

    // Calculate total
    $total = 0;
    foreach ($cart as $id) {
        if (isset($products[$id])) {
            $total += $products[$id]["price"];
        }
    }

    $product_ids = implode(",", $cart);

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (user_name, phone, address, payment_method, product_ids, total_price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssd", $name, $phone, $address, $payment, $product_ids, $total);
    $stmt->execute();
    $stmt->close();

    // Store in session for summary
    $_SESSION["order"] = [
        "name" => $name,
        "phone" => $phone,
        "address" => $address,
        "payment" => $payment,
        "cart" => $cart
    ];

    $_SESSION["cart"] = []; // clear cart

    echo "<script>alert('Order Placed Successfully!'); window.location.href='order-summary.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top-bar">
        <span>Checkout</span>
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>

    <h2>Shipping & Payment Details</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="phone" placeholder="Mobile Number" required>
        <textarea name="address" placeholder="Delivery Address" required></textarea>
        <select name="payment" required>
            <option value="">Select Payment Method</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
            <option value="UPI">UPI</option>
            <option value="Credit/Debit Card">Credit/Debit Card</option>
        </select>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
