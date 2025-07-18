<?php
session_start();
include("includes/header.php");
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    echo "<div class='cart-empty'><p>Please <a href='login.php'>login</a> to view your cart.</p></div>";
    include("includes/footer.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.id AS cart_id, products.name, products.price, products.image, cart.quantity
        FROM cart 
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = $user_id";
$result = $conn->query($sql);
?>

<section class="cart-page">
    <h2>Your Cart 🛒</h2>

    <?php if($result->num_rows > 0): ?>
        <table class="cart-table">
            <tr>
                <th>Product</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php 
            $grand_total = 0;
            while($row = $result->fetch_assoc()): 
                $total = $row['price'] * $row['quantity'];
                $grand_total += $total;
            ?>
            <tr>
                <td><img src="images/<?= $row['image']; ?>" alt="<?= $row['name']; ?>"></td>
                <td><?= $row['name']; ?></td>
                <td>₹<?= number_format($row['price']); ?></td>
                <td><?= $row['quantity']; ?></td>
                <td>₹<?= number_format($total); ?></td>
                <td><a class="remove-btn" href="remove_from_cart.php?id=<?= $row['cart_id']; ?>">Remove</a></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <div class="cart-total">
            <h3>Grand Total: <span>₹<?= number_format($grand_total); ?></span></h3>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        </div>

    <?php else: ?>
        <div class="cart-empty"><p>Your cart is empty.</p></div>
    <?php endif; ?>
</section>

<?php include("includes/footer.php"); ?>
