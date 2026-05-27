<?php
// config/database.php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "gialai_culture";   // ← THAY TÊN DATABASE CỦA BẠN VÀO ĐÂY

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Set charset UTF-8
$conn->set_charset("utf8mb4");
?>