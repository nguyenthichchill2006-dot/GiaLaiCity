<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = $page_title ?? "Văn Hóa Gia Lai - Sắc Màu Tây Nguyên";
$page_desc  = $page_desc  ?? "Khám phá văn hóa Bahnar, Jrai, lễ hội, ẩm thực và di sản tỉnh Gia Lai.";

// Tự động phát hiện đường dẫn gốc
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
$base_url = ($current_dir === 'admin') ? '../' : '';
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?? 'vi' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
    <title><?= htmlspecialchars($page_title) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/style.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
        }

        /* ================= TẦNG 1: TOPBAR ================= */
        .topbar {
            background: #013a1a;
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .topbar .container-fluid {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-left span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .top-left i {
            color: #ffbc00;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top-right .social-icons a {
            margin-right: 10px;
            opacity: 0.9;
        }

        .top-right .social-icons a:hover {
            opacity: 1;
            color: #ffbc00;
        }

        /* Language Switcher */
        .language-switcher .dropdown-toggle {
            color: white !important;
            font-size: 14px;
            padding: 6px 12px;
            border: none;
            background: transparent;
        }

        .top-auth-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 10px;
        }

        .btn-top-auth {
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            padding: 4px 15px;
            font-size: 12px;
            color: white !important;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-top-auth:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
        }

        .btn-top-register {
            background: #ffbc00;
            color: #000 !important;
            border-color: #ffbc00;
            font-weight: 500;
        }

        .btn-top-register:hover {
            background: #ffcc33;
            border-color: #ffcc33;
        }

        .top-user-logged {
            background: rgba(255, 255, 255, 0.15);
            padding: 4px 12px;
            border-radius: 15px;
            color: #ffbc00 !important;
            font-weight: 500;
        }

        /* ================= TẦNG 2: NAVBAR ================= */
        .navbar-custom {
            background: #005c2b;
            padding: 10px 0;
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white !important;
        }

        .brand-wrapper img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid white;
        }

        .brand-text-box {
            display: flex;
            flex-direction: column;
        }

        .brand-main-title {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: 0.5px;
        }

        .brand-sub-title {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.75);
        }

        .navbar-custom .nav-link {
            color: white !important;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            padding: 8px 12px !important;
        }

        .navbar-custom .nav-item:hover .nav-link,
        .navbar-custom .nav-item.active .nav-link {
            color: #ffbc00 !important;
        }

        .dropdown-menu {
            background: white;
            border: none;
            border-radius: 4px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            z-index: 9999;
        }

        .dropdown-item {
            font-size: 13px;
            padding: 8px 20px;
            color: #333;
        }

        .dropdown-item:hover {
            background: #005c2b;
            color: white;
        }

        @media (max-width: 991.98px) {
            .top-left, .top-right .social-icons {
                display: none !important;
            }
            .topbar {
                padding: 6px 0;
            }
            .topbar .container-fluid {
                justify-content: center;
            }
        }
    </style>
    </head>
<body>
<div class="topbar">
    <div class="container-fluid px-lg-5">
        <div class="top-left">
            <span><i class="fa-solid fa-circle-check"></i> <?= $lang['welcome'] ?? 'Chào mừng đến với Văn hóa Gia Lai' ?></span>
            <span><i class="fa-solid fa-envelope"></i> vanhoagialai@gmail.com</span>
            <span><i class="fa-solid fa-phone"></i> 0375818959</span>
        </div>
        
        <div class="top-right">
            <div class="social-icons d-inline-flex">
                <a href="https://www.facebook.com/profile.php?id=61574346975994"><i class="fab fa-facebook-f"></i></a>
            </div>
            

            <!-- PHẦN TÀI KHOẢN NGƯỜI DÙNG - ĐÃ SỬA -->
