<?php
include("includes/db.php");
session_start();

$msg = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $msg = "⚠ Email already registered!";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql)) {
            $msg = "✅ Registration successful! <a href='login.php'>Login Now</a>";
        } else {
            $msg = "❌ Something went wrong!";
        }
    }
}
?>

<?php include("includes/header.php"); ?>
<div class="form-container">
    <h2>Create Account</h2>
    <p style="color:red;"><?= $msg ?></p>
    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>
<?php include("includes/footer.php"); ?>
