<footer class="footer bg-dark text-light py-5 mt-5 border-top border-secondary">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="row mb-4">
            <!-- Company Info -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-landmark fs-5"></i> Văn Hóa Gia Lai
                </h5>
                <p class="text-light small">Gìn giữ và lan tỏa bản sắc văn hóa dân tộc Tây Nguyên cho thế hệ tương lai.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h6 class="fw-bold mb-3" style="color: #f8f9fa;"> Khám Phá</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <a href="index.php" class="text-light text-decoration-none footer-link">
                            <i class="fas fa-landmark fs-5"></i> Trang Chủ
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="vanhoa.php" class="text-light text-decoration-none footer-link">
                            <i class="fas fa-landmark fs-5"></i> Di Sản Văn Hóa
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="dantoc.php" class="text-light text-decoration-none footer-link">
                            <i class="fas fa-landmark fs-5"></i> Các Dân Tộc
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="amthuc.php" class="text-light text-decoration-none footer-link">
                            <i class="fas fa-landmark fs-5"></i> Ẩm Thực Đặc Sắc
                        </a>
                    </li>
                    <li>
                        <a href="chat.php" class="text-light text-decoration-none footer-link">
                            <i class="fas fa-landmark fs-5"></i> Chat AI
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Information -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h6 class="fw-bold mb-3" style="color: #f8f9fa;"> Thông Tin</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <a href="vechungtoi.php" class="text-light text-decoration-none footer-link">
                            <i class="fas fa-info-circle fs-5"></i> Về Chúng Tôi
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="contact.php" class="text-light text-decoration-none footer-link">
                            <i class="fas fa-envelope fs-5"> </i> Liên Hệ
                        </a>
                    </li>
                    <li>
                        <a href="terms.php" class="text-light text-decoration-none footer-link">
                            <i class="fas fa-file-contract fs-5"> </i> Điều Khoản Sử Dụng
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3" style="color: #f8f9fa;"> Liên Hệ </h6>
                <div class="small text-light">
                    <p class="mb-2">
                        <i class="fas fa-map-marker-alt fs-5"></i> Gia Lai, Việt Nam
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-phone fs-5"></i> +84(0)89 923 43 87
                    </p>
                    <p class="mb-2">
                        <i class="fab fa-facebook fs-5"></i>
                        <a href="https://www.facebook.com/profile.php?id=61574346975994" class="text-light text-decoration-none footer-link">
                            FACEBOOK
                        </a>
                    </p>
                </div>
            </div>
</div>
        <!-- Bottom Footer -->
        
                <small >
                    &copy; <span id="year"><?= date("Y") ?></span> 
                    <strong>Gia Lai Culture</strong>. All Rights Reserved.
                </small>
           
       
    </div>
</footer>

<!-- Footer Styles -->
<style>
/* ================= HEADER ================= */

body{
    margin:0;
    padding:0;
    font-family: 'Segoe UI', sans-serif;
}

/* TOPBAR */

.topbar{
    background:#005c2b;
    color:white;
    font-size:14px;
    padding:8px 0;
}

.topbar .container{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.top-left,
.top-right{
    display:flex;
    align-items:center;
    gap:20px;
}

.top-right a{
    color:white;
    text-decoration:none;
    transition:0.3s;
}

.top-right a:hover{
    color:#ffc107;
}

/* NAVBAR */

.navbar-custom{
    background:linear-gradient(90deg,#006633,#008040);
    border-top:2px solid #d4af37;
    border-bottom:2px solid #d4af37;
    padding:12px 0;
}

.navbar-brand{
    color:white !important;
    font-size:30px;
    font-weight:bold;
    display:flex;
    align-items:center;
    gap:10px;
}

.navbar-brand span{
    font-size:15px;
    display:block;
    font-weight:400;
}

.navbar-brand img{
    width:65px;
    height:65px;
    object-fit:cover;
}

/* MENU */

.navbar-nav{
    gap:10px;
}

.navbar-nav .nav-link{
    color:white !important;
    font-weight:500;
    padding:10px 14px !important;
    position:relative;
    transition:0.3s;
}

.navbar-nav .nav-link:hover{
    color:#ffc107 !important;
}

/* gạch vàng */

.navbar-nav .nav-link::after{
    content:'';
    position:absolute;
    left:50%;
    bottom:0;
    width:0;
    height:2px;
    background:#ffc107;
    transition:0.3s;
    transform:translateX(-50%);
}

.navbar-nav .nav-link:hover::after{
    width:80%;
}

/* DROPDOWN */

.dropdown-menu{
    border:none;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

.dropdown-item{
    padding:10px 15px;
    transition:0.3s;
}

.dropdown-item:hover{
    background:#198754;
    color:white;
}

/* LOGIN BUTTON */

.btn-auth{
    border:1px solid white;
    border-radius:30px;
    padding:8px 18px;
    color:white !important;
    transition:0.3s;
}

.btn-auth:hover{
    background:white;
    color:#198754 !important;
}

/* REGISTER */

.btn-register{
    background:#ffc107;
    color:black !important;
    border:none;
}

.btn-register:hover{
    background:#ffca2c;
}

/* MOBILE */

@media(max-width:992px){

    .topbar{
        display:none;
    }

    .navbar-nav{
        margin-top:15px;
    }

    .btn-auth{
        margin-top:10px;
        display:inline-block;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>