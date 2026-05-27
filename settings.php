<?php
// settings.php
session_start();
require_once 'config/db.php';
require_once 'includes/functions.php';

$page_title = "Cài đặt Hệ thống - Gia Lai Culture";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Xử lý cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Upload Logo
    if (!empty($_FILES['logo']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        
        $file_name = "logo_" . time() . "_" . basename($_FILES['logo']['name']);
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
            $stmt = $pdo->prepare("INSERT INTO settings (`key`, `value`) VALUES ('logo', ?) ON DUPLICATE KEY UPDATE `value` = ?");
            $stmt->execute([$target_file, $target_file]);
        }
    }

    // Các setting khác
    $settings = [
        'site_name'        => trim($_POST['site_name'] ?? ''),
        'site_description' => trim($_POST['site_description'] ?? ''),
        'email'            => trim($_POST['email'] ?? ''),
        'phone'            => trim($_POST['phone'] ?? ''),
        'address'          => trim($_POST['address'] ?? ''),
        'facebook'         => trim($_POST['facebook'] ?? ''),
        'youtube'          => trim($_POST['youtube'] ?? ''),
        'instagram'        => trim($_POST['instagram'] ?? ''),
        'maintenance_mode' => isset($_POST['maintenance_mode']) ? '1' : '0',
    ];

    foreach ($settings as $key => $value) {
        $stmt = $pdo->prepare("INSERT INTO settings (`key`, `value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `value` = ?");
        $stmt->execute([$key, $value, $value]);
    }

    $success = "✅ Cài đặt đã được cập nhật thành công!";
}

?>

<?php include 'includes/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-cogs"></i> Cài đặt Hệ thống</h4>
                </div>
                
                <div class="card-body">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general">Thông tin chung</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#branding">Logo & Thương hiệu</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact">Liên hệ</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-target="#social" data-bs-toggle="tab">Mạng xã hội</button>
                        </li>
                    </ul>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="tab-content">
                            
                            <!-- Tab 1: Thông tin chung -->
                            <div class="tab-pane fade show active" id="general">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="form-label fw-bold">Tên Website</label>
                                        <input type="text" name="site_name" class="form-control form-control-lg" 
                                               value="<?= htmlspecialchars(getSetting('site_name', 'Gia Lai Culture')) ?>">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label fw-bold">Mô tả Website</label>
                                    <textarea name="site_description" class="form-control" rows="4"><?= htmlspecialchars(getSetting('site_description')) ?></textarea>
                                </div>
                            </div>

                            <!-- Tab 2: Logo & Branding -->
                            <div class="tab-pane fade" id="branding">
                                <div class="text-center mb-4">
                                    <label class="form-label fw-bold">Logo hiện tại</label><br>
                                    <?php if($logo = getSetting('logo')): ?>
                                        <img src="<?= htmlspecialchars($logo) ?>" class="img-fluid border p-2" style="max-height: 180px;">
                                    <?php else: ?>
                                        <p class="text-muted">Chưa có logo</p>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                                <small class="text-muted">Khuyến nghị: PNG, kích thước 300x300px</small>
                            </div>

                            <!-- Tab 3: Liên hệ -->
                            <div class="tab-pane fade" id="contact">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Email liên hệ</label>
                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars(getSetting('email')) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars(getSetting('phone')) ?>">
                                    </div>
                                    <div class="col-12">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="address" class="form-control" value="<?= htmlspecialchars(getSetting('address')) ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Tab 4: Mạng xã hội -->
                            <div class="tab-pane fade" id="social">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Facebook</label>
                                        <input type="url" name="facebook" class="form-control" value="<?= htmlspecialchars(getSetting('facebook')) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Youtube</label>
                                        <input type="url" name="youtube" class="form-control" value="<?= htmlspecialchars(getSetting('youtube')) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Instagram</label>
                                        <input type="url" name="instagram" class="form-control" value="<?= htmlspecialchars(getSetting('instagram')) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" name="maintenance_mode" class="form-check-input" 
                                       <?= getSetting('maintenance_mode') == '1' ? 'checked' : '' ?>>
                                <label class="form-check-label">Bật chế độ bảo trì website</label>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                <i class="fas fa-save"></i> Lưu tất cả cài đặt
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>