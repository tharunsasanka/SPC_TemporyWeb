<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
require '../config/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin.css">
    <title>Dashboard</title>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="index.php">Dashboard</a>
    <a href="manage_news.php">Manage News</a>
    <a href="manage_events.php">Manage Events</a>
    <a href="manage_messages.php">Messages</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Welcome, Admin</h1>
    
    <div style="display: flex; gap: 20px;">
        <div class="card" style="flex: 1;">
            <h3>Total Messages</h3>
            <?php 
            $count = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
            echo "<h1>$count</h1>"; 
            ?>
        </div>
        <div class="card" style="flex: 1;">
            <h3>News Articles</h3>
            <?php 
            $count = $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();
            echo "<h1>$count</h1>"; 
            ?>
        </div>
        <div class="card" style="flex: 1;">
            <h3>Events</h3>
            <?php 
            $count = $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn();
            echo "<h1>$count</h1>"; 
            ?>
        </div>
    </div>
</div>

</body>
</html>