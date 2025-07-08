<?php
session_start();
include 'config.php';
$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT e.title FROM registrations r JOIN events e ON r.event_id = e.id WHERE r.user_id = $user_id");
echo "<h2>My Events</h2>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>{$row['title']}</p>";
}
?>