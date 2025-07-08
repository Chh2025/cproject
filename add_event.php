<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "INSERT INTO events (title, description) VALUES ('$title', '$description')";
    mysqli_query($conn, $query);
    echo "Event added!";
}
?>
<form method="POST">
  <input type="text" name="title" placeholder="Event Title" required>
  <textarea name="description" placeholder="Event Description"></textarea>
  <button type="submit">Add</button>
</form>