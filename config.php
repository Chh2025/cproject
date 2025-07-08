<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'eventdb';
$port = 3307; // 👈 Use your custom port here

$conn = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>