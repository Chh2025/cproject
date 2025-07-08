<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'] ?? 'User';
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard - EventEase</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
        <nav>
            <a href="event_list.php">All Events</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section>
            <h3>My Registered Events</h3>
            <?php
            $query = "
                SELECT e.title, e.description, e.date, e.location
                FROM registrations r
                JOIN events e ON r.event_id = e.id
                WHERE r.user_id = $user_id
            ";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='event-card'>
                            <h4>" . htmlspecialchars($row['title']) . "</h4>
                            <p>" . htmlspecialchars($row['description']) . "</p>
                            <p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>
                            <p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>
                          </div>";
                }
            } else {
                echo "<p>You have not registered for any events yet.</p>";
            }
            ?>
        </section>
    </main>
</body>
</html>
