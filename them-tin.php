<?php
require_once 'dp.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tieu_de    = trim($_POST['tieu_de'] ?? '');
    $mo_ta      = trim($_POST['mo_ta'] ?? '');
    $noi_dung   = $_POST['noi_dung'] ?? '';
    $danh_muc   = trim($_POST['danh_muc'] ?? '');
    $trang_thai = $_POST['trang_thai'] ?? 'hien';

    // Tạo slug từ tiêu đề
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $tieu_de)));
    $slug = $slug . '-' . time();

    // Xử lý upload ảnh
    $hinh_anh = '';
    if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === UPLOAD_ERR_OK) {
        $ext      = strtolower(pathinfo($_FILES['hinh_anh']['name'], PATHINFO_EXTENSION));
        $allowed  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (in_array($ext, $allowed)) {
            $upload_dir = 'uploads/news/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
            $filename = 'news_' . time() . '.' . $ext;
            if (move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $upload_dir . $filename)) {
                $hinh_anh = $upload_dir . $filename;
            }
        } else {
            $error = "Định dạng ảnh không hợp lệ.";
        }
    }

    if (empty($tieu_de)) {
        $error = "Vui lòng nhập tiêu đề bài viết.";
    }

    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO news (tieu_de, slug, mo_ta, noi_dung, hinh_anh, danh_muc, trang_thai)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$tieu_de, $slug, $mo_ta, $noi_dung, $hinh_anh, $danh_muc, $trang_thai]);
            header("Location: tintuc.php?msg=added");
            exit;
        } catch (PDOException $e) {
            $error = "Lỗi: " . $e->getMessage();
        }
    }
}

$page_title = "Đăng Bài Mới - Văn Hóa Gia Lai";
include 'includes/header.php';
?>

