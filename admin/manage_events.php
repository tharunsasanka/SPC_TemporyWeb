<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
require '../config/db.php';

// Handle Add Event
if (isset($_POST['add_event'])) {
    $title = $_POST['title'];
    $date = $_POST['event_date'];
    $type = $_POST['type'];
    $desc = $_POST['description'];
    
    $sql = "INSERT INTO events (title, event_date, type, description) VALUES (?, ?, ?, ?)";
    $pdo->prepare($sql)->execute([$title, $date, $type, $desc]);
    header("Location: manage_events.php");
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM events WHERE id = ?")->execute([$_GET['delete']]);
    header("Location: manage_events.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin.css">
    <title>Manage Events</title>
</head>
<body>
<div class="sidebar">
    <h2>Sripalee Admin</h2>
    <a href="index.php">Dashboard</a>
    <a href="manage_news.php">Manage News</a>
    <a href="manage_events.php" style="background: #800000;">Manage Events</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Manage Events</h1>

    <div class="card">
        <h3>Add Event</h3>
        <form method="POST">
            <input type="text" name="title" placeholder="Event Name" required>
            <input type="date" name="event_date" required>
            <select name="type">
                <option value="upcoming">Upcoming</option>
                <option value="past">Past</option>
            </select>
            <textarea name="description" rows="3" placeholder="Short Description"></textarea>
            <button type="submit" name="add_event" class="btn">Save Event</button>
        </form>
    </div>

    <div class="card">
        <h3>Event List</h3>
        <table>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            <?php
            $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date DESC");
            while ($row = $stmt->fetch()) {
                echo "<tr>
                    <td>{$row['event_date']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['type']}</td>
                    <td><a href='manage_events.php?delete={$row['id']}' class='btn btn-danger'>Delete</a></td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>