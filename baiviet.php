<?php
require_once 'dp.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Lấy slug hoặc id từ URL
$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header("Location: tintuc.php");
    exit;
}

// Lấy bài viết theo slug hoặc id
if (is_numeric($slug)) {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ? AND trang_thai = 'hien'");
} else {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE slug = ? AND trang_thai = 'hien'");
}
$stmt->execute([$slug]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

// Không tìm thấy bài viết
if (!$news) {
    header("Location: tintuc.php");
    exit;
}

// Tăng lượt xem
$pdo->prepare("UPDATE news SET luot_xem = luot_xem + 1 WHERE id = ?")->execute([$news['id']]);

// Lấy 3 bài viết liên quan cùng danh mục
$stmt_related = $pdo->prepare("
    SELECT id, tieu_de, slug, hinh_anh, ngay_dang, danh_muc
    FROM news 
    WHERE trang_thai = 'hien' AND id != ? AND danh_muc = ?
    ORDER BY ngay_dang DESC 
    LIMIT 3
");
$stmt_related->execute([$news['id'], $news['danh_muc']]);
$related = $stmt_related->fetchAll(PDO::FETCH_ASSOC);

$page_title = htmlspecialchars($news['tieu_de']) . " - Văn Hóa Gia Lai";
$page_desc  = htmlspecialchars($news['mo_ta'] ?? '');

include 'includes/header.php';
?>

<div style="background:#f5f5f5; padding:40px 0; min-height:60vh;">
    <div class="container">
        <div class="row g-4">

            <!-- NỘI DUNG CHÍNH -->
            <div class="col-lg-8">
                <div style="background:#fff; border-radius:12px; overflow:hidden;
                            box-shadow:0 2px 12px rgba(0,0,0,0.08);">

                    <!-- ẢNH BÌA -->
                    <?php if(!empty($news['hinh_anh'])): ?>
                    <img src="<?= htmlspecialchars($news['hinh_anh']) ?>"
                         style="width:100%; max-height:420px; object-fit:cover;">
                    <?php endif; ?>

                    <div style="padding:28px 32px;">

                        <!-- DANH MỤC + NGÀY -->
                        <div style="display:flex; align-items:center; gap:12px; margin-bottom:14px; flex-wrap:wrap;">
                            <?php if(!empty($news['danh_muc'])): ?>
                            <span style="background:#e8f5e9; color:#005c2b; font-size:12px;
                                         font-weight:600; padding:4px 12px; border-radius:20px;">
                                <?= htmlspecialchars($news['danh_muc']) ?>
                            </span>
                            <?php endif; ?>
                            <span style="color:#aaa; font-size:13px;">
                                📅 <?= date('d/m/Y H:i', strtotime($news['ngay_dang'])) ?>
                            </span>
                            <span style="color:#aaa; font-size:13px;">
                                👁 <?= number_format($news['luot_xem']) ?> lượt xem
                            </span>
                        </div>

                        <!-- TIÊU ĐỀ -->
                        <h1 style="font-size:24px; font-weight:700; color:#013a1a;
                                   line-height:1.5; margin-bottom:16px;">
                            <?= htmlspecialchars($news['tieu_de']) ?>
                        </h1>

                        <!-- MÔ TẢ -->
                        <?php if(!empty($news['mo_ta'])): ?>
                        <p style="font-size:15px; color:#555; font-style:italic;
                                  border-left:4px solid #ffbc00; padding-left:16px;
                                  margin-bottom:24px; line-height:1.7;">
                            <?= htmlspecialchars($news['mo_ta']) ?>
                        </p>
                        <?php endif; ?>

                        <hr style="border-color:#f0f0f0; margin-bottom:24px;">

                        <!-- NỘI DUNG BÀI VIẾT -->
                        <div style="font-size:15px; color:#333; line-height:1.9;" class="news-content">
                            <?= $news['noi_dung'] ?>
                        </div>

                        <!-- CHIA SẺ -->
                        <div style="margin-top:32px; padding-top:20px; border-top:1px solid #f0f0f0;">
                            <span style="font-size:13px; color:#666; font-weight:600;">Chia sẻ:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>"
                               target="_blank"
                               style="display:inline-flex; align-items:center; gap:6px;
                                      margin-left:10px; background:#1877f2; color:#fff;
                                      padding:6px 14px; border-radius:20px; font-size:13px;
                                      text-decoration:none;">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                        </div>
                    </div>
                </div>

                <!-- NÚT QUAY LẠI -->
                <div style="margin-top:20px;">
                    <a href="tintuc.php"
                       style="display:inline-flex; align-items:center; gap:8px;
                              background:#005c2b; color:#fff; padding:10px 22px;
                              border-radius:20px; font-size:13px; text-decoration:none;
                              font-weight:500;">
                        ← Quay lại tin tức
                    </a>
                </div>
            </div>

            <!-- SIDEBAR -->
            <div class="col-lg-4">

                <!-- BÀI VIẾT LIÊN QUAN -->
                <?php if(!empty($related)): ?>
                <div style="background:#fff; border-radius:12px; padding:20px;
                            box-shadow:0 2px 12px rgba(0,0,0,0.08); margin-bottom:20px;">
                    <h5 style="font-size:15px; font-weight:700; color:#013a1a;
                               margin-bottom:16px; padding-bottom:10px;
                               border-bottom:2px solid #ffbc00;">
                        📌 Bài viết liên quan
                    </h5>
                    <?php foreach($related as $r): ?>
                    <a href="baiviet.php?slug=<?= htmlspecialchars($r['slug'] ?? $r['id']) ?>"
                       style="display:flex; gap:12px; margin-bottom:14px; text-decoration:none;
                              padding-bottom:14px; border-bottom:1px solid #f5f5f5;">
                        <img src="<?= !empty($r['hinh_anh']) ? htmlspecialchars($r['hinh_anh']) : 'https://via.placeholder.com/80x60?text=No+Image' ?>"
                             style="width:80px; height:60px; object-fit:cover; border-radius:6px; flex-shrink:0;">
                        <div>
                            <div style="font-size:13px; font-weight:600; color:#013a1a;
                                        line-height:1.5;
                                        display:-webkit-box; -webkit-line-clamp:2;
                                        -webkit-box-orient:vertical; overflow:hidden;">
                                <?= htmlspecialchars($r['tieu_de']) ?>
                            </div>
                            <div style="font-size:11px; color:#aaa; margin-top:4px;">
                                📅 <?= date('d/m/Y', strtotime($r['ngay_dang'])) ?>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- TIN TỨC MỚI NHẤT -->
                <div style="background:#fff; border-radius:12px; padding:20px;
                            box-shadow:0 2px 12px rgba(0,0,0,0.08);">
                    <h5 style="font-size:15px; font-weight:700; color:#013a1a;
                               margin-bottom:16px; padding-bottom:10px;
                               border-bottom:2px solid #ffbc00;">
                        🔥 Tin mới nhất
                    </h5>
                    <?php
                   // Tìm đoạn này và sửa lại
$stmt_latest = $pdo->prepare("
    SELECT id, tieu_de, slug, hinh_anh, ngay_dang
    FROM news 
    WHERE trang_thai = 'hien'
    ORDER BY ngay_dang DESC 
    LIMIT 5
");
$stmt_latest->execute();
$latest = $stmt_latest->fetchAll(PDO::FETCH_ASSOC);
                    foreach($latest as $l):
                    ?>
                    <a href="baiviet.php?slug=<?= htmlspecialchars($l['slug'] ?? $l['id']) ?>"
                       style="display:flex; gap:12px; margin-bottom:14px; text-decoration:none;
                              padding-bottom:14px; border-bottom:1px solid #f5f5f5;">
                        <img src="<?= !empty($l['hinh_anh']) ? htmlspecialchars($l['hinh_anh']) : 'https://via.placeholder.com/80x60?text=No+Image' ?>"
                             style="width:80px; height:60px; object-fit:cover; border-radius:6px; flex-shrink:0;">
                        <div>
                            <div style="font-size:13px; font-weight:600; color:#013a1a;
                                        line-height:1.5;
                                        display:-webkit-box; -webkit-line-clamp:2;
                                        -webkit-box-orient:vertical; overflow:hidden;">
                                <?= htmlspecialchars($l['tieu_de']) ?>
                            </div>
                            <div style="font-size:11px; color:#aaa; margin-top:4px;">
                                📅 <?= date('d/m/Y', strtotime($l['ngay_dang'])) ?>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- CSS cho nội dung bài viết -->
<style>
.news-content img { max-width:100%; border-radius:8px; margin:12px 0; }
.news-content h2, .news-content h3 { color:#013a1a; margin:20px 0 10px; }
.news-content p { margin-bottom:14px; }
.news-content ul, .news-content ol { padding-left:20px; margin-bottom:14px; }
.news-content blockquote {
    border-left:4px solid #ffbc00;
    padding:10px 16px;
    background:#fffdf0;
    margin:16px 0;
    color:#555;
    font-style:italic;
}
</style>

<?php include 'includes/footer.php'; ?>