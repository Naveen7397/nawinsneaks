<?php
include("includes/db.php");
session_start();

$msg = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: index.php");
            exit();
        } else {
            $msg = "❌ Wrong password!";
        }
    } else {
        $msg = "⚠ Email not registered!";
    }
}
?>

<?php include("includes/header.php"); ?>
<div class="form-container">
    <h2>Login</h2>
    <p style="color:red;"><?= $msg ?></p>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
<?php include("includes/footer.php"); ?>
