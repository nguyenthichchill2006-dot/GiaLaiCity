<?php
require_once 'config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (password_verify($old, $user['password'])) {
        $newHash = password_hash($new, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$newHash, $_SESSION['user_id']]);

        $message = "Đổi mật khẩu thành công!";
    } else {
        $message = "Mật khẩu cũ không đúng!";
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="card p-4 shadow">
        <h3>🔒 Đổi mật khẩu</h3>

        <?php if($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Mật khẩu cũ</label>
                <input type="password" name="old_password" class="form-control">
            </div>

            <div class="mb-3">
                <label>Mật khẩu mới</label>
                <input type="password" name="new_password" class="form-control">
            </div>

            <button class="btn btn-danger">Đổi mật khẩu</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>