<?php
require_once 'dp.php';        // Kết nối PDO
session_start();

// Nếu đã đăng nhập thì chuyển về trang chủ
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = trim($_POST['username_or_email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username_or_email) || empty($password)) {
        $error = "Vui lòng nhập đầy đủ tài khoản và mật khẩu!";
    } else {
        try {
            // Tìm theo username hoặc email
            $sql = "SELECT * FROM users WHERE username = :username_or_email OR email = :username_or_email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username_or_email' => $username_or_email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Đăng nhập thành công
                $_SESSION['user'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_avatar'] = $user['avatar'] ?? '';
                $_SESSION['role'] = $user['role'] ?? 'user';

                header("Location: index.php");
                exit();
            } else {
                $error = "Tài khoản hoặc mật khẩu không chính xác!";
            }
        } catch (Exception $e) {
            $error = "Lỗi hệ thống: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập - Gia Lai Culture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .login-container { max-width: 420px; margin: 100px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .btn-login { background: #005c2b; color: white; width: 100%; border: none; padding: 10px; border-radius: 5px; }
        .btn-login:hover { background: #013a1a; }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h3 class="text-center mb-4" style="color: #005c2b; font-weight: bold;">ĐĂNG NHẬP</h3>
        
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Tài khoản hoặc Email</label>
                <input type="text" name="username_or_email" class="form-control" required value="<?= htmlspecialchars($username_or_email ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-login mt-2">Đăng Nhập</button>
        </form>
        
        <p class="text-center mt-3 small">Chưa có tài khoản? <a href="register.php" style="color: #005c2b; font-weight: 600;">Đăng ký ngay</a></p>
    </div>
</div>

</body>
</html>