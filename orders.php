<?php
session_start();
include("includes/header.php");
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    echo "<div class='cart-empty'><p>Please <a href='login.php'>login</a> to view your orders.</p></div>";
    include("includes/footer.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT orders.*, products.name AS product_name, products.image 
        FROM orders 
        JOIN products ON orders.product_id = products.id
        WHERE orders.user_id = $user_id
        ORDER BY orders.ordered_at DESC";
$result = $conn->query($sql);
?>

<section class="orders-page">
    <h2>Your Orders</h2>
    <?php if ($result->num_rows > 0): ?>
        <table class="orders-table">
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Ordered At</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><img src="images/<?= $row['image']; ?>" alt="<?= $row['product_name']; ?>"></td>
                <td><?= $row['product_name']; ?></td>
                <td><?= $row['quantity']; ?></td>
                <td>₹<?= number_format($row['total_price']); ?></td>
                <td>
                    <span class="status <?= strtolower($row['status']); ?>">
                        <?= $row['status']; ?>
                    </span>
                </td>
                <td><?= date("d M Y, h:i A", strtotime($row['ordered_at'])); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <div class="cart-empty">
            <p>No orders found. <a href="shop.php">Shop now</a></p>
        </div>
    <?php endif; ?>
</section>

<?php include("includes/footer.php"); ?>
