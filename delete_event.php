<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM events WHERE id = $id");
}
$result = mysqli_query($conn, "SELECT * FROM events");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<form method='POST'><input type='hidden' name='id' value='{$row['id']}'><p>{$row['title']} <button type='submit'>Delete</button></p></form>";
}
?>