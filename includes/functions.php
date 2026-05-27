<?php
// includes/functions.php

function getSetting($key, $default = '') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT `value` FROM settings WHERE `key` = ?");
    $stmt->execute([$key]);
    $result = $stmt->fetchColumn();
    return $result !== false ? $result : $default;
}
?>