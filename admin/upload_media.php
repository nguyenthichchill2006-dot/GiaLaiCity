<?php
session_start();
if (!isset($_SESSION['admin'])) exit();

$target_dir = "../uploads/";
if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

foreach($_FILES['media']['tmp_name'] as $key => $tmp_name) {
    if ($_FILES['media']['error'][$key] == 0) {
        $filename = time() . "_" . basename($_FILES['media']['name'][$key]);
        move_uploaded_file($tmp_name, $target_dir . $filename);
    }
}
header("Location: gallery.php?success=1");
?>