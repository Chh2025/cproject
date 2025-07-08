<?php
include 'config.php';
$query = "SELECT u.name, e.title FROM registrations r JOIN users u ON r.user_id = u.id JOIN events e ON r.event_id = e.id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>{$row['name']} registered for {$row['title']}</p>";
}
?>
