<?php
session_start();
include 'config.php';

// HTML and Styles
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Event Registration</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #7b2ff7, #f107a3);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      text-align: center;
    }

    .box {
      background: rgba(255, 255, 255, 0.15);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      max-width: 500px;
      width: 90%;
    }

    .message {
      font-size: 1.2rem;
      margin-bottom: 20px;
    }

    .message.success {
      color: #a5ffcc; /* Light Green */
    }

    .message.error {
      color: #ffaaaa; /* Light Red */
    }

    a {
      color: #b3e5ff;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s;
    }

    a:hover {
      color: #ffffff;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class='box'>
";

if (!isset($_SESSION['user_id'])) {
    echo "<p class='message error'>🔒 Please <a href='login.php'>login</a> to register for events.</p>";
    echo "</div></body></html>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['event_id'])) {
    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];

    $check = mysqli_query($conn, "SELECT * FROM registrations WHERE user_id=$user_id AND event_id=$event_id");

    if (mysqli_num_rows($check) > 0) {
        echo "<p class='message error'>⚠️<b> You have already registered for this event.</b></p>";
        echo "<p><a href='event_list.php'>⬅️ Back to Events</a></p>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO registrations (user_id, event_id) VALUES ($user_id, $event_id)");
        if ($insert) {
            echo "<p class='message success'>✅ Successfully registered for the event!</p>";
            echo "<p><a href='user_dashboard.php'>🎉 Go to Dashboard</a></p>";
        } else {
            echo "<p class='message error'>❌ Error: " . mysqli_error($conn) . "</p>";
        }
    }
} else {
    echo "<p class='message error'>🚫 Invalid request.</p>";
}

echo "
  </div>
</body>
</html>
";
?>

