<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $cart_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    $conn->query("DELETE FROM cart WHERE id=$cart_id AND user_id=$user_id");
}

header("Location: cart.php");
?>