<div style="background:#f5f5f5; min-height:60vh; padding:40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- TIÊU ĐỀ -->
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
                    <div>
                        <h2 style="font-size:24px; font-weight:700; color:#013a1a; margin:0;">✏️ Đăng Bài Mới</h2>
                        <div style="width:50px; height:3px; background:#ffbc00; margin-top:8px;"></div>
                    </div>
                    <a href="tintuc.php"
                       style="background:#eee; color:#333; padding:8px 18px;
                              border-radius:20px; font-size:13px; text-decoration:none;">
                        ← Quay lại
                    </a>
                </div>

                <?php if($error): ?>
                <div style="background:#fff5f5; border-left:4px solid #e53e3e;
                            padding:12px 16px; border-radius:6px; margin-bottom:20px;
                            color:#e53e3e; font-size:14px;">
                    ❌ <?= $error ?>
                </div>
                <?php endif; ?>

                <!-- FORM -->
                <div style="background:#fff; border-radius:12px; padding:32px;
                            box-shadow:0 2px 12px rgba(0,0,0,0.08);">
                    <form method="POST" enctype="multipart/form-data">

                        <!-- TIÊU ĐỀ -->
                        <div style="margin-bottom:20px;">
                            <label style="display:block; font-weight:600; color:#333;
                                          font-size:14px; margin-bottom:8px;">
                                Tiêu đề <span style="color:#e53e3e;">*</span>
                            </label>
                            <input type="text" name="tieu_de"
                                   value="<?= htmlspecialchars($_POST['tieu_de'] ?? '') ?>"
                                   placeholder="Nhập tiêu đề bài viết..."
                                   style="width:100%; padding:10px 14px; border:1px solid #ddd;
                                          border-radius:8px; font-size:14px; outline:none;"
                                   required>
                        </div>

                        <!-- DANH MỤC -->
                        <div style="margin-bottom:20px;">
                            <label style="display:block; font-weight:600; color:#333;
                                          font-size:14px; margin-bottom:8px;">Danh mục</label>
                            <select name="danh_muc"
                                    style="width:100%; padding:10px 14px; border:1px solid #ddd;
                                           border-radius:8px; font-size:14px; outline:none; background:#fff;">
                                <option value="">-- Chọn danh mục --</option>
                                <option value="Lễ hội" <?= ($_POST['danh_muc']??'')==='Lễ hội'?'selected':'' ?>>🎉 Lễ hội</option>
                                <option value="Văn hóa" <?= ($_POST['danh_muc']??'')==='Văn hóa'?'selected':'' ?>>🏛 Văn hóa</option>
                                <option value="Ẩm thực" <?= ($_POST['danh_muc']??'')==='Ẩm thực'?'selected':'' ?>>🍜 Ẩm thực</option>
                                <option value="Du lịch" <?= ($_POST['danh_muc']??'')==='Du lịch'?'selected':'' ?>>✈️ Du lịch</option>
                                <option value="Dân tộc" <?= ($_POST['danh_muc']??'')==='Dân tộc'?'selected':'' ?>>👘 Dân tộc</option>
                                <option value="Tin tức" <?= ($_POST['danh_muc']??'')==='Tin tức'?'selected':'' ?>>📰 Tin tức</option>
                            </select>
                        </div>

                        <!-- MÔ TẢ NGẮN -->
                        <div style="margin-bottom:20px;">
                            <label style="display:block; font-weight:600; color:#333;
                                          font-size:14px; margin-bottom:8px;">Mô tả ngắn</label>
                            <textarea name="mo_ta" rows="3"
                                      placeholder="Tóm tắt nội dung bài viết..."
                                      style="width:100%; padding:10px 14px; border:1px solid #ddd;
                                             border-radius:8px; font-size:14px; outline:none; resize:vertical;"
                                      ><?= htmlspecialchars($_POST['mo_ta'] ?? '') ?></textarea>
                        </div>

                        <!-- NỘI DUNG -->
                        <div style="margin-bottom:20px;">
                            <label style="display:block; font-weight:600; color:#333;
                                          font-size:14px; margin-bottom:8px;">
                                Nội dung bài viết <span style="color:#e53e3e;">*</span>
                            </label>
                            <textarea name="noi_dung" id="noi_dung" rows="12"
                                      placeholder="Nhập nội dung bài viết..."
                                      style="width:100%; padding:10px 14px; border:1px solid #ddd;
                                             border-radius:8px; font-size:14px; outline:none; resize:vertical;"
                                      ><?= htmlspecialchars($_POST['noi_dung'] ?? '') ?></textarea>
                        </div>

                        <!-- ẢNH ĐẠI DIỆN -->
                        <div style="margin-bottom:20px;">
                            <label style="display:block; font-weight:600; color:#333;
                                          font-size:14px; margin-bottom:8px;">Ảnh đại diện</label>
                            <div style="border:2px dashed #ddd; border-radius:8px; padding:20px; text-align:center;">
                                <img id="previewImg" src=""
                                     style="display:none; max-width:100%; max-height:200px;
                                            border-radius:8px; margin-bottom:12px; object-fit:cover;">
                                <div id="uploadPlaceholder" style="color:#aaa; font-size:14px; margin-bottom:12px;">
                                    🖼 Chưa chọn ảnh
                                </div>
                                <label for="hinh_anh"
                                       style="background:#005c2b; color:#fff; padding:8px 20px;
                                              border-radius:20px; font-size:13px; cursor:pointer;">
                                    📁 Chọn ảnh
                                </label>
                                <input type="file" id="hinh_anh" name="hinh_anh"
                                       accept="image/*" class="d-none"
                                       onchange="previewImage(event)">
                            </div>
                        </div>

                        <!-- TRẠNG THÁI -->
                        <div style="margin-bottom:28px;">
                            <label style="display:block; font-weight:600; color:#333;
                                          font-size:14px; margin-bottom:8px;">Trạng thái</label>
                            <div style="display:flex; gap:16px;">
                                <label style="display:flex; align-items:center; gap:8px;
                                              font-size:14px; cursor:pointer;">
                                    <input type="radio" name="trang_thai" value="hien"
                                           <?= ($_POST['trang_thai']??'hien')==='hien'?'checked':'' ?>>
                                    <span style="color:#005c2b; font-weight:500;">👁 Hiển thị</span>
                                </label>
                                <label style="display:flex; align-items:center; gap:8px;
                                              font-size:14px; cursor:pointer;">
                                    <input type="radio" name="trang_thai" value="an"
                                           <?= ($_POST['trang_thai']??'')==='an'?'checked':'' ?>>
                                    <span style="color:#e53e3e; font-weight:500;">🙈 Ẩn</span>
                                </label>
                            </div>
                        </div>

                        <!-- NÚT GỬI -->
                        <div style="display:flex; gap:12px;">
                            <button type="submit"
                                    style="flex:1; background:#005c2b; color:#fff; border:none;
                                           padding:12px; border-radius:8px; font-size:15px;
                                           font-weight:600; cursor:pointer;">
                                🚀 Đăng bài
                            </button>
                            <a href="tintuc.php"
                               style="flex:0 0 120px; text-align:center; background:#eee;
                                      color:#333; padding:12px; border-radius:8px;
                                      font-size:15px; text-decoration:none;">
                                Hủy
                            </a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.style.display = 'block';
            document.getElementById('uploadPlaceholder').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}
</script>

<?php include 'includes/footer.php'; ?>