<?php 
session_start();

// Kiểm tra quyền đăng nhập đồng bộ với file posts.php của bạn
if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Nhúng file kết nối cơ sở dữ liệu
require_once '../dp.php';

// Lấy ID bài viết cần xóa từ thanh địa chỉ
$id = $_GET['id'] ?? 0;

if ($id > 0) {
    // [Nâng cấp bảo mật]: Xóa thêm file ảnh vật lý trong thư mục ngoài trang chủ để đỡ rác host
    $stmt_img = $pdo->prepare("SELECT image FROM posts WHERE id = ?");
    $stmt_img->execute([$id]);
    $post = $stmt_img->fetch(PDO::FETCH_ASSOC);
    if ($post && !empty($post['image'])) {
        $image_path = "../" . $post['image']; // Lùi 1 cấp để ra ngoài thư mục gốc tìm ảnh
        if (file_exists($image_path) && is_file($image_path)) {
            unlink($image_path); // Xóa file ảnh
        }
    }

    // Thực hiện xóa bài viết trong CSDL bằng PDO đúng như bạn viết
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);
}

// Xóa xong chuyển hướng ngay lập tức về trang danh sách posts.php cùng cấp thư mục admin
header("Location: posts.php?deleted=1");
exit();
?>