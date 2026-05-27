<?php 
require_once 'dp.php';
$page_title = "Tin Tức - Văn Hóa Gia Lai & Bình Định";
include 'includes/header.php';

$province = $_GET['province'] ?? 'all';
?>

<div class="container my-5">
    <div class="row mb-5 text-center">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-5 fw-bold">📚 Tin Tức & Bài Viết Văn Hóa</h1>
            <p class="lead text-muted">Gia Lai | Di sản Tây Nguyên & Đất Võ Trời Văn</p>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="text-center mb-5">
        <a href="tin-tuc.php" class="btn <?= $province == 'all' ? 'btn-primary' : 'btn-outline-primary' ?> px-4 me-2">🌍 Tất cả bài viết</a>
        <a href="tin-tuc.php?province=Gia Lai" class="btn <?= $province == 'Gia Lai' ? 'btn-primary' : 'btn-outline-primary' ?> px-4 me-2">🌿 Gia Lai</a>
        
    </div>

    <div class="row g-4">
        <?php
        $sql = "SELECT id, slug, title, image, category, province, created_at, LEFT(content, 160) as short_content 
                FROM posts";
        
        if ($province !== 'all') {
            $sql .= " WHERE province = ?";
            $stmt = $pdo->prepare($sql . " ORDER BY created_at DESC LIMIT 12");
            $stmt->execute([$province]);
        } else {
            $stmt = $pdo->query($sql . " ORDER BY created_at DESC LIMIT 12");
        }

        $count = 0;
        while($row = $stmt->fetch()):
            $count++;
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm hover-card">
                <?php if(!empty($row['image'])): ?>
                    <img src="<?= htmlspecialchars($row['image']) ?>" 
                         class="card-img-top" 
                         style="height: 240px; " 
                         alt="<?= htmlspecialchars($row['title']) ?>">
                <?php endif; ?>
                
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-<?= $row['province'] == 'Gia Lai' ? 'success' : 'warning' ?> mb-2">
                        <?= htmlspecialchars($row['province']) ?>
                    </span>
                    <span class="badge bg-secondary mb-3"><?= htmlspecialchars($row['category'] ?? 'Khác') ?></span>
                    
                    <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                    <p class="card-text text-muted flex-grow-1">
                        <?= htmlspecialchars($row['short_content']) ?>...
                    </p>
                    
                    <a href="post.php?slug=<?= urlencode($row['slug']) ?>" 
                       class="btn btn-outline-primary mt-auto">Đọc tiếp →</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <?php if($count == 0): ?>
        <div class="text-center py-5">
            <h3>Chưa có bài viết nào cho khu vực này.</h3>
            <a href="add-post.php" class="btn btn-success mt-3">Thêm bài viết mới</a>
        </div>
    <?php endif; ?>
</div>

<style>
.hover-card { transition: all 0.3s ease; }
.hover-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important; }
</style>

<?php include 'includes/footer.php'; ?>