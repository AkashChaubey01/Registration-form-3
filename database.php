<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'Loginuser';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "CREATE DATABASE IF NOT EXISTS $db_name";
$conn->query($query);

$query = "USE $db_name";
$conn->query($query);

$query = "CREATE TABLE IF NOT EXISTS authLogin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
$conn->query($query);
?>