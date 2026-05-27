<?php
require_once 'dp.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Nếu chưa đăng nhập thì bắt quay về trang login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['user'];
$success = '';
$error = '';

// 1. Lấy thông tin hiện tại của User từ DB ra để hiển thị vào ô nhập liệu
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Xử lý khi nhấn nút "Lưu cập nhật"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $password_new = trim($_POST['password']);
    $avatar_path = $user['avatar'] ?? 'default-avatar.png'; // Ảnh cũ mặc định

    // Xử lý Upload ảnh đại diện nếu có chọn file mới
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['avatar']['tmp_name'];
        $file_name = $_FILES['avatar']['name'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed)) {
            // Tạo tên file mới ngẫu nhiên không sợ trùng lẫn
            $new_file_name = 'avatar_' . time() . '.' . $ext;
            $upload_dir = 'uploads/avatars/';
            
            // Tạo thư mục nếu chưa có
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                $avatar_path = $upload_dir . $new_file_name;
            }
        } else {
            $error = "Định dạng ảnh không hợp lệ (Chỉ chấp nhận jpg, png, webp, gif).";
        }
    }

    if (empty($error)) {
        try {
            if (!empty($password_new)) {
                // Nếu người dùng có nhập mật khẩu mới -> cập nhật cả mật khẩu (đã mã hóa)
                $password_hashed = password_hash($password_new, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET fullname = ?, password = ?, avatar = ? WHERE username = ?";
                $stmt_update = $pdo->prepare($sql);
                $stmt_update->execute([$fullname, $password_hashed, $avatar_path, $username]);
            } else {
                // Nếu không đổi mật khẩu -> chỉ cập nhật tên và ảnh đại diện
                $sql = "UPDATE users SET fullname = ?, avatar = ? WHERE username = ?";
                $stmt_update = $pdo->prepare($sql);
                $stmt_update->execute([$fullname, $avatar_path, $username]);
            }
            $success = "🎉 Cập nhật thông tin tài khoản thành công!";
            
            // Làm mới lại dữ liệu hiển thị
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = "Có lỗi xảy ra: " . $e->getMessage();
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 font-weight-bold text-success">⚙️ CHỈNH SỬA THÔNG TIN</h3>
                    
                    <?php if($success): ?>
                        <div class="alert alert-success text-center"><?= $success ?></div>
                    <?php endif; ?>
                    <?php if($error): ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="profile.php" method="POST" enctype="multipart/form-data">
                        <div class="text-center mb-4">
                            <img src="<?= !empty($user['avatar']) ? htmlspecialchars($user['avatar']) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' ?>" 
                                 class="rounded-circle img-thumbnail shadow-sm" 
                                 style="width: 120px; height: 120px; object-fit: cover;" alt="Avatar">
                            <div class="mt-2">
                                <label for="avatar" class="btn btn-sm btn-outline-secondary rounded-pill">Thay ảnh đại diện</label>
                                <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Tên đăng nhập (Username)</label>
                            <input type="text" class="form-label form-control bg-light" value="<?= htmlspecialchars($user['username']) ?>" readonly>
                            <small class="text-muted">Tên tài khoản cố định không thể chỉnh sửa.</small>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label font-weight-bold">Họ và Tên</label>
                            <input type="text" id="fullname" name="fullname" class="form-control" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label font-weight-bold">Mật khẩu mới</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Bỏ trống nếu không muốn đổi mật khẩu">
                        </div>

                        <button type="submit" class="btn btn-success w-100 rounded-pill py-2">
                            <i class="fas fa-save me-1"></i> Lưu cập nhật
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>