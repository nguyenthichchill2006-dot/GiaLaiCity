<?php
$page_title = "Địa Điểm Du Lịch - Gia Lai Culture";
$page_desc  = "Khám phá những địa điểm du lịch tuyệt đẹp tại Gia Lai - từ cao nguyên hùng vĩ Tây Nguyên đến bờ biển duyên hải xanh ngọc.";
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Địa Điểm Du Lịch - Gia Lai Culture</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Mulish:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-deep:    #013a1a;
            --green-main:    #005c2b;
            --green-mid:     #1a7a40;
            --green-light:   #2ecc71;
            --green-pale:    #e8f5ee;
            --gold:          #ffbc00;
            --gold-light:    #fff3cc;
            --text-dark:     #1a2e1a;
            --text-mid:      #3d5c3d;
            --text-light:    #6b8f6b;
            --white:         #ffffff;
            --card-shadow:   0 8px 32px rgba(0,92,43,0.13);
            --card-radius:   18px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Mulish', sans-serif;
            background: #f4faf6;
            color: var(--text-dark);
        }

        /* ===== HERO BANNER ===== */
        .hero-banner {
            position: relative;
            background: linear-gradient(135deg, var(--green-deep) 0%, var(--green-main) 50%, var(--green-mid) 100%);
            padding: 90px 0 70px;
            overflow: hidden;
            text-align: center;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 15% 50%, rgba(255,188,0,0.08) 0%, transparent 40%),
                radial-gradient(circle at 85% 30%, rgba(46,204,113,0.1) 0%, transparent 40%);
        }

        .hero-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.04;
            background-image: repeating-linear-gradient(
                60deg,
                var(--gold) 0px, var(--gold) 1px,
                transparent 1px, transparent 30px
            ), repeating-linear-gradient(
                -60deg,
                var(--gold) 0px, var(--gold) 1px,
                transparent 1px, transparent 30px
            );
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 900;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 18px;
        }

        .hero-title span {
            color: var(--gold);
        }

        .hero-desc {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.78);
            max-width: 560px;
            margin: 0 auto 30px;
            font-weight: 300;
            line-height: 1.7;
        }

        /* ===== LƯỚI ĐỊA ĐIỂM ===== */
        .destinations-section {
            padding: 60px 0 80px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--green-mid);
            margin-bottom: 10px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            color: var(--text-dark);
            font-weight: 700;
        }

        .section-line {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--green-main), var(--gold));
            margin: 16px auto 0;
            border-radius: 3px;
        }

        /* ===== CARD ĐỊA ĐIỂM ===== */
        .dest-card {
            background: var(--white);
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.32s cubic-bezier(.22,.68,0,1.2), box-shadow 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .dest-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 48px rgba(0,92,43,0.18);
        }

        .card-img-wrap {
            position: relative;
            overflow: hidden;
            height: 230px;
        }

        .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .dest-card:hover .card-img-wrap img {
            transform: scale(1.07);
        }

        .card-category {
            position: absolute;
            top: 14px;
            left: 14px;
            background: var(--green-main);
            color: var(--white);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 20px;
        }

        .card-body-custom {
            padding: 22px 22px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.18rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .card-location {
            font-size: 12px;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 12px;
        }

        .card-location i {
            color: var(--green-mid);
        }

        .card-desc {
            font-size: 13.5px;
            color: var(--text-mid);
            line-height: 1.65;
            flex: 1;
            margin-bottom: 16px;
        }

        .card-features {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-bottom: 18px;
        }

        .feature-tag {
            background: var(--green-pale);
            color: var(--green-main);
            font-size: 11.5px;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .card-footer-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 14px;
            border-top: 1px solid #e8f0e8;
        }

        .card-distance {
            font-size: 12px;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-open-map {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, var(--green-main), var(--green-mid));
            color: var(--white);
            font-size: 12.5px;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.25s;
            box-shadow: 0 3px 10px rgba(0,92,43,0.3);
        }

        .btn-open-map:hover {
            background: linear-gradient(135deg, var(--green-deep), var(--green-main));
            color: var(--white);
            box-shadow: 0 5px 16px rgba(0,92,43,0.4);
            transform: translateY(-1px);
        }

        .dest-card.featured .card-img-wrap {
            height: 320px;
        }

        .dest-card.featured .card-name {
            font-size: 1.5rem;
        }

        .featured-crown {
            position: absolute;
            top: 14px;
            left: 14px;
            background: linear-gradient(135deg, var(--gold), #ff9900);
            color: var(--green-deep);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .tip-card {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 16px;
    padding: 28px 24px;
    text-align: center;
}

.tip-icon {
    width: 56px;
    height: 56px;
    background: rgba(255,188,0,0.15);
    border: 1.5px solid rgba(255,188,0,0.35);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: var(--gold);
    margin: 0 auto 16px;
}
.tips-section {
    background: linear-gradient(135deg, var(--green-deep), var(--green-main)); 
    color: white; 
    padding: 60px 0;
}
    </style>
</head>
<body>

<!-- ===================== HERO ===================== -->
<section class="hero-banner">
    <div class="hero-pattern"></div>
    <div class="container position-relative">
        <h1 class="hero-title">Khám Phá <span>Gia Lai</span><br>Từ Rừng Núi Đến Biển Khơi</h1>
        <p class="hero-desc">Tỉnh Gia Lai trải dài từ cao nguyên hùng vĩ với cồng chiêng, thác nước, rừng nguyên sinh đến bờ biển duyên hải xanh ngọc với đầm phá, ghềnh đá và cảng cá sầm uất.</p>
    </div>
</section>


<!-- ===================== DANH SÁCH ĐỊA ĐIỂM ===================== -->
<section class="destinations-section">
    <div class="container">
        <div class="section-header">
            <p class="section-eyebrow">Điểm đến nổi bật</p>
            <h2 class="section-title">Những Địa Danh Không Thể Bỏ Qua</h2>
            <div class="section-line"></div>
        </div>

        <div class="row g-4" id="destGrid">

            <!-- BIỂN HỒ T'NÚH -->
            <div class="col-md-8 dest-item" data-cat="ho-nuoc">
                <div class="dest-card featured h-100">
                    <div class="card-img-wrap">
                        <img src="bienho.png" alt="Biển Hồ T'Núh">
                        <div class="featured-crown"><i class="fas fa-crown"></i> Nổi Bật Nhất</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Biển Hồ T'Núh (Biển Hồ Chè)</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> TP. Pleiku, Gia Lai &nbsp;|&nbsp; Cách trung tâm ~7 km</div>
                        <p class="card-desc">Mặt hồ rộng hơn 230 ha nằm trong miệng núi lửa cổ đại, được mệnh danh là "đôi mắt Pleiku". Nước hồ xanh biếc bốn mùa, bao quanh bởi rừng thông và đồi chè xanh mướt.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-water"></i> Hồ Núi Lửa</span>
                            <span class="feature-tag"><i class="fas fa-tree"></i> Rừng Thông</span>
                            <span class="feature-tag"><i class="fas fa-camera"></i> Check-in Đẹp</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-clock"></i> Mở cửa: 6:00 – 18:00</span>
                            <a href="https://maps.google.com/?q=Bien+Ho+TNuh+Pleiku+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- THÁC PHU CƯỜNG -->
            <div class="col-md-4 dest-item" data-cat="thac-nuoc">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="thacphucuong.jpg" alt="Thác Phú Cường">
                        <div class="card-category">Thác Nước</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Thác Phú Cường</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> Chư Sê, Gia Lai</div>
                        <p class="card-desc">Thác Phú Cường là một trong những thác nước hùng vĩ nhất Gia Lai với độ cao 45 mét, dòng nước trắng xóa đổ xuống từ vách đá bazan đen huyền bí giữa rừng nguyên sinh xanh tươi. Khung cảnh hoang sơ, kỳ vĩ cùng tiếng nước réo vang tạo nên sức hút mạnh mẽ cho những ai yêu thích thiên nhiên hoang dã.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-tint"></i> Thác 45m</span>
                            <span class="feature-tag"><i class="fas fa-leaf"></i> Rừng Nguyên Sinh</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-road"></i> ~80 km từ Pleiku</span>
                            <a href="https://maps.google.com/?q=Thac+Phu+Cuong+Chu+Se+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BẢO TÀNG TỈNH GIA LAI -->
            <div class="col-md-4 dest-item" data-cat="lich-su">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="baotang.jpg" alt="Bảo Tàng Gia Lai">
                        <div class="card-category">Lịch Sử</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Bảo Tàng Tỉnh Gia Lai</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> TP. Pleiku, Gia Lai</div>
                        <p class="card-desc">Bảo Tàng Tỉnh Gia Lai là kho tàng văn hóa quý giá của vùng đất cao nguyên, lưu giữ hàng nghìn hiện vật quý hiếm về văn hóa dân tộc Bahnar, Jrai cùng nhiều di tích lịch sử kháng chiến hào hùng. Nơi đây không chỉ là điểm tham quan mà còn là không gian giúp du khách hiểu sâu hơn về bản sắc văn hóa cồng chiêng, nhà rông và cuộc sống truyền thống của đồng bào Tây Nguyên.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-drum"></i> Cồng Chiêng</span>
                            <span class="feature-tag"><i class="fas fa-landmark"></i> Hiện Vật Cổ</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-clock"></i> T2–CN: 7:30–17:00</span>
                            <a href="https://maps.google.com/?q=Bao+tang+Gia+Lai+Pleiku" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Làng văn hoá du lịch Plei Ơp -->
            <div class="col-md-4 dest-item" data-cat="van-hoa">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="langplei.jpg" alt="Làng Plei Ơp">
                        <div class="card-category">Văn Hoá</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Làng văn hoá du lịch Plei Ơp</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> Pleiku, Gia Lai</div>
                        <p class="card-desc">Làng văn hoá du lịch Plei Ơp là ngôi làng của người Jrai nằm giữa lòng phố núi Pleiku, Gia Lai và đã tồn tại gần 100 năm. Nơi đây vẫn lưu giữ nhiều nét văn hóa truyền thống như nhà rông, cồng chiêng, dệt thổ cẩm và các lễ hội dân gian đặc sắc. Đây cũng là điểm du lịch văn hóa nổi tiếng giúp du khách khám phá bản sắc Tây Nguyên nguyên bản giữa cuộc sống hiện đại.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-home"></i> Nhà Rông</span>
                            <span class="feature-tag"><i class="fas fa-tshirt"></i> Thổ Cẩm</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-road"></i> ~50 km từ Pleiku</span>
                            <a href="https://maps.google.com/?q=Lang+van+hoa+Kpung+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ĐỒN ĐIỀN CHÈ BIỂN HỒ -->
            <div class="col-md-4 dest-item" data-cat="thien-nhien">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="doiche.jpg" alt="Đồi Chè Biển Hồ">
                        <div class="card-category">Thiên Nhiên</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Đồn Điền Chè Biển Hồ</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> TP. Pleiku, Gia Lai</div>
                        <p class="card-desc">
Nằm bên cạnh Biển Hồ T’Núh thơ mộng, Đồn Điền Chè Biển Hồ sở hữu những triền đồi chè xanh mướt trải dài như một bức tranh thiên nhiên sống động của Tây Nguyên.
Vào buổi sáng sớm, sương mù bao phủ tạo nên khung cảnh huyền ảo, lãng mạn bậc nhất Gia Lai, khiến du khách không khỏi trầm trồ trước vẻ đẹp dịu dàng này.
Không chỉ đẹp mắt, nơi đây còn là điểm đến lý tưởng để trải nghiệm hái chè, tìm hiểu quy trình sản xuất và thưởng thức những tách trà ngon đặc sản cao nguyên.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-seedling"></i> Đồi Chè</span>
                            <span class="feature-tag"><i class="fas fa-camera"></i> Chụp Ảnh</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-clock"></i> Đẹp nhất lúc 6:00–8:00</span>
                            <a href="https://maps.google.com/?q=Don+dien+che+Bien+Ho+Pleiku+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VƯỜN QUỐC GIA KON KA KINH -->
            <div class="col-md-8 dest-item" data-cat="thien-nhien">
                <div class="dest-card featured h-100">
                    <div class="card-img-wrap">
                        <img src="kakinh.jpg" alt="Vườn Quốc Gia Kon Ka Kinh">
                        <div class="card-category">Thiên Nhiên</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Vườn Quốc Gia Kon Ka Kinh</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> Mang Yang – Kbang, Gia Lai</div>
                        <p class="card-desc">Vườn Quốc Gia Kon Ka Kinh – Khu Dự trữ Sinh quyển ASEAN với hơn 41.000 ha rừng nguyên sinh phong phú. Nơi đây là thiên đường trekking và khám phá hệ sinh thái đa dạng bậc nhất Tây Nguyên, nổi tiếng với voọc chà vá chân xám và đỉnh núi hùng vĩ 1.748m.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-paw"></i> Đa Dạng Sinh Học</span>
                            <span class="feature-tag"><i class="fas fa-hiking"></i> Trekking</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-road"></i> ~70 km từ Pleiku</span>
                            <a href="https://maps.google.com/?q=Vuon+quoc+gia+Kon+Ka+Kinh+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QUẢNG TRƯỜNG ĐẠI ĐOÀN KẾT -->
            <div class="col-md-4 dest-item" data-cat="van-hoa">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="anhbac.jpg" alt="Quảng Trường Đại Đoàn Kết">
                        <div class="card-category">Văn Hoá</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Quảng Trường Đại Đoàn Kết</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> TP. Pleiku, Gia Lai</div>
                        <p class="card-desc">Quảng trường Đại Đoàn Kết là quảng trường lớn nhất Tây Nguyên và là nơi tọa lạc tượng đài Bác Hồ với các dân tộc Tây Nguyên – bức tượng đồng Chủ tịch Hồ Chí Minh lớn nhất Việt Nam. Với không gian rộng lớn, kiến trúc hiện đại và đài phun nước lung linh về đêm, đây là biểu tượng văn hóa - chính trị quan trọng, đồng thời là điểm check-in yêu thích của du khách khi đến Pleiku</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-drum"></i> Lễ Hội Lớn</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-clock"></i> Mở cửa cả ngày</span>
                            <a href="https://maps.google.com/?q=Quang+truong+Dai+Doan+Ket+Pleiku+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

    
            <!-- ===== KỲ CO ===== -->
            <div class="col-md-8 dest-item" data-cat="bien-dao">
                <div class="dest-card featured h-100">
                    <div class="card-img-wrap">
                        <img src="kyco.jpg"
                             alt="Kỳ Co"
                             >
                        <div class="featured-crown"><i class="fas fa-crown"></i> Viên Ngọc Duyên Hải</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Bãi Biển Kỳ Co</h3>
                        <div class="card-location">
                            <i class="fas fa-map-marker-alt"></i> Nhơn Lý, Quy Nhơn, Gia Lai &nbsp;|&nbsp; Cách trung tâm ~25 km
                        </div>
                        <p class="card-desc">Bãi Biển Kỳ Co – 'Maldives của Việt Nam' thuộc Gia Lai với nước biển xanh ngọc trong vắt, bãi cát trắng mịn và vách đá granit hùng vĩ. Nơi đây là điểm đến lý tưởng để lặn biển, check-in và chiêm ngưỡng vẻ đẹp hoang sơ của vùng duyên hải.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-water"></i> Nước Xanh Ngọc</span>
                            <span class="feature-tag"><i class="fas fa-umbrella-beach"></i> Bãi Cát Trắng</span>
                            <span class="feature-tag"><i class="fas fa-swimmer"></i> Lặn Ngắm San Hô</span>
                            <span class="feature-tag"><i class="fas fa-ship"></i> Tàu Cao Tốc</span>
                            <span class="feature-tag"><i class="fas fa-camera"></i> Check-in Đẹp</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-clock"></i> Mùa đẹp: Tháng 3–8</span>
                            <a href="https://maps.google.com/?q=Ky+Co+Quy+Nhon+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== ĐẦM THỊ NẠI ===== -->
            <div class="col-md-4 dest-item" data-cat="bien-dao">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="thinai.jpg"
                             alt="Đầm Thị Nại"
                            >
                        <div class="card-category">Biển & Đầm</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Đầm Thị Nại</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> Quy Nhơn, Gia Lai</div>
                        <p class="card-desc">Đầm nước mặn lớn nhất miền Trung với diện tích hơn 5.000 ha — nơi sinh sống của hàng trăm loài chim nước, rừng ngập mặn xanh tươi và nghề nuôi trồng thủy sản truyền thống.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-feather"></i> Chim Nước</span>
                            <span class="feature-tag"><i class="fas fa-leaf"></i> Rừng Ngập Mặn</span>
                            <span class="feature-tag"><i class="fas fa-anchor"></i> Thuyền Tham Quan</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-road"></i> Trung tâm Quy Nhơn</span>
                            <a href="https://maps.google.com/?q=Dam+Thi+Nai+Quy+Nhon+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== EO GIÓ ===== -->
            <div class="col-md-4 dest-item" data-cat="bien-dao">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="eogio.jpg"
                             alt="Eo Gió"
                             >
                        <div class="card-category">Biển & Đầm</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Eo Gió</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> Nhơn Lý, Quy Nhơn, Gia Lai</div>
                        <p class="card-desc">Ghềnh đá granit kỳ vĩ hướng ra biển Đông, nơi gió lộng quanh năm tạo nên cảnh quan hoang sơ hùng tráng.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-wind"></i> Ghềnh Đá Granit</span>
                            <span class="feature-tag"><i class="fas fa-sun"></i> Bình Minh Đẹp</span>
                            <span class="feature-tag"><i class="fas fa-camera"></i> Săn Ảnh</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-road"></i> ~22 km từ Quy Nhơn</span>
                            <a href="https://maps.google.com/?q=Eo+Gio+Nhon+Ly+Quy+Nhon+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== THÁP ĐÔI ===== -->
            <div class="col-md-4 dest-item" data-cat="lich-su">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="thapdoi.jpg"
                             alt="Tháp Đôi Quy Nhơn"
                           >
                        <div class="card-category">Lịch Sử</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Tháp Đôi Quy Nhơn</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> Quy Nhơn, Gia Lai</div>
                        <p class="card-desc">Cụm tháp Chăm Pa được xây dựng từ thế kỷ XII, kiến trúc gạch nung độc đáo còn nguyên vẹn giữa lòng thành phố biển.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-monument"></i> Chăm Pa TK XII</span>
                            <span class="feature-tag"><i class="fas fa-landmark"></i> Di Tích Quốc Gia</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-clock"></i> T2–CN: 7:00–17:30</span>
                            <a href="https://maps.google.com/?q=Thap+Doi+Quy+Nhon+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== BÃI BIỂN QUY NHƠN ===== -->
            <div class="col-md-4 dest-item" data-cat="bien-dao">
                <div class="dest-card h-100">
                    <div class="card-img-wrap">
                        <img src="bienqnhon.jpg"
                             alt="Bãi Biển Quy Nhơn">
                        <div class="card-category">Biển & Đầm</div>
                    </div>
                    <div class="card-body-custom">
                        <h3 class="card-name">Bãi Biển Quy Nhơn</h3>
                        <div class="card-location"><i class="fas fa-map-marker-alt"></i> Quy Nhơn, Gia Lai</div>
                        <p class="card-desc">Dải bãi biển cong dài hơn 4km ôm trọn vịnh Quy Nhơn — bãi cát vàng mịn, sóng êm, nước trong xanh.</p>
                        <div class="card-features">
                            <span class="feature-tag"><i class="fas fa-umbrella-beach"></i> Bãi Cát Dài 4km</span>
                            <span class="feature-tag"><i class="fas fa-volleyball-ball"></i> Thể Thao Biển</span>
                            <span class="feature-tag"><i class="fas fa-utensils"></i> Hải Sản Tươi</span>
                        </div>
                        <div class="card-footer-custom">
                            <span class="card-distance"><i class="fas fa-clock"></i> Trung tâm Quy Nhơn</span>
                            <a href="https://maps.google.com/?q=Bai+bien+Quy+Nhon+Gia+Lai" target="_blank" class="btn-open-map">
                                <i class="fas fa-map-marked-alt"></i> Chỉ Đường
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== MẸO DU LỊCH ===================== -->
<section class="tips-section" style="background: linear-gradient(135deg, var(--green-deep), var(--green-main)); color: white; padding: 60px 0;">
    <div class="container">
        <div class="section-header mb-5">
            <p class="section-eyebrow" style="color: var(--gold);">Kinh nghiệm</p>
            <h2 class="section-title" style="color: white;">Mẹo Khi Đến Gia Lai</h2>
            <div class="section-line" style="background: linear-gradient(90deg, var(--gold), var(--green-light));"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="tip-card" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                    <div class="tip-icon"><i class="fas fa-calendar-alt"></i></div>
                    <h5 class="tip-title">Thời Điểm Lý Tưởng</h5>
                    <p class="tip-text">Tháng 11 – 4 (mùa khô) là thời điểm đẹp nhất.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tip-card" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                    <div class="tip-icon"><i class="fas fa-car"></i></div>
                    <h5 class="tip-title">Di Chuyển</h5>
                    <p class="tip-text">Thuê xe máy hoặc ô tô tự lái là lựa chọn tốt nhất.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tip-card" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                    <div class="tip-icon"><i class="fas fa-tshirt"></i></div>
                    <h5 class="tip-title">Trang Phục</h5>
                    <p class="tip-text">Mang áo khoác nhẹ và giày trekking nếu đi rừng núi.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tip-card" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                    <div class="tip-icon"><i class="fas fa-utensils"></i></div>
                    <h5 class="tip-title">Ẩm Thực</h5>
                    <p class="tip-text">Phở khô Gia Lai, gà nướng Tây Nguyên, hải sản tươi ở vùng biển Quy Nhơn.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>