<?php 
session_start();
include '../config/db.php';

if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$error = '';
if ($_POST) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: posts.php");
        exit();
    } else {
        $error = "Tài khoản hoặc mật khẩu không đúng!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Gia Lai Culture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0f5132, #198754); height: 100vh; }
        .login-box { max-width: 420px; margin: 100px auto; }
    </style>
</head>
<body class="text-white">
<div class="login-box">
    <div class="card bg-dark">
        <div class="card-body p-5">
            <h3 class="text-center mb-4">🌿 Admin Gia Lai</h3>
            <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
            
            <form method="POST"action="login.php>
                <div class="mb-3">
                    <label>Tài khoản</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>