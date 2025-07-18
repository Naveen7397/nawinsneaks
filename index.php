<?php include("includes/header.php"); ?>
<?php include("includes/db.php"); ?>

<!-- Hero Banner -->
<div class="hero-banner">
    <div class="hero-text">
        <h1>NAWIN<span>SNEAKS</span></h1>
        <p>Premium Sneakers. Bold Style. Everyday Comfort.</p>
        <a href="shop.php" class="hero-btn">Shop the Collection</a>
    </div>
</div>

<!-- Categories -->
<section class="categories">
    <h2>Shop by Category</h2>
    <div class="category-grid">
        <div class="category-card">
            <img src="images/air_jordan.jpg" alt="Sneakers">
            <div class="overlay"><h3>Sneakers</h3></div>
        </div>
        <div class="category-card">
            <img src="images/asics_kayano.jpg" alt="Running">
            <div class="overlay"><h3>Running</h3></div>
        </div>
        <div class="category-card">
            <img src="images/yeezy_700.jpg" alt="Premium">
            <div class="overlay"><h3>Premium</h3></div>
        </div>
    </div>
</section>
<?php if(isset($_SESSION['user_id'])): ?>
<section class="welcome-user">
    <h2>👟 Hi <span><?= $_SESSION['user_name']; ?></span>,</h2>
    <p>Your sneaker picks are waiting for you!</p>
</section>
<?php endif; ?>


<!-- Best Sellers -->
<section class="best-sellers">
    <h2>Best Sellers</h2>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product-card">
                        <img src="images/'.$row['image'].'" alt="'.$row['name'].'">
                        <h3>'.$row['name'].'</h3>
                        <p class="brand">'.$row['brand'].'</p>
                        <p class="price">₹'.number_format($row['price']).'</p>
                        <a href="shop.php" class="view-btn">View Product</a>
                      </div>';
            }
        }
        ?>
    </div>
</section>

<!-- About Section -->
<section class="about">
    <div class="about-content">
        <h2>Why Choose NawinSneaks?</h2>
        <p>We bring you premium branded sneakers from Nike, Adidas, Yeezy, Puma & more. Every pair is 100% authentic, curated for sneakerheads who love style and comfort.</p>
    </div>
</section>

<?php include("includes/footer.php"); ?>
