<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists and is an admin
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='admin'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['role'] = $admin['role'];
        $_SESSION['name'] = $admin['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid admin credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - EventEase</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 style="text-align:center;">Admin Login</h2>
    <form method="POST" action="admin.php">
        <input type="email" name="email" placeholder="Admin Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
</body>
</html>