<!-- PHẦN TÀI KHOẢN NGƯỜI DÙNG -->
<div class="top-auth-actions">
    <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
        <div style="position:relative; display:inline-block;">
            <button id="userDropBtn"
                    type="button"
                    onclick="toggleUserDrop()"
                    style="display:inline-flex; align-items:center; gap:8px;
                           padding:4px 12px 4px 6px;
                           border:1px solid rgba(255,255,255,0.4);
                           border-radius:20px;
                           background:rgba(255,255,255,0.12);
                           color:#ffbc00;
                           font-size:13px;
                           font-weight:500;
                           cursor:pointer;">
                <?php if(!empty($_SESSION['user_avatar'])): ?>
                    <img src="<?= htmlspecialchars($base_url . $_SESSION['user_avatar']) ?>"
                         style="width:24px; height:24px; object-fit:cover; border-radius:50%; border:1px solid rgba(255,255,255,0.4);">
                <?php else: ?>
                    <span style="width:24px; height:24px; border-radius:50%;
                                 background:#ffbc00; color:#013a1a;
                                 display:flex; align-items:center; justify-content:center;
                                 font-size:11px; font-weight:700;">
                        <?= strtoupper(substr($_SESSION['user'], 0, 1)) ?>
                    </span>
                <?php endif; ?>
                <?= htmlspecialchars(substr($_SESSION['user'], 0, 12)) ?>
                <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                    <path d="M2 4l4 4 4-4" stroke="#ffbc00" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </button>

            <div id="userDropMenu"
                 style="display:none; position:absolute; top:calc(100% + 8px); right:0;
                        min-width:200px; background:#fff; border:1px solid #eee;
                        border-radius:10px; padding:6px; z-index:9999;
                        box-shadow:0 6px 20px rgba(0,0,0,0.15);">
                <a href="<?= $base_url ?>profile.php"
                   style="display:flex; align-items:center; gap:10px; padding:8px 12px;
                          border-radius:6px; color:#333; font-size:13px; text-decoration:none;"
                   onmouseover="this.style.background='#f0f7f0';this.style.color='#005c2b'"
                   onmouseout="this.style.background='transparent';this.style.color='#333'">
                    👤 Chỉnh sửa thông tin
                </a>

                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="<?= $base_url ?>admin/index.php"
                   style="display:flex; align-items:center; gap:10px; padding:8px 12px;
                          border-radius:6px; color:#333; font-size:13px; text-decoration:none;"
                   onmouseover="this.style.background='#f0f7f0';this.style.color='#005c2b'"
                   onmouseout="this.style.background='transparent';this.style.color='#333'">
                    ⚙️ Trang quản trị
                </a>
                <?php endif; ?>

                <div style="border-top:1px solid #f0f0f0; margin:6px 0;"></div>

                <a href="<?= $base_url ?>logout.php"
                   style="display:flex; align-items:center; gap:10px; padding:8px 12px;
                          border-radius:6px; color:#e53e3e; font-size:13px; text-decoration:none;"
                   onmouseover="this.style.background='#fff5f5'"
                   onmouseout="this.style.background='transparent'">
                    🚪 Đăng xuất
                </a>
            </div>
        </div>

    <?php else: ?>
        <a href="<?= $base_url ?>login.php" class="btn-top-auth">Đăng nhập</a>
        <a href="<?= $base_url ?>register.php" class="btn-top-auth btn-top-register">Đăng ký</a>
    <?php endif; ?>
</div>
        </div>
    </div>
</div>

<!-- Phần Navbar giữ nguyên -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid px-lg-5">
        <a class="brand-wrapper" href="<?= $base_url ?>index.php">
            <img src="<?= $base_url ?>avtgl.jpg" alt="Logo Gia Lai Culture">
            <div class="brand-text-box">
                <span class="brand-main-title"><?= $lang['brand_title'] ?? 'Gia Lai Culture' ?></span>
                <span class="brand-sub-title"><?= $lang['brand_subtitle'] ?? 'Kết nối tinh hoa - Lan tỏa bản sắc' ?></span>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>index.php"><?= $lang['home'] ?? 'Trang chủ' ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>vanhoa.php"><?= $lang['culture'] ?? 'Văn hóa' ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>dantoc.php"><?= $lang['ethnic_groups'] ?? 'Các dân tộc' ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>diadiem.php"><?= $lang['destinations'] ?? 'Điểm đến' ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>amthuc.php"><?= $lang['cuisine'] ?? 'Ẩm thực' ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>tintuc.php"><?= $lang['news'] ?? 'Tin tức' ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>contact.php"><?= $lang['contact'] ?? 'Liên hệ' ?></a></li>
                
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $base_url ?>assets/js/script.js"></script>
<script>
function toggleUserDrop() {
    var menu = document.getElementById('userDropMenu');
    if (menu) menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
}
document.addEventListener('click', function(e) {
    var btn  = document.getElementById('userDropBtn');
    var menu = document.getElementById('userDropMenu');
    if (btn && menu && !btn.contains(e.target)) menu.style.display = 'none';
});
</script>
</body>
</html>