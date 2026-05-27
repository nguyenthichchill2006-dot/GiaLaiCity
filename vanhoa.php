<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = "Văn Hóa Gia Lai Mới";
$page_desc  = "Kết hợp tinh hoa Tây Nguyên và Duyên hải miền Trung";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1b5e20;
            --accent: #ffbc00;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(to bottom, #f8f9fa, #e9f5eb);
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #0f3d1f, #1b5e20, #2e7d32);
            color: white;
            padding: 100px 0 80px;
            text-align: center;
            position: relative;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://source.unsplash.com/random/1920x1080/?mountain,forest') center/cover no-repeat;
            opacity: 0.15;
        }

        header h1 {
            font-size: 3.8rem;
            font-weight: 800;
            text-shadow: 0 5px 15px rgba(0,0,0,0.4);
            margin-bottom: 15px;
        }

        header p {
            font-size: 1.4rem;
            max-width: 900px;
            margin: 0 auto;
            opacity: 0.95;
        }

        .tag {
            background: rgba(255, 188, 0, 0.9);
            color: #000;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            height: 100%;
            background: white;
        }

        .card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 40px rgba(27, 94, 32, 0.25);
        }

        .card img {
            height: 260px;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .card:hover img {
            transform: scale(1.12);
        }

        .card-body {
            padding: 28px;
        }

        .card h2 {
            font-size: 1.45rem;
            color: var(--primary);
            margin-bottom: 14px;
        }

        .home-btn {
            text-align: center;
            margin: 80px 0;
        }

        .btn-home {
            background: linear-gradient(90deg, var(--primary), #2e7d32);
            color: white;
            padding: 18px 50px;
            font-size: 1.4rem;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 10px 30px rgba(27, 94, 32, 0.4);
            transition: all 0.4s;
        }

        .btn-home:hover {
            transform: scale(1.08);
            box-shadow: 0 15px 35px rgba(27, 94, 32, 0.5);
            background: linear-gradient(90deg, #146c43, #1b5e20);
        }

        footer {
            background: #0f3d1f;
            color: #ddd;
            text-align: center;
            padding: 35px 0;
        }
    </style>
</head>
<body>

<header>
    <div class="container position-relative">
        <h1>VĂN HÓA GIA LAI MỚI</h1>
        <p>Kết hợp tinh hoa Tây Nguyên (Gia Lai) và Duyên hải miền Trung (Bình Định)</p>
    </div>
</header>

<div class="container mt-5">
    <div class="row g-4">

        <div class="col-lg-6">
            <div class="card">
                <span class="tag">🌿 TÂY NGUYÊN</span>
                <img src="congchieng.jpg" alt="Cồng chiêng" class="w-100">
                <div class="card-body">
                    <h2>🎶 Không gian văn hóa Cồng Chiêng</h2>
                    <p>Cồng chiêng là di sản UNESCO, linh hồn của người Jrai và Bahnar, vang vọng trong từng lễ hội và nghi thức cộng đồng.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <span class="tag">🏠 TÂY NGUYÊN</span>
                <img src="nharong.jpg" alt="Nhà rông">
                <div class="card-body">
                    <h2>Nhà Rông - Biểu tượng văn hóa</h2>
                    <p>Trung tâm sinh hoạt cộng đồng, nơi diễn ra các cuộc họp làng, lễ hội và truyền dạy văn hóa.</p>
                </div>
            </div>
        </div>

        <!-- Các card khác giữ tương tự, mình rút gọn cho gọn code -->
        <div class="col-lg-6">
            <div class="card">
                <span class="tag">⚔️ BÌNH ĐỊNH</span>
                <img src="vo77.jpg" alt="Võ Bình Định">
                <div class="card-body">
                    <h2>Võ Cổ Truyền Bình Định</h2>
                    <p>Cái nôi võ thuật Việt Nam với tinh thần thượng võ bất diệt.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <span class="tag">🏯 BÌNH ĐỊNH</span>
                <img src="thapcham.jpg" alt="Tháp Chăm">
                <div class="card-body">
                    <h2>Tháp Chăm cổ</h2>
                    <p>Di tích kiến trúc Champa huyền bí, chứng nhân lịch sử hàng ngàn năm.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Nút Trang Chủ -->
    <div class="home-btn">
        <a href="index.php" class="btn-home">
            <i class="fas fa-home fa-lg"></i> 
            Quay về Trang Chủ
        </a>
    </div>
</div>

<footer>
    <p>&copy; 2026 Văn Hóa Gia Lai Mới • Kết nối tinh hoa - Lan tỏa bản sắc</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>