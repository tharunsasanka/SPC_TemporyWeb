<?php
$host = 'localhost';
$dbname = 'sripalee_db';
$username = 'root'; // Change if your DB user is different
$password = '';     // Change if you have a password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>