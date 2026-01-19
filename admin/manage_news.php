<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
require '../config/db.php';

// --- HANDLE ADDING NEWS (With 2 Images) ---
if (isset($_POST['add_news'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['publish_date'];
    
    $target_dir = "../uploads/";

    // Process Image 1
    $image_path = ""; 
    if (!empty($_FILES["image"]["name"])) {
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image_path = "uploads/" . basename($_FILES["image"]["name"]);
    }

    // Process Image 2
    $image_path_2 = ""; 
    if (!empty($_FILES["image2"]["name"])) {
        $target_file_2 = $target_dir . basename($_FILES["image2"]["name"]);
        move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file_2);
        $image_path_2 = "uploads/" . basename($_FILES["image2"]["name"]);
    }

    $sql = "INSERT INTO news (title, content, publish_date, image_path, image_path_2) VALUES (?, ?, ?, ?, ?)";
    $pdo->prepare($sql)->execute([$title, $content, $date, $image_path, $image_path_2]);
    header("Location: manage_news.php");
}

// --- HANDLE DELETING NEWS ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM news WHERE id = ?")->execute([$id]);
    header("Location: manage_news.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin.css">
    <title>Manage News</title>
</head>
<body>
<div class="sidebar">
    <h2>Sripalee Admin</h2>
    <a href="index.php">Dashboard</a>
    <a href="manage_news.php" style="background: #800000;">Manage News</a>
    <a href="manage_events.php">Manage Events</a>
    <a href="manage_messages.php">Messages</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Manage News</h1>

    <div class="card">
        <h3>Add New Article</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="News Title" required>
            <input type="date" name="publish_date" required>
            <textarea name="content" rows="5" placeholder="Full Content" required></textarea>
            
            <div style="margin-top:10px; border:1px solid #ccc; padding:10px;">
                <label>Main Photo:</label>
                <input type="file" name="image">
            </div>

            <div style="margin-top:10px; border:1px solid #ccc; padding:10px;">
                <label>Second Photo (Optional):</label>
                <input type="file" name="image2">
            </div>

            <button type="submit" name="add_news" class="btn" style="width:100%; margin-top:10px;">Publish News</button>
        </form>
    </div>

    <div class="card">
        <h3>All News</h3>
        <table>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Action</th>
            </tr>
            <?php
            $stmt = $pdo->query("SELECT * FROM news ORDER BY publish_date DESC");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>{$row['publish_date']}</td>";
                echo "<td>{$row['title']}</td>";
                // Show tiny preview of Image 1
                echo "<td>";
                if(!empty($row['image_path'])) { echo "<img src='../{$row['image_path']}' width='50'>"; }
                echo "</td>";
                // Show tiny preview of Image 2
                echo "<td>";
                if(!empty($row['image_path_2'])) { echo "<img src='../{$row['image_path_2']}' width='50'>"; }
                echo "</td>";
                
                echo "<td><a href='manage_news.php?delete={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>