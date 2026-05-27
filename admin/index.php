<?php
session_start();
// Kiểm tra quyền đăng nhập Admin
if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../dp.php';

// 📊 1. Lấy tổng số bài viết trên hệ thống
$stmt_posts = $pdo->query("SELECT COUNT(*) FROM news");
$total_posts = $stmt_posts->fetchColumn();

$stmt_views = $pdo->query("SELECT SUM(luot_xem) FROM news");
$total_views = $stmt_views->fetchColumn() ?? 0;

$stmt_cats = $pdo->query("SELECT COUNT(DISTINCT danh_muc) FROM news");
$total_categories = $stmt_cats->fetchColumn() ?? 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bảng Điều Khiển</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .admin-wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background-color: #212529; color: #fff; padding: 20px; }
        .main-content { flex: 1; padding: 30px; }
        .stat-card { border: none; border-radius: 12px; transition: transform 0.3s; color: white; }
        .stat-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<div class="admin-wrapper">
    <div class="sidebar">
        <h4 class="text-center mb-4"><i class="fas fa-user-shield"></i> Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="index.php" class="nav-link text-white active bg-success rounded"><i class="fas fa-chart-line me-2"></i>Dashboard</a></li>
            <li class="nav-item mb-2"><a href="posts.php" class="nav-link text-white"><i class="fas fa-newspaper me-2"></i>Quản lý Bài viết</a></li>
            <li class="nav-item mb-2"><a href="../index.php" target="_blank" class="nav-link text-white"><i class="fas fa-eye me-2"></i>Xem Website</a></li>
            <li class="nav-item mt-4"><a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h2 class="mb-4"><i class="fas fa-tachometer-alt text-success"></i> Hệ Thống Tổng Quan</h2>
        <p class="text-muted">Chào mừng quay trở lại, hệ thống đang vận hành ổn định.</p>
        
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="card stat-card bg-primary p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-white-50 small">Tổng bài viết</h6>
                            <h2 class="fw-bold mb-0"><?= $total_posts ?></h2>
                        </div>
                        <i class="fas fa-file-alt fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-warning p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-white-50 small">Danh mục hoạt động</h6>
                            <h2 class="fw-bold mb-0"><?= $total_categories ?></h2>
                        </div>
                        <i class="fas fa-folder fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-success p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-white-50 small">Tổng lượt đọc</h6>
                            <h2 class="fw-bold mb-0"><?= $total_views ?></h2>
                        </div>
                        <i class="fas fa-eye fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5 p-4 border-0 shadow-sm rounded-3">
            <h5><i class="fas fa-rocket text-success me-2"></i>Thao tác nhanh</h5>
            <div class="d-flex gap-3 mt-3">
                <a href="add-post.php" class="btn btn-outline-success"><i class="fas fa-plus me-1"></i> Viết bài mới </a>
                <a href="posts.php" class="btn btn-outline-secondary"><i class="fas fa-list me-1"></i> Danh sách bài viết</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>