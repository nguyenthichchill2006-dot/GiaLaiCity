<?php
// Nhúng cấu hình kết nối CSDL và Header trang chủ
include 'config/db.php';
include 'includes/header.php';

// Lấy ID bài viết từ thanh địa chỉ (Ví dụ: post.php?id=2)
$id = $_GET['id'] ?? 0;
$id = intval($id);

// Truy vấn lấy dữ liệu chi tiết của bài viết đó
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Nếu không tìm thấy bài viết, đá người dùng về trang chủ
if (!$post) {
    header("Location: index.php");
    exit();
}

// Cập nhật lượt xem (Tùy chọn - nếu bảng posts của bạn có cột views hoặc luot_xem)
// $pdo->prepare("UPDATE posts SET views = views + 1 WHERE id = ?")->execute([$id]);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="index.php" class="text-success text-decoration-none"><i class="fas fa-home"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($post['category'] ?? 'Văn Hóa') ?></li>
                </ol>
            </nav>

            <h1 class="display-5 font-weight-bold mb-3" style="color: #1e7e34; font-weight: 700; line-height: 1.3;">
                <?= htmlspecialchars($post['title']) ?>
            </h1>

            <div class="text-muted d-flex align-items-center gap-3 mb-4 pb-3 border-bottom" style="font-size: 0.9rem;">
                <span><i class="far fa-calendar-alt text-warning"></i> <?= date('d/m/Y', strtotime($post['created_at'] ?? 'now')) ?></span>
                <span><i class="fas fa-folder text-success"></i> Tỉnh: <?= htmlspecialchars($post['province'] ?? 'Gia Lai') ?></span>
            </div>

            <?php if (!empty($post['summary'])): ?>
                <div class="p-3 mb-4 bg-light border-start border-4 border-success rounded-end" style="font-style: italic; font-size: 1.1rem; color: #555;">
                    <?= htmlspecialchars($post['summary']) ?>
                </div>
            <?php endif; ?>

            <div class="mb-5 shadow-sm rounded-3 overflow-hidden text-center" style="max-height: 450px;">
                <?php 
                    $image_url = !empty($post['image']) ? $post['image'] : 'avtgl.jpg';
                ?>
                <img src="<?= $image_url ?>" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="<?= htmlspecialchars($post['title']) ?>">
            </div>

            <div class="post-content lh-lg" style="font-size: 1.1rem; color: #2b2b2b; text-align: justify; white-space: pre-line;">
                <?= htmlspecialchars($post['content'] ?? 'Nội dung đang được cập nhật...') ?>
            </div>

            <div class="text-center mt-5 pt-4 border-top">
                <a href="index.php" class="btn btn-success rounded-pill px-4 py-2 shadow-sm">
                    <i class="fas fa-arrow-left"></i> Quay lại trang chủ
                </a>
            </div>

        </div>
    </div>
</div>

<?php 
// Nhúng chân trang
include 'includes/footer.php'; 
?>