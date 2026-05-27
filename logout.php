<?php
session_start();
// Xóa toàn bộ dữ liệu session
$_SESSION = array();
session_destroy();

// Chuyển hướng người dùng về lại trang chủ sau khi đăng xuất
header("Location: index.php");
exit();
?>