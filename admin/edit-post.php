<?php
session_start();
// 1. Kiểm tra quyền đăng nhập Admin
if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include '../config/db.php';

$error = '';
$success = '';

// 2. Lấy ID bài viết cần sửa từ thanh địa chỉ (Ví dụ: edit-post.php?id=2)
$id = $_GET['id'] ?? 0;
$id = intval($id);

// 3. Truy vấn lấy dữ liệu hiện tại của bài viết để đổ vào form
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Nếu không tồn tại bài viết có ID này, chuyển hướng về trang danh sách
if (!$post) {
    header("Location: posts.php");
    exit();
}

// 4. Xử lý khi Người dùng nhấn nút "Cập nhật bài viết" (Submit Form)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $province = $_POST['province'] ?? 'Gia Lai';
    $category = $_POST['category'] ?? '';

    if (empty($title) || empty($content) || empty($category)) {
        $error = "❌ Vui lòng điền đầy đủ các thông tin bắt buộc (Tiêu đề, Danh mục, Nội dung)!";
    } else {
        // Xử lý ảnh đại diện mới (nếu có upload)
        $image_path = $post['image']; // Mặc định giữ lại đường dẫn ảnh cũ
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $filename = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($ext, $allowed)) {
                // Tạo tên file độc nhất để không bị trùng
                $new_filename = uniqid() . '.' . $ext;
                // Thư mục lưu ảnh vật lý nằm ngoài trang chủ
                $upload_dir = '../'; 
                $target_file = $upload_dir . $new_filename;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    // Nếu upload ảnh mới thành công, xóa file ảnh cũ để sạch host
                    if (!empty($post['image']) && file_exists('../' . $post['image']) && is_file('../' . $post['image'])) {
                        unlink('../' . $post['image']);
                    }
                    $image_path = $new_filename; // Cập nhật đường dẫn ảnh mới vào database
                }
            } else {
                $error = "❌ Định dạng ảnh không hợp lệ! Chỉ chấp nhận JPG, JPEG, PNG, GIF, WEBP.";
            }
        }

        // Nếu không có lỗi định dạng ảnh, tiến hành UPDATE vào CSDL
        if (empty($error)) {
            $sql = "UPDATE posts SET title = ?, summary = ?, content = ?, province = ?, category = ?, image = ? WHERE id = ?";
            $stmt_update = $pdo->prepare($sql);
            $run = $stmt_update->execute([$title, $summary, $content, $province, $category, $image_path, $id]);
            
            if ($run) {
                // Đóng gói chuyển hướng về trang danh sách kèm thông báo thành công
                header("Location: posts.php?updated=1");
                exit();
            } else {
                $error = "❌ Có lỗi xảy ra, không thể cập nhật dữ liệu!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Bài Viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .admin-wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background-color: #212529; color: #fff; padding: 20px; }
        .main-content { flex: 1; padding: 30px; }
        .card-form { background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 30px; }
    </style>
</head>
<body>

<div class="admin-wrapper">
    <div class="sidebar">
        <h4 class="text-center mb-4"><i class="fas fa-user-shield"></i> Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="index.php" class="nav-link text-white"><i class="fas fa-home me-2"></i>Dashboard</a></li>
            <li class="nav-item mb-2"><a href="posts.php" class="nav-link text-white active bg-success rounded"><i class="fas fa-newspaper me-2"></i>Quản lý Bài viết</a></li>
            <li class="nav-item mb-2"><a href="../index.php" target="_blank" class="nav-link text-white"><i class="fas fa-eye me-2"></i>Xem Website</a></li>
            <li class="nav-item mt-4"><a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-edit text-success"></i> Chỉnh Sửa Bài Viết</h2>
            <a href="posts.php" class="btn btn-secondary rounded-pill"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <?php if($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <div class="card-form">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề bài viết <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['title']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tóm tắt ngắn</label>
                            <textarea name="summary" class="form-control" rows="3"><?= htmlspecialchars($post['summary'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nội dung chính <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tỉnh / Vùng</label>
                            <select name="province" class="form-select">
                                <option value="Gia Lai" <?= ($post['province'] ?? '') == 'Gia Lai' ? 'selected' : '' ?>>🌿 Gia Lai</option>
                                <option value="Bình Định" <?= ($post['province'] ?? '') == 'Bình Định' ? 'selected' : '' ?>>🏖️ Bình Định</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                            <select name="category" class="form-select" required>
                                <option value="">-- Chọn danh mục --</option>
                                <option value="DI SẢN" <?= ($post['category'] ?? '') == 'DI SẢN' ? 'selected' : '' ?>>DI SẢN</option>
                                <option value="VĂN HÓA" <?= ($post['category'] ?? '') == 'VĂN HÓA' ? 'selected' : '' ?>>VĂN HÓA</option>
                                <option value="ẨM THỰC" <?= ($post['category'] ?? '') == 'ẨM THỰC' ? 'selected' : '' ?>>ẨM THỰC</option>
                                <option value="TIN TỨC" <?= ($post['category'] ?? '') == 'TIN TỨC' ? 'selected' : '' ?>>TIN TỨC</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ảnh đại diện hiện tại</label>
                            <div class="mb-2 border rounded p-2 text-center bg-light">
                                <?php $old_img = !empty($post['image']) ? '../'.$post['image'] : '../avtgl.jpg'; ?>
                                <img src="<?= $old_img ?>" style="max-width: 100%; max-height: 150px; object-fit: cover;" alt="Current Image">
                            </div>
                            <label class="form-label fw-bold">Thay ảnh mới (Nếu muốn)</label>
                            <input type="file" name="image" class="form-control">
                            <span class="text-muted small">Chấp nhận: jpg, jpeg, png, gif, webp</span>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4 border-top pt-3">
                    <button type="submit" class="btn btn-success px-4 py-2 rounded-pill"><i class="fas fa-save"></i> Lưu cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>