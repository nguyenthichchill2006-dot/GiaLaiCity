<?php
require_once 'config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);

    // Xử lý upload ảnh
    $avatar = $user['avatar'];

    if (!empty($_FILES['avatar']['name'])) {
        $file_name = time() . '_' . $_FILES['avatar']['name'];
        $target = "assets/uploads/" . $file_name;

        move_uploaded_file($_FILES['avatar']['tmp_name'], $target);
        $avatar = $file_name;
    }

    $stmt = $pdo->prepare("UPDATE users SET username = ?, avatar = ? WHERE id = ?");
    $stmt->execute([$username, $avatar, $_SESSION['user_id']]);

    $message = "Cập nhật thành công!";
}
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="card p-4 shadow">
        <h3>✏️ Chỉnh sửa thông tin</h3>

        <?php if($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Tên người dùng</label>
                <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>">
            </div>

            <div class="mb-3">
                <label>Ảnh đại diện</label><br>
                <img src="assets/uploads/<?= htmlspecialchars($user['avatar'] ?? 'default.png') ?>" width="100">
                <input type="file" name="avatar" class="form-control">
            </div>

            <button class="btn btn-success">Lưu thay đổi</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>