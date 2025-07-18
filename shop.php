<?php include("includes/header.php"); ?>
<section class="best-sellers">
    <h2>All Sneakers</h2>
    <div class="product-grid">
        <?php
        include("includes/db.php");
        $result = $conn->query("SELECT * FROM products");
        while($row = $result->fetch_assoc()):
        ?>
        <div class="product-card">
            <img src="images/<?= $row['image']; ?>" alt="<?= $row['name']; ?>">
            <h3><?= $row['name']; ?></h3>
            <p class="brand"><?= $row['brand']; ?></p>
            <p class="price">₹<?= number_format($row['price']); ?></p>
            <a href="add_to_cart.php?product_id=<?= $row['id']; ?>" class="view-btn">Add to Cart</a>
        </div>
        <?php endwhile; ?>
    </div>
</section>
<?php include("includes/footer.php"); ?>
