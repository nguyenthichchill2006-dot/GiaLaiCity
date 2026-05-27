<?php
session_start();

// Chỉ admin mới vào được
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../dp.php';

// XỬ LÝ XÓA
if (isset($_GET['xoa']) && is_numeric($_GET['xoa'])) {
    // Lấy ảnh để xóa file
    $stmt = $pdo->prepare("SELECT hinh_anh FROM news WHERE id = ?");
    $stmt->execute([$_GET['xoa']]);
    $old = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($old['hinh_anh']) && file_exists('../' . $old['hinh_anh'])) {
        unlink('../' . $old['hinh_anh']);
    }
    $pdo->prepare("DELETE FROM news WHERE id = ?")->execute([$_GET['xoa']]);
    header("Location: posts.php?msg=deleted");
    exit;
}

// XỬ LÝ ẨN/HIỆN
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $stmt = $pdo->prepare("SELECT trang_thai FROM news WHERE id = ?");
    $stmt->execute([$_GET['toggle']]);
    $current = $stmt->fetchColumn();
    $new_status = ($current === 'hien') ? 'an' : 'hien';
    $pdo->prepare("UPDATE news SET trang_thai = ? WHERE id = ?")->execute([$new_status, $_GET['toggle']]);
    header("Location: posts.php?msg=updated");
    exit;
}

$page_title = "Quản lý Bài viết";
include '../includes/header.php';

// Lấy tất cả bài viết
$stmt = $pdo->query("SELECT id, tieu_de, danh_muc, luot_xem, ngay_dang, trang_thai, ten_tac_gia FROM news ORDER BY ngay_dang DESC");
$news_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid" style="background:#f5f5f5; min-height:80vh;">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 p-0" style="background:#1a1a1a; min-height:80vh;">
            <?php include 'sidebar.php'; ?>
        </div>

        <!-- NỘI DUNG CHÍNH -->
        <div class="col-md-10 p-4">

            <!-- TIÊU ĐỀ -->
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
                <div>
                    <h2 style="font-size:22px; font-weight:700; color:#013a1a; margin:0;">📝 Quản lý Bài viết</h2>
                    <div style="width:40px; height:3px; background:#ffbc00; margin-top:6px;"></div>
                </div>
                <a href="../them-tin.php"
                   style="display:inline-flex; align-items:center; gap:8px;
                          background:#005c2b; color:#fff; padding:10px 20px;
                          border-radius:8px; font-size:14px; text-decoration:none; font-weight:500;">
                    ✏️ Thêm bài viết mới
                </a>
            </div>

            <!-- THÔNG BÁO -->
            <?php if(isset($_GET['msg'])): ?>
            <div style="background:<?= $_GET['msg']==='deleted' ? '#fff5f5' : '#f0fff4' ?>;
                        border-left:4px solid <?= $_GET['msg']==='deleted' ? '#e53e3e' : '#005c2b' ?>;
                        padding:12px 16px; border-radius:6px; margin-bottom:20px;
                        color:<?= $_GET['msg']==='deleted' ? '#e53e3e' : '#005c2b' ?>; font-size:14px;">
                <?= $_GET['msg']==='deleted' ? '🗑 Đã xóa bài viết.' : '✅ Cập nhật thành công.' ?>
            </div>
            <?php endif; ?>

            <!-- BẢNG DANH SÁCH -->
            <div style="background:#fff; border-radius:12px; overflow:hidden;
                        box-shadow:0 2px 12px rgba(0,0,0,0.08);">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr style="background:#013a1a; color:#fff;">
                            <th style="padding:14px 16px; font-size:13px; width:5%;">ID</th>
                            <th style="padding:14px 16px; font-size:13px;">Tiêu đề</th>
                            <th style="padding:14px 16px; font-size:13px;">Danh mục</th>
                            <th style="padding:14px 16px; font-size:13px;">Tác giả</th>
                            <th style="padding:14px 16px; font-size:13px;">Lượt xem</th>
                            <th style="padding:14px 16px; font-size:13px;">Ngày đăng</th>
                            <th style="padding:14px 16px; font-size:13px;">Trạng thái</th>
                            <th style="padding:14px 16px; font-size:13px; width:18%;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($news_list)): ?>
                        <tr>
                            <td colspan="8" style="text-align:center; padding:40px; color:#aaa;">
                                📭 Chưa có bài viết nào.
                            </td>
                        </tr>
                    <?php else: ?>
                    <?php foreach($news_list as $row): ?>
                        <tr style="border-bottom:1px solid #f5f5f5;">
                            <td style="padding:12px 16px; font-size:13px; color:#aaa;">#<?= $row['id'] ?></td>
                            <td style="padding:12px 16px;">
                                <div style="font-size:14px; font-weight:600; color:#013a1a;
                                            max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    <?= htmlspecialchars($row['tieu_de']) ?>
                                </div>
                            </td>
                            <td style="padding:12px 16px;">
                                <?php if(!empty($row['danh_muc'])): ?>
                                <span style="background:#e8f5e9; color:#005c2b; font-size:11px;
                                             font-weight:600; padding:3px 10px; border-radius:20px;">
                                    <?= htmlspecialchars($row['danh_muc']) ?>
                                </span>
                                <?php else: ?>
                                <span style="color:#ccc; font-size:12px;">—</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding:12px 16px; font-size:13px; color:#555;">
                                <?= htmlspecialchars($row['ten_tac_gia'] ?? '—') ?>
                            </td>
                            <td style="padding:12px 16px; font-size:13px; color:#555;">
                                👁 <?= number_format($row['luot_xem']) ?>
                            </td>
                            <td style="padding:12px 16px; font-size:13px; color:#555;">
                                📅 <?= date('d/m/Y', strtotime($row['ngay_dang'])) ?>
                            </td>
                            <td style="padding:12px 16px;">
                                <?php if($row['trang_thai'] === 'hien'): ?>
                                <span style="background:#e8f5e9; color:#005c2b; font-size:11px;
                                             font-weight:600; padding:3px 10px; border-radius:20px;">
                                    👁 Hiển thị
                                </span>
                                <?php else: ?>
                                <span style="background:#fff5f5; color:#e53e3e; font-size:11px;
                                             font-weight:600; padding:3px 10px; border-radius:20px;">
                                    🙈 Đang ẩn
                                </span>
                                <?php endif; ?>
                            </td>
                            <td style="padding:12px 16px;">
                                <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                   
                                    <a href="posts.php?toggle=<?= $row['id'] ?>"
                                       style="background:<?= $row['trang_thai']==='hien' ? '#eee' : '#e8f5e9' ?>;
                                              color:<?= $row['trang_thai']==='hien' ? '#666' : '#005c2b' ?>;
                                              padding:5px 12px; border-radius:6px; font-size:12px;
                                              text-decoration:none; font-weight:600;">
                                        <?= $row['trang_thai']==='hien' ? '🙈 Ẩn' : '✅ Duyệt' ?>
                                    </a>
                                    <a href="posts.php?xoa=<?= $row['id'] ?>"
                                       onclick="return confirm('Xóa bài viết này?')"
                                       style="background:#fff0f0; color:#e53e3e; padding:5px 12px;
                                              border-radius:6px; font-size:12px; text-decoration:none; font-weight:600;">
                                        🗑 Xóa
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- TỔNG SỐ -->
            <div style="margin-top:12px; font-size:13px; color:#888;">
                Tổng: <strong><?= count($news_list) ?></strong> bài viết
            </div>

        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>