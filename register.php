<?php
require_once 'dp.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$error   = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username         = trim($_POST['username'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role             = 'member'; // Mặc định luôn là member khi đăng ký

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Vui lòng điền đầy đủ thông tin!";
    } elseif (strlen($username) < 4) {
        $error = "Tên đăng nhập phải có ít nhất 4 ký tự!";
    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu nhập lại không trùng khớp!";
    } elseif (strlen($password) < 6) {
        $error = "Mật khẩu phải có ít nhất 6 ký tự!";
    } else {
        // Kiểm tra username hoặc email đã tồn tại chưa
        $check = $pdo->prepare("SELECT username, email FROM users WHERE username = ? OR email = ? LIMIT 1");
        $check->execute([$username, $email]);
        $existing = $check->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            if ($existing['username'] === $username) {
                $error = "Tên đăng nhập này đã có người sử dụng!";
            } elseif ($existing['email'] === $email) {
                $error = "Email này đã được đăng ký tài khoản khác!";
            }
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            try {
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->execute([$username, $email, $hashed_password, $role]);
                $success = "Đăng ký thành công! Đang chuyển hướng...";
                header("refresh:2; url=login.php");
            } catch (PDOException $e) {
                $error = "Có lỗi xảy ra: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký - Gia Lai Culture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .register-box {
            max-width: 460px;
            margin: 70px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .register-header {
            background: linear-gradient(135deg, #013a1a, #005c2b);
            padding: 28px 32px;
            text-align: center;
            color: #fff;
        }
        .register-header h3 { font-size: 20px; font-weight: 700; margin: 0; }
        .register-header p  { font-size: 13px; color: rgba(255,255,255,0.7); margin: 6px 0 0; }
        .register-body { padding: 28px 32px; }
        .form-label { font-weight: 600; font-size: 14px; color: #333; }
        .form-control { border-radius: 8px; font-size: 14px; padding: 10px 14px; border: 1px solid #ddd; }
        .form-control:focus { border-color: #005c2b; box-shadow: 0 0 0 3px rgba(0,92,43,0.1); }
        .btn-register {
            background: #005c2b; color: #fff; width: 100%;
            border: none; padding: 11px; border-radius: 8px;
            font-size: 15px; font-weight: 600; cursor: pointer; transition: 0.3s;
        }
        .btn-register:hover { background: #013a1a; }
        .role-badge {
            display: inline-block; background: #e8f5e9; color: #005c2b;
            font-size: 12px; font-weight: 600; padding: 3px 10px;
            border-radius: 20px; margin-top: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-box">

        <!-- HEADER -->
        <div class="register-header">
            <div style="font-size:36px; margin-bottom:8px;">🌿</div>
            <h3>ĐĂNG KÝ TÀI KHOẢN</h3>
            <p>Văn Hóa Gia Lai</p>
        </div>

        <!-- BODY -->
        <div class="register-body">

            <?php if(!empty($error)): ?>
            <div style="background:#fff5f5; border-left:4px solid #e53e3e; padding:10px 14px;
                        border-radius:6px; color:#e53e3e; font-size:14px; margin-bottom:18px;">
                ❌ <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <?php if(!empty($success)): ?>
            <div style="background:#f0fff4; border-left:4px solid #005c2b; padding:10px 14px;
                        border-radius:6px; color:#005c2b; font-size:14px; margin-bottom:18px;">
                ✅ <?= htmlspecialchars($success) ?>
            </div>
            <?php endif; ?>

            <form action="register.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control"
                           value="<?= htmlspecialchars($username ?? '') ?>"
                           placeholder="Tối thiểu 4 ký tự" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= htmlspecialchars($email ?? '') ?>"
                           placeholder="example@email.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Tối thiểu 6 ký tự" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" name="confirm_password" class="form-control"
                           placeholder="Nhập lại mật khẩu" required>
                </div>

                <!-- VAI TRÒ - CHỈ ĐỂ HIỂN THỊ, KHÔNG CHO CHỌN -->
                <div class="mb-4">
                    <label class="form-label">Vai trò</label>
                    <div style="padding:10px 14px; background:#f9f9f9; border:1px solid #eee;
                                border-radius:8px; font-size:14px; color:#555;">
                        👤 Thành viên <span class="role-badge">member</span>
                        <div style="font-size:12px; color:#aaa; margin-top:4px;">
                            Vai trò được cấp tự động. Liên hệ admin để nâng cấp.
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-register">🚀 Đăng Ký</button>
            </form>

            <p style="text-align:center; margin-top:18px; font-size:14px; color:#666;">
                Đã có tài khoản?
                <a href="login.php" style="color:#005c2b; font-weight:600;">Đăng nhập ngay</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>