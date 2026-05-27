<?php
session_start();

// Chỉ admin mới vào được
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../dp.php';

// CSRF TOKEN
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = '';

// HÀM TẠO SLUG TIẾNG VIỆT
function createSlug($str) {
    $unicode = [
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ','e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị','o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự','y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ','E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị','O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự','Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    ];
    foreach ($unicode as $nonUnicode => $uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = strtolower($str);
    $str = preg_replace('/[^a-z0-9\s-]/', '', $str);
    $str = preg_replace('/[\s-]+/', '-', $str);
    return trim($str, '-');
}

// XỬ LÝ FORM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Kiểm tra CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $message = '<div class="alert alert-danger">❌ Lỗi bảo mật! Vui lòng thử lại.</div>';
    } else {
        $tieu_de    = trim($_POST['tieu_de'] ?? '');
        $mo_ta      = trim($_POST['mo_ta'] ?? '');
        $noi_dung   = trim($_POST['noi_dung'] ?? '');
        $danh_muc   = trim($_POST['danh_muc'] ?? '');
        $trang_thai = $_POST['trang_thai'] ?? 'hien';
        $ten_tac_gia = $_SESSION['user'];

        $slug = createSlug($tieu_de) . '-' . time();

        if (empty($tieu_de) || empty($noi_dung)) {
            $message = '<div class="alert alert-danger">❌ Tiêu đề và nội dung không được để trống!</div>';
        } else {
            // UPLOAD ẢNH
            $hinh_anh = '';
            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === UPLOAD_ERR_OK) {
                $file     = $_FILES['hinh_anh'];
                $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed  = ['jpg','jpeg','png','gif','webp'];

                if ($file['size'] > 5 * 1024 * 1024) {
                    $message = '<div class="alert alert-danger">❌ Ảnh vượt quá 5MB!</div>';
                } elseif (!in_array($ext, $allowed)) {
                    $message = '<div class="alert alert-danger">❌ Định dạng ảnh không hợp lệ!</div>';
                } else {
                    $upload_dir = '../uploads/news/';
                    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
                    $filename = 'news_' . time() . '.' . $ext;
                    if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
                        $hinh_anh = 'uploads/news/' . $filename;
                    } else {
                        $message = '<div class="alert alert-danger">❌ Upload ảnh thất bại!</div>';
                    }
                }
            }

            // INSERT VÀO BẢNG news
            if (empty($message)) {
                try {
                    $stmt = $pdo->prepare("
                        INSERT INTO news (tieu_de, slug, mo_ta, noi_dung, hinh_anh, danh_muc, trang_thai, ten_tac_gia)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                    ");
                    $stmt->execute([$tieu_de, $slug, $mo_ta, $noi_dung, $hinh_anh, $danh_muc, $trang_thai, $ten_tac_gia]);
                    $message = '<div class="alert alert-success">✅ Đăng bài thành công! <a href="../tintuc.php">Xem tin tức</a></div>';
                    $tieu_de = $mo_ta = $noi_dung = '';
                } catch (PDOException $e) {
                    $message = '<div class="alert alert-danger">❌ Lỗi: ' . $e->getMessage() . '</div>';
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bài Viết - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background:#f5f5f5; font-family:'Segoe UI',sans-serif; }
        .sidebar { background:#1a1a1a; min-height:100vh; padding:20px 0; }
        .sidebar .nav-link { color:rgba(255,255,255,0.8); padding:10px 20px; font-size:14px; }
        .sidebar .nav-link:hover { color:#ffbc00; background:rgba(255,255,255,0.05); }
        .sidebar .brand { color:#ffbc00; font-size:16px; font-weight:700; padding:10px 20px 20px; border-bottom:1px solid #333; margin-bottom:10px; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 p-0 sidebar">
            <div class="brand">🌿 Admin Panel</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="posts.php" class="nav-link">
                        <i class="fa-solid fa-list me-2"></i> Quản lý bài viết
                    </a>
                </li>
                <li class="nav-item">
                    <a href="add-post.php" class="nav-link text-warning">
                        <i class="fa-solid fa-pen me-2"></i> Thêm bài viết
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a href="../logout.php" class="nav-link text-danger">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </div>

        <!-- NỘI DUNG -->
        <div class="col-md-10 p-4">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
                <div>
                    <h2 style="font-size:22px; font-weight:700; color:#013a1a; margin:0;">✍️ Thêm Bài Viết Mới</h2>
                    <div style="width:40px; height:3px; background:#ffbc00; margin-top:6px;"></div>
                </div>
                <a href="posts.php" style="background:#eee; color:#333; padding:8px 18px;
                   border-radius:8px; font-size:13px; text-decoration:none;">← Quản lý bài viết</a>
            </div>

            <?= $message ?>

            <div style="background:#fff; border-radius:12px; padding:28px;
                        box-shadow:0 2px 12px rgba(0,0,0,0.08);">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <div class="row">
                        <!-- CỘT TRÁI -->
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" name="tieu_de" class="form-control form-control-lg"
                                       value="<?= htmlspecialchars($tieu_de ?? '') ?>"
                                       placeholder="Nhập tiêu đề bài viết..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Mô tả ngắn</label>
                                <textarea name="mo_ta" rows="3" class="form-control"
                                          placeholder="Tóm tắt nội dung..."
                                          ><?= htmlspecialchars($mo_ta ?? '') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nội dung <span class="text-danger">*</span></label>
                                <textarea name="noi_dung" rows="15" class="form-control"
                                          required><?= htmlspecialchars($noi_dung ?? '') ?></textarea>
                            </div>
                        </div>

                        <!-- CỘT PHẢI -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Danh mục</label>
                                <select name="danh_muc" class="form-select">
                                    <option value="">-- Chọn danh mục --</option>
                                    <option value="Lễ hội">🎉 Lễ hội</option>
                                    <option value="Văn hóa">🏛 Văn hóa</option>
                                    <option value="Ẩm thực">🍜 Ẩm thực</option>
                                    <option value="Du lịch">✈️ Du lịch</option>
                                    <option value="Dân tộc">👘 Dân tộc</option>
                                    <option value="Tin tức">📰 Tin tức</option>
                                    <option value="Khác">📌 Khác</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Trạng thái</label>
                                <div style="display:flex; gap:16px;">
                                    <label style="cursor:pointer; font-size:14px;">
                                        <input type="radio" name="trang_thai" value="hien" checked> 👁 Hiển thị
                                    </label>
                                    <label style="cursor:pointer; font-size:14px;">
                                        <input type="radio" name="trang_thai" value="an"> 🙈 Ẩn
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Ảnh đại diện</label>
                                <div style="border:2px dashed #ddd; border-radius:8px; padding:16px; text-align:center;">
                                    <img id="previewImg" src="" style="display:none; max-width:100%;
                                         max-height:160px; border-radius:6px; margin-bottom:10px;">
                                    <div id="placeholder" style="color:#aaa; font-size:13px; margin-bottom:10px;">
                                        🖼 Chưa chọn ảnh
                                    </div>
                                    <label for="hinh_anh" style="background:#005c2b; color:#fff;
                                           padding:7px 18px; border-radius:6px; font-size:13px; cursor:pointer;">
                                        📁 Chọn ảnh
                                    </label>
                                    <input type="file" id="hinh_anh" name="hinh_anh"
                                           accept="image/*" class="d-none" onchange="previewImg(event)">
                                    <div style="font-size:11px; color:#aaa; margin-top:8px;">jpg, png, webp, gif — tối đa 5MB</div>
                                </div>
                            </div>

                            <div style="background:#f9f9f9; border-radius:8px; padding:12px; font-size:13px; color:#555;">
                                👤 Tác giả: <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex; gap:10px; margin-top:20px;">
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            <i class="fa-solid fa-paper-plane me-2"></i> Đăng bài
                        </button>
                        <a href="posts.php" class="btn btn-secondary btn-lg">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('textarea[name="noi_dung"]'), {
    toolbar: ['heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','imageUpload','undo','redo']
}).catch(console.error);

function previewImg(event) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('previewImg').style.display = 'block';
            document.getElementById('placeholder').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}
</script>
</body>
</html>