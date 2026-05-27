<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về Chúng Tôi - Gia Lai Culture</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                        url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .section-title {
            color: #0b5d2a;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .icon-box {
            text-align: center;
            padding: 30px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            height: 100%;
            transition: 0.3s;
        }

        .icon-box:hover {
            transform: translateY(-5px);
        }

        .icon-box i {
            font-size: 50px;
            color: #198754;
            margin-bottom: 20px;
        }

        .team-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .team-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        /* BUTTON */

        .home-btn {
            text-align: center;
            margin: 70px 0;
        }

        .btn-home {
            display: inline-block;
            background: #146c43;
            color: white;
            padding: 16px 38px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 28px;
            transition: 0.3s;
        }
    </style>
</head>
<body>

<!-- Banner -->
<section class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Về Chúng Tôi</h1>
        <p class="lead">
            Nơi gìn giữ và lan tỏa giá trị văn hóa đặc sắc của Gia Lai và Bình Định
        </p>
    </div>
</section>

<!-- Giới thiệu -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Giới Thiệu Dự Án</h2>
        <p class="text-center fs-5">
            Gia Lai Culture là website được xây dựng nhằm giới thiệu, bảo tồn
            và quảng bá những giá trị văn hóa truyền thống, lễ hội, ẩm thực,
            và con người của hai vùng đất giàu bản sắc: Gia Lai và Bình Định.
        </p>
    </div>
</section>

<!-- Sứ mệnh -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">Sứ Mệnh Của Chúng Tôi</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="icon-box">
                    <i class="fas fa-landmark"></i>
                    <h4>Bảo Tồn Di Sản</h4>
                    <p>Gìn giữ các giá trị văn hóa truyền thống cho thế hệ tương lai.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="icon-box">
                    <i class="fas fa-globe-asia"></i>
                    <h4>Quảng Bá Du Lịch</h4>
                    <p>Giới thiệu hình ảnh Gia Lai và Bình Định đến với bạn bè gần xa.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="icon-box">
                    <i class="fas fa-robot"></i>
                    <h4>Ứng Dụng AI</h4>
                    <p>Hỗ trợ người dùng khám phá văn hóa thông qua Chat AI thông minh.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nhóm phát triển -->
 
   <section class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Nhóm Phát Triển</h2>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="team-card">
                    <img src="https://via.placeholder.com/120" alt="Developer">
                    <h4>Ngô Khánh Huy</h4>
                    <p class="text-muted">Sinh viên phát triển dự án</p>
                    <p>
                        Xây dựng website giới thiệu văn hóa, tích hợp PHP, MySQL,
                        Bootstrap và Chat AI.
                    </p>
                </div>
            </div>
       

       
            <div class="col-md-4">
                <div class="team-card">
                    <img src="https://via.placeholder.com/120" alt="Developer">
                    <h4>Ngô Khánh Huy</h4>
                    <p class="text-muted">Sinh viên phát triển dự án</p>
                    <p>
                        Xây dựng website giới thiệu văn hóa, tích hợp PHP, MySQL,
                        Bootstrap và Chat AI.
                    </p>
                </div>
        </div>
       
            <div class="col-md-4">
                <div class="team-card">
                    <img src="https://via.placeholder.com/120" alt="Developer">
                    <h4>Ngô Khánh Huy</h4>
                    <p class="text-muted">Sinh viên phát triển dự án</p>
                    <p>
                        Xây dựng website giới thiệu văn hóa, tích hợp PHP, MySQL,
                        Bootstrap và Chat AI.
                    </p>
                </div>
            </div>
        <hr>
        <div class="col-md-4">
                <div class="team-card">
                    <img src="https://via.placeholder.com/120" alt="Developer">
                    <h4>Ngô Khánh Huy</h4>
                    <p class="text-muted">Sinh viên phát triển dự án</p>
                    <p>
                        Xây dựng website giới thiệu văn hóa, tích hợp PHP, MySQL,
                        Bootstrap và Chat AI.
                    </p>
                </div>
        </div>
        <div class="col-md-4">
                <div class="team-card">
                    <img src="https://via.placeholder.com/120" alt="Developer">
                    <h4>Ngô Khánh Huy</h4>
                    <p class="text-muted">Sinh viên phát triển dự án</p>
                    <p>
                        Xây dựng website giới thiệu văn hóa, tích hợp PHP, MySQL,
                        Bootstrap và Chat AI.
                    </p>
                </div>
        </div>
            
    </div>
</section> 

 


<!-- Nút quay về -->
<section class="text-center pb-5">
    <a href="index.php" class="btn-home">
        <i class="fas fa-home"></i> Quay về Trang Chủ
    </a>
</section>

</body>
</html>