<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    $user_id = $_SESSION['user_id'];

    // Check if already in cart
    $check = $conn->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=?");
    $check->bind_param("ii", $user_id, $product_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Update quantity
        $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id=$user_id AND product_id=$product_id");
    } else {
        // Insert new item
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?,?,1)");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    }

    header("Location: cart.php");
}
?>
