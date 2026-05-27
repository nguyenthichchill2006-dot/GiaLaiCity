<?php 
require_once 'dp.php';

$page_title = "Văn Hóa Gia Lai & Bình Định";

// Khởi chạy session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$welcome = '';
if (isset($_GET['login']) && $_GET['login'] == 'success') {
    $welcome = "🎉 Đăng nhập thành công! Chào mừng <strong>" . htmlspecialchars($_SESSION['user'] ?? 'Bạn') . "</strong>";
}

// 1. Truy vấn lấy bài viết mới nhất
$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $pdo->query($sql);

// 2. Tin tức mới (Địa danh)
$stmt_places = $pdo->prepare("SELECT * FROM posts WHERE type = 'dia_danh' ORDER BY id DESC LIMIT 4");
$stmt_places->execute();
$places = $stmt_places->fetchAll(PDO::FETCH_ASSOC);

// 3. Ẩm thực (dự phòng)
$stmt_foods = $pdo->prepare("SELECT * FROM posts WHERE type = 'am_thuc' ORDER BY id DESC LIMIT 4");
$stmt_foods->execute();
$foods = $stmt_foods->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>

<?php if($welcome): ?>
    <div class="alert alert-success text-center mx-3 mt-3">
        <?= $welcome ?>
    </div>
<?php endif; ?>

<section class="hero-custom position-relative">
    <div class="hero-image" style="background-image: url('anhnennuilua.jpg');"></div>
    <div class="hero-overlay"></div>
    
    <div class="hero-container position-relative z-3 text-center text-white d-flex flex-column justify-content-center h-100">
        <h1 class="hero-main-title">VĂN HÓA GIA LAI</h1>
        <p class="hero-main-subtitle">
            Từ đại ngàn cồng chiêng đến đất võ trời văn<br>
            <strong>Khám phá hai vùng đất di sản giàu bản sắc</strong>
        </p>
    </div>

    <div class="search-floating-bar container position-absolute start-50 translate-middle-x z-3">
        <form action="search.php" method="GET" class="bg-white rounded-pill shadow-lg p-2 d-flex flex-wrap flex-md-nowrap align-items-center">
            <input type="text" name="q" class="form-control border-0 bg-transparent shadow-none px-4" placeholder="Tìm kiếm điểm đến, lễ hội...">
            <div class="vr d-none d-md-block mx-2"></div>
            
            <select name="category" class="form-select border-0 bg-transparent shadow-none">
                <option value="">Chọn danh mục</option>
                <option value="dia_danh">Địa danh</option>
                <option value="am_thuc">Ẩm thực</option>
                <option value="van_hoa">Văn hóa</option>
            </select>
            <div class="vr d-none d-md-block mx-2"></div>
            
            <select name="location" class="form-select border-0 bg-transparent shadow-none">
                <option value="">Chọn địa điểm</option>
                <option value="pleiku">TP. Pleiku</option>
                <option value="chu_se">Chư Sê</option>
            </select>
            
            <button type="submit" class="btn btn-success rounded-pill px-4 py-2 ms-md-2 w-100 w-md-auto mt-2 mt-md-0" style="background-color: var(--primary);">
                <i class="fas fa-search"></i> Tìm kiếm
            </button>
        </form>
    </div>
</section>

<section class="container" style="margin-top: 60px;">
    <div class="bg-white rounded-4 shadow-sm p-2 mb-5">
        <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between text-center align-items-center">
            <a href="#" class="quick-link-item flex-fill py-2 text-decoration-none border-end">
                <div class="d-flex align-items-center justify-content-center gap-2 px-2">
                    <div class="quick-icon-sm bg-success text-white rounded-circle"><i class="fas fa-leaf"></i></div>
                    <div class="text-start">
                        <h6 class="mb-0 text-dark fw-bold font-size-sm">GIA LAI</h6>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Khám phá chung</small>
                    </div>
                </div>
            </a>
            <!-- Các link khác giữ nguyên -->
            <!-- ... (bạn có thể giữ phần này như cũ) ... -->
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="row g-4">
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h3 class="font-weight-bold m-0" style="color: var(--text-dark);">Khám phá Gia Lai</h3>
            </div>
            
            <div class="row row-cols-2 row-cols-md-4 g-3 mb-5">
                <?php if ($result && $result->rowCount() > 0): ?>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden custom-post-card">
                            <div class="position-relative" style="height: 140px; overflow: hidden;">
                                <?php $image_url = !empty($row['image']) ? $row['image'] : 'avtgl.jpg'; ?>
                                <img src="<?= htmlspecialchars($image_url) ?>" class="w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($row['title']) ?>">
                            </div>
                            <div class="card-body p-2 d-flex flex-column gap-1">
                                <h5 class="card-title fw-bold text-dark mb-0 text-truncate-2" style="font-size: 0.95rem; line-height: 1.3;">
                                    <?= htmlspecialchars($row['title']) ?>
                                </h5>
                                <p class="card-text text-muted small text-truncate-2 mb-1" style="font-size: 0.8rem; line-height: 1.4;">
                                    <?= htmlspecialchars($row['excerpt'] ?? 'Khám phá nét văn hóa đặc sắc...') ?>
                                </p>
                                <div class="mt-auto pt-1">
                                    <a href="xemchitiet.php?id=<?= $row['id'] ?>" class="text-success text-decoration-none fw-bold" style="font-size: 0.8rem;">Xem thêm &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12"><p class="text-muted w-100">Hiện chưa có bài viết nào.</p></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h5 class="font-weight-bold m-0" style="color: var(--text-dark);">Tin tức mới</h5>
                <a href="tintuc.php" class="text-success text-decoration-none small">Xem tất cả &rarr;</a>
            </div>
            
            <div class="news-sidebar d-flex flex-column gap-3">
                <?php if(!empty($places)): ?>
                    <?php foreach($places as $news): ?>
                    <a href="xemchitiet.php?id=<?= $news['id'] ?>" class="d-flex align-items-start text-decoration-none bg-light p-2 rounded hover-shadow-sm transition-all border border-light">
                        <?php $news_img = !empty($news['image']) ? $news['image'] : 'avtgl.jpg'; ?>
                        <img src="<?= htmlspecialchars($news_img) ?>" class="rounded object-fit-cover" width="70" height="55" alt="">
                        <div class="ms-2">
                            <h6 class="mb-1 text-dark fw-bold text-truncate-2" style="font-size: 0.85rem; line-height: 1.3;">
                                <?= htmlspecialchars($news['title']) ?>
                            </h6>
                            <small class="text-muted" style="font-size: 0.7rem;"><i class="far fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($news['created_at'] ?? 'now')) ?></small>
                        </div>
                    </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted small">Chưa có tin tức.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>