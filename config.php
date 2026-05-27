<?php
// config.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ====================== ĐA NGÔN NGỮ ======================
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'vi';
}

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = ($_GET['lang'] === 'en') ? 'en' : 'vi';
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

$lang_file = __DIR__ . "/languages/{$_SESSION['lang']}.php";

if (file_exists($lang_file)) {
    include $lang_file;
} else {
    // Fallback nếu file ngôn ngữ chưa tồn tại
    $lang = [];
}

$base_url = (basename(dirname($_SERVER['PHP_SELF'])) === 'admin') ? '../' : '';
?>