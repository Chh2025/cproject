<?php
include 'config.php';
session_start();
$result = mysqli_query($conn, "SELECT * FROM events");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Events - EventEase</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #00b4db, #0083b0);
      margin: 0;
      padding: 0;
      color: #fff;
    }

    header {
      padding: 20px;
      text-align: center;
      background: rgba(0, 0, 0, 0.3);
    }

    header h1 {
      margin: 0;
      font-size: 2.5rem;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }

    .event-card {
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .event-card:hover {
      transform: scale(1.03);
    }

    .event-card h3 {
      margin: 0 0 10px;
      color: #fff;
    }

    .event-card p {
      color: #f0f0f0;
    }

    .register-btn {
      margin-top: 15px;
      padding: 10px 20px;
      background: #ffeb3b;
      color: #333;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .register-btn:hover {
      background: #fff176;
    }
  </style>
</head>
<body>
  <header>
  <h1>Upcoming Events</h1>
  <a href="index.html" style="
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #ffffff;
    color: #0083b0;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s;
  " onmouseover="this.style.backgroundColor='#e0f7fa'" onmouseout="this.style.backgroundColor='#ffffff'">
    🔙 Back to Home
  </a>
</header>


  <div class="container">
   <?php
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "
      <div class='event-card'>
        <h3 style='font-size: 1.5rem; color: #fff; margin-bottom: 10px;'>
          🎉 " . htmlspecialchars($row['title']) . "
        </h3>
        <p style='font-size: 1rem; color: #e0f7fa; margin-bottom: 15px;'>
          " . htmlspecialchars($row['description']) . "
        </p>
    ";

    if (isset($_SESSION['user_id'])) {
      echo "
        <form method='POST' action='register_event.php'>
          <input type='hidden' name='event_id' value='{$row['id']}' />
          <button type='submit' class='register-btn' style='
            padding: 10px 25px;
            background: linear-gradient(90deg, #ffeb3b, #ffc107);
            color: #333;
            border: none;
            font-weight: bold;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
          '>✅ Register Now</button>
        </form>
      ";
    } else {
      echo "
        <div style='margin-top: 10px; font-size: 15px;'>
          <span style='color: #ffeb3b;'>🔒 Please 
            <a href='login.php' style='color: #fff; text-decoration: underline; font-weight: bold;'>login</a> 
            to register.</span>
        </div>
      ";
    }

    echo "</div>"; // Close event-card
  }
} else {
  echo "<p style='text-align:center; font-size:18px;'>🚫 No events found at the moment.</p>";
}
?>


  </div>
</body>
</html>
