<?php
session_start();
include("includes/header.php");
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    echo "<div class='cart-empty'><p>Please <a href='login.php'>login</a> to place orders.</p></div>";
    include("includes/footer.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch cart items for this user
$sql = "SELECT cart.*, products.price FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<div class='cart-empty'><p>Your cart is empty. <a href='shop.php'>Shop now</a></p></div>";
    include("includes/footer.php");
    exit();
}

// Insert orders & clear cart
while($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $total_price = $row['price'] * $quantity;

    $conn->query("INSERT INTO orders (user_id, product_id, quantity, total_price, status)
                  VALUES ($user_id, $product_id, $quantity, $total_price, 'Processing')");
}

// Clear cart after placing orders
$conn->query("DELETE FROM cart WHERE user_id = $user_id");
?>

<section class="cart-page">
    <h2>✅ Order Placed Successfully!</h2>
    <div class="cart-total">
        <p>Thank you for shopping with <strong>NawinSneaks</strong>! 🎉</p>
        <a href="orders.php" class="checkout-btn">View Your Orders</a>
    </div>
</section>

<?php include("includes/footer.php"); ?>
