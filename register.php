<?php
include 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Optional: Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered.";
    } else {
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'user')";
        if (mysqli_query($conn, $query)) {
            $success = "Registered successfully. <a href='login.php'>Login now</a>";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - EventEase</title>
  <style>
    body {
      background: linear-gradient(to right, #00b4db, #0083b0);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    form {
      background: white;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 450px;
      box-sizing: border-box;
    }

    h2 {
      text-align: center;
      color: #0083b0;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #0083b0;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background-color: #005f7a;
    }

    .message {
      text-align: center;
      font-size: 15px;
      margin-bottom: 15px;
    }

    .message.success {
      color: green;
    }

    .message.error {
      color: red;
    }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Register</h2>
    <?php if (!empty($error)): ?>
      <div class="message error"><?php echo $error; ?></div>
    <?php elseif (!empty($success)): ?>
      <div class="message success"><?php echo $success; ?></div>
    <?php endif; ?>
    <input type="text" name="name" placeholder="Full Name" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Register</button>
    <!-- Back to Home Link -->
  <div style="text-align: center; margin-top: 15px;">
    <a href="index.html" style="color: #0083b0; text-decoration: none; font-weight: bold;">
      ← Back to Home
    </a>
    </div>
  </form>
</body>
</html>
