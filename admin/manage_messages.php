<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
require '../config/db.php';

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM contact_messages WHERE id = ?")->execute([$_GET['delete']]);
    header("Location: manage_messages.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin.css">
    <title>Messages</title>
</head>
<body>
<div class="sidebar">
    <h2>Sripalee Admin</h2>
    <a href="index.php">Dashboard</a>
    <a href="manage_messages.php" style="background: #800000;">Messages</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Contact Messages</h1>
    <div class="card">
        <table>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
            <?php
            $stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY sent_at DESC");
            while ($row = $stmt->fetch()) {
                echo "<tr>
                    <td>{$row['sent_at']}</td>
                    <td>{$row['name']} <br> <small>{$row['email']}</small></td>
                    <td>{$row['subject']}</td>
                    <td>{$row['message']}</td>
                    <td><a href='manage_messages.php?delete={$row['id']}' class='btn btn-danger'>Delete</a></td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>