<?php
require_once 'dp.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = "Tin Tức - Văn Hóa Gia Lai";
$page_desc  = "Cập nhật những thông tin mới nhất về văn hóa Gia Lai.";

$is_admin   = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$is_logged  = isset($_SESSION['user']) && !empty($_SESSION['user']);

// XỬ LÝ XÓA BÀI (chỉ admin)
if ($is_admin && isset($_GET['xoa']) && is_numeric($_GET['xoa'])) {
    $pdo->prepare("DELETE FROM news WHERE id = ?")->execute([$_GET['xoa']]);
    header("Location: tintuc.php?msg=deleted");
    exit;
}

// XỬ LÝ ẨN/HIỆN BÀI (chỉ admin)
if ($is_admin && isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $stmt = $pdo->prepare("SELECT trang_thai FROM news WHERE id = ?");
    $stmt->execute([$_GET['toggle']]);
    $current = $stmt->fetchColumn();
    $new_status = ($current === 'hien') ? 'an' : 'hien';
    $pdo->prepare("UPDATE news SET trang_thai = ? WHERE id = ?")->execute([$new_status, $_GET['toggle']]);
    header("Location: tintuc.php?msg=updated");
    exit;
}

// LẤY DANH SÁCH TIN TỨC
if ($is_admin) {
    // Admin thấy tất cả kể cả bài ẩn
    $stmt = $pdo->prepare("SELECT id, tieu_de, slug, mo_ta, hinh_anh, danh_muc, ngay_dang, luot_xem, trang_thai FROM news ORDER BY ngay_dang DESC");
    $stmt->execute();
} else {
    $stmt = $pdo->prepare("SELECT id, tieu_de, slug, mo_ta, hinh_anh, danh_muc, ngay_dang, luot_xem FROM news WHERE trang_thai = 'hien' ORDER BY ngay_dang DESC");
    $stmt->execute();
}
$news_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div style="background:#f5f5f5; min-height:60vh; padding:40px 0;">
    <div class="container">

        <!-- TIÊU ĐỀ + NÚT THÊM BÀI (admin) -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:32px; flex-wrap:wrap; gap:12px;">
            <div>
                <h2 style="font-size:26px; font-weight:700; color:#013a1a; margin:0;">📰 Tin Tức</h2>
                <div style="width:50px; height:3px; background:#ffbc00; margin-top:8px;"></div>
            </div>
            <?php if($is_logged): ?>
            <a href="them-tin.php"
               style="display:inline-flex; align-items:center; gap:8px;
                      background:#005c2b; color:#fff; padding:10px 20px;
                      border-radius:20px; font-size:13px; text-decoration:none; font-weight:500;">
                ✏️ Đăng bài mới
            </a>
            <?php endif; ?>
        </div>

        <!-- THÔNG BÁO -->
        <?php if(isset($_GET['msg'])): ?>
        <div style="background:<?= $_GET['msg']==='deleted' ? '#fff5f5' : '#f0fff4' ?>;
                    border-left:4px solid <?= $_GET['msg']==='deleted' ? '#e53e3e' : '#005c2b' ?>;
                    padding:12px 16px; border-radius:6px; margin-bottom:20px; font-size:14px;
                    color:<?= $_GET['msg']==='deleted' ? '#e53e3e' : '#005c2b' ?>;">
            <?= $_GET['msg']==='deleted' ? '🗑 Đã xóa bài viết.' : '✅ Cập nhật thành công.' ?>
        </div>
        <?php endif; ?>

        <?php if(empty($news_list)): ?>
            <div style="text-align:center; padding:60px 20px; color:#999;">
                <div style="font-size:48px; margin-bottom:12px;">📭</div>
                <p style="font-size:16px;">Chưa có tin tức nào được đăng.</p>
                <?php if($is_admin): ?>
                <a href="them-tin.php" style="display:inline-block; margin-top:12px;
                   background:#005c2b; color:#fff; padding:10px 24px;
                   border-radius:20px; text-decoration:none; font-size:14px;">
                    ✏️ Đăng bài ngay
                </a>
                <?php endif; ?>
            </div>
        <?php else: ?>

        <div class="row g-4">
            <?php foreach($news_list as $index => $news): ?>

            <?php if($index === 0 && !$is_admin): ?>
            <!-- BÀI ĐẦU TIÊN NỔI BẬT (chỉ hiện với user) -->
            <div class="col-12">
                <a href="baiviet.php?slug=<?= htmlspecialchars($news['slug'] ?? $news['id']) ?>"
                   style="text-decoration:none; display:block;">
                    <div style="background:#fff; border-radius:12px; overflow:hidden;
                                box-shadow:0 2px 12px rgba(0,0,0,0.08); display:flex;
                                transition:box-shadow 0.3s, transform 0.3s;"
                         onmouseover="this.style.boxShadow='0 6px 24px rgba(0,0,0,0.15)';this.style.transform='translateY(-2px)'"
                         onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,0.08)';this.style.transform='translateY(0)'">
                        <div style="flex:0 0 45%; max-width:45%;">
                            <img src="<?= !empty($news['hinh_anh']) ? htmlspecialchars($news['hinh_anh']) : 'https://via.placeholder.com/600x300?text=No+Image' ?>"
                                 style="width:100%; height:280px; object-fit:cover;">
                        </div>
                        <div style="flex:1; padding:28px 32px; display:flex; flex-direction:column; justify-content:center;">
                            <?php if(!empty($news['danh_muc'])): ?>
                            <span style="background:#e8f5e9; color:#005c2b; font-size:11px;
                                         font-weight:600; padding:3px 10px; border-radius:20px;
                                         display:inline-block; width:fit-content; margin-bottom:12px;">
                                <?= htmlspecialchars($news['danh_muc']) ?>
                            </span>
                            <?php endif; ?>
                            <h3 style="font-size:22px; font-weight:700; color:#013a1a; line-height:1.4; margin-bottom:12px;">
                                <?= htmlspecialchars($news['tieu_de']) ?>
                            </h3>
                            <?php if(!empty($news['mo_ta'])): ?>
                            <p style="color:#666; font-size:14px; line-height:1.7; margin-bottom:16px;">
                                <?= htmlspecialchars(mb_substr($news['mo_ta'], 0, 180)) ?>...
                            </p>
                            <?php endif; ?>
                            <div style="display:flex; gap:16px; font-size:12px; color:#999;">
                                <span>📅 <?= date('d/m/Y', strtotime($news['ngay_dang'])) ?></span>
                                <span>👁 <?= number_format($news['luot_xem']) ?> lượt xem</span>
                            </div>
                            <div style="margin-top:18px;">
                                <span style="background:#005c2b; color:#fff; font-size:13px;
                                             padding:8px 20px; border-radius:20px;">Đọc tiếp →</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <?php else: ?>
            <!-- CARD THƯỜNG -->
            <div class="col-md-4">
                <div style="background:#fff; border-radius:12px; overflow:hidden;
                            box-shadow:0 2px 12px rgba(0,0,0,0.08); height:100%;
                            transition:box-shadow 0.3s, transform 0.3s;
                            <?= ($is_admin && $news['trang_thai']==='an') ? 'opacity:0.6;' : '' ?>"
                     onmouseover="this.style.boxShadow='0 6px 24px rgba(0,0,0,0.15)';this.style.transform='translateY(-3px)'"
                     onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,0.08)';this.style.transform='translateY(0)'">

                    <div style="position:relative;">
                        <img src="<?= !empty($news['hinh_anh']) ? htmlspecialchars($news['hinh_anh']) : 'https://via.placeholder.com/400x200?text=No+Image' ?>"
                             style="width:100%; height:200px; object-fit:cover;">
                        <?php if(!empty($news['danh_muc'])): ?>
                        <span style="position:absolute; top:12px; left:12px; background:#005c2b;
                                     color:#fff; font-size:11px; font-weight:600;
                                     padding:3px 10px; border-radius:20px;">
                            <?= htmlspecialchars($news['danh_muc']) ?>
                        </span>
                        <?php endif; ?>
                        <?php if($is_admin && $news['trang_thai']==='an'): ?>
                        <span style="position:absolute; top:12px; right:12px; background:#e53e3e;
                                     color:#fff; font-size:11px; font-weight:600;
                                     padding:3px 10px; border-radius:20px;">
                            🙈 Đang ẩn
                        </span>
                        <?php endif; ?>
                    </div>

                    <div style="padding:18px;">
                        <h5 style="font-size:15px; font-weight:700; color:#013a1a; line-height:1.5; margin-bottom:10px;
                                   display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                            <?= htmlspecialchars($news['tieu_de']) ?>
                        </h5>
                        <?php if(!empty($news['mo_ta'])): ?>
                        <p style="color:#777; font-size:13px; line-height:1.6; margin-bottom:14px;
                                  display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                            <?= htmlspecialchars($news['mo_ta']) ?>
                        </p>
                        <?php endif; ?>

                        <div style="display:flex; justify-content:space-between; font-size:12px;
                                    color:#aaa; border-top:1px solid #f0f0f0; padding-top:10px; margin-bottom:12px;">
                            <span>📅 <?= date('d/m/Y', strtotime($news['ngay_dang'])) ?></span>
                            <span>👁 <?= number_format($news['luot_xem']) ?></span>
                        </div>

                        <!-- NÚT ĐỌC TIẾP -->
                        <a href="baiviet.php?slug=<?= htmlspecialchars($news['slug'] ?? $news['id']) ?>"
                           style="display:block; text-align:center; background:#005c2b; color:#fff;
                                  padding:8px; border-radius:8px; font-size:13px; text-decoration:none;
                                  font-weight:500;">
                            Đọc tiếp →
                        </a>

                        <!-- NÚT ADMIN -->
                        <?php if($is_admin): ?>
                        <div style="display:flex; gap:8px; margin-top:8px;">
                            
                            <a href="tintuc.php?toggle=<?= $news['id'] ?>"
                               style="flex:1; text-align:center;
                                      background:<?= $news['trang_thai']==='hien' ? '#eee' : '#e8f5e9' ?>;
                                      color:<?= $news['trang_thai']==='hien' ? '#666' : '#005c2b' ?>;
                                      padding:7px; border-radius:8px; font-size:12px;
                                      text-decoration:none; font-weight:600;">
                                <?= $news['trang_thai']==='hien' ? '🙈 Ẩn' : '👁 Hiện' ?>
                            </a>
                            <a href="tintuc.php?xoa=<?= $news['id'] ?>"
                               onclick="return confirm('Xóa bài này?')"
                               style="flex:1; text-align:center; background:#fff0f0; color:#e53e3e;
                                      padding:7px; border-radius:8px; font-size:12px;
                                      text-decoration:none; font-weight:600;">
                                🗑 Xóa
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>