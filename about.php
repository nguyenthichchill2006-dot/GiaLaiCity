<?php 
session_start();
include 'config/db.php';

$page_title = "Admin Dashboard - Văn Hóa Gia Lai & Bình Định";

if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<style>
    .avtvh-bg {
        min-height: 100vh !important;
        background-image: url('anhnennuilua.jpg') !important;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
        position: relative !important;
    }


    .avtvh-bg .card-body {
        background: transparent !important;
        position: relative !important;
        z-index: 3 !important;
    }

    
    .avtvh-bg h1, 
    .avtvh-bg h4 {
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.8) !important;
        color: white !important;
    }

    /* Nút bấm dễ nhìn hơn */
    .avtvh-bg .btn {
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.6) !important;
        font-weight: 600 !important;
    }
</style>

<!-- Background -->
<div class="avtvh-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
             
                    <div class="card-body p-10 text-center">
                         <a >
            <img src="avt-gl.jpg" 
                 class="rounded-circle" 
                 width="100" height="100" 
                 style="object-fit: cover; border: 2px solid white;">
           
        </a>
                        <h4 class="mb-5">Chào <?= htmlspecialchars($_SESSION['user'] ?? $_SESSION['admin'] ?? 'Bạn') ?>!</h4>
                        
                        <div class="row g-4 mt-4">
                            <div class="col-md-4">
                                <a href="admin/add-post.php" class="btn btn-hero-secondary">✍️ Bài Viết Mới
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="admin/posts.php" class="btn btn-hero-secondary">📋 Quản Lý Bài Viết
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="tin-tuc.php" class="btn btn-hero-secondary">🌐 Trang Tin Tức
                                </a>
                            </div>
                        </div>

                        <hr style="border: none; margin: 2rem 0;">
                        <a href="index.php" class="btn btn-hero-secondary">🏠 Về Trang Chủ</a>
                    </div>
               
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>