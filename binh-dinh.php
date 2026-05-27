<?php 
require_once 'dp.php';
$page_title = "Văn Hóa Bình Định";
include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-5 fw-bold">🏖️ Văn Hóa Bình Định</h1>
            <p class="lead text-muted">Đất võ trời văn - Nơi giao thoa giữa núi rừng và biển cả</p>
        </div>
    </div>

    <!-- Filter chỉ Bình Định -->
    <div class="row g-4">
        <?php
        $stmt = $pdo->prepare("SELECT id, slug, title, image, category, created_at, 
                                     LEFT(content, 160) as short_content 
                              FROM posts 
                              WHERE province = 'Binh Dinh' 
                              ORDER BY created_at DESC LIMIT 12");
        $stmt->execute();
        $count = 0;
        
        while($row = $stmt->fetch()):
            $count++;
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm hover-card">
                <?php if($row['image']): ?>
                    <img src="<?= htmlspecialchars($row['image']) ?>" class="card-img-top" style="height: 240px; object-fit: cover;">
                <?php endif; ?>
                
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-warning text-dark mb-2">Bình Định</span>
                    <span class="badge bg-secondary mb-3"><?= htmlspecialchars($row['category']) ?></span>
                    
                    <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                    <p class="card-text text-muted flex-grow-1">
                        <?= htmlspecialchars($row['short_content']) ?>...
                    </p>
                    <a href="post.php?slug=<?= urlencode($row['slug']) ?>" class="btn btn-outline-primary mt-auto">Đọc tiếp →</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <?php if($count == 0): ?>
    <div class="text-center py-5">
        <h3>Chưa có bài viết về Bình Định nào.</h3>
        <p class="text-muted">Hãy vào Admin thêm bài viết với tỉnh "Bình Định".</p>
        <a href="admin/add-post.php" class="btn btn-success mt-3">Thêm bài viết Bình Định</a>
    </div>
    <?php endif; ?>
</div>

<style>
.hover-card { transition: all 0.3s; }
.hover-card:hover { transform: translateY(-8px); }
</style>

<?php include 'includes/footer.php'; ?>