<?php   
$page_title = "Các Dân Tộc Gia Lai";   
?>    

<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Các Dân Tộc Gia Lai</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            background:#f4fff6;
            color:#216230;
        }

        /* HEADER */

        header{
            height:100vh;
            background:
            url('anhnennuilua.jpg');
            background-size:cover;
            background-position:center;
            display:flex;
            justify-content:center;
            align-items:center;
            text-align:center;
            color:white;
            padding:20px;
        }

        .hero{
            max-width:900px;
        }

        .hero h1{
            font-size:70px;
            margin-bottom:25px;
        }

        .hero p{
            font-size:22px;
            line-height:1.8;
        }

        /* CONTAINER */

        .container{
            width:90%;
            max-width:1400px;
            margin:auto;
            padding:80px 0;
        }

        .title{
            text-align:center;
            margin-bottom:60px;
        }

        .title h2{
            font-size:45px;
            margin-bottom:15px;
        }

        .title p{
            color:#555;
            font-size:18px;
        }

        /* GRID */

        .grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:30px;
        }

        /* CARD */

        .card{
            background:white;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 8px 20px rgba(0,0,0,0.08);
            transition:0.4s;
        }

        .card:hover{
            transform:translateY(-10px);
        }

        .card img{
            width:100%;
            height:250px;
            object-fit:cover;
        }

        .content{
            padding:25px;
        }

        .content i{
            font-size:38px;
            margin-bottom:15px;
            color:#216230;
        }

        .content h2{
            margin-bottom:15px;
            font-size:28px;
        }

        .content p{
            color:#555;
            line-height:1.8;
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

     

        /* RESPONSIVE */

        @media(max-width:1200px){

            .grid{
                grid-template-columns:repeat(2,1fr);
            }

        }

        @media(max-width:768px){

            .hero h1{
                font-size:45px;
            }

            .hero p{
                font-size:18px;
            }

            .grid{
                grid-template-columns:1fr;
            }

            .title h2{
                font-size:35px;
            }

        }

    </style>
</head>

<body>

<!-- HEADER -->

<header>

    <div class="hero">

        <h1>Các Dân Tộc Tại Gia Lai</h1>

        <p>
            Gia Lai là nơi sinh sống của nhiều dân tộc anh em,
            tạo nên bản sắc văn hóa đa dạng và đặc sắc của vùng Tây Nguyên.
        </p>

    </div>

</header>

<!-- CONTENT -->

<div class="container">

    <div class="title">

        <h2>Những Dân Tộc Tiêu Biểu</h2>

        <p>
            Mỗi dân tộc tại Gia Lai đều mang nét văn hóa,
            phong tục và truyền thống riêng biệt.
        </p>

    </div>

<!-- GRID -->

<div class="grid">

    <!-- JRAI -->

    <div class="card">

        <img src="jrai.jpg">

        <div class="content">

            <i class="fa-solid fa-drum"></i>

            <h2>Jrai (Gia Rai)</h2>

            <p>
                Người Jrai là dân tộc bản địa đông nhất tại Gia Lai,
                sinh sống chủ yếu ở Pleiku, Chư Păh, Ia Grai và Đức Cơ.
                Văn hóa Jrai nổi bật với không gian văn hóa cồng chiêng Tây Nguyên,
                các lễ hội truyền thống như lễ bỏ mả (Pơ Thi),
                lễ mừng lúa mới và nghệ thuật kể sử thi dân gian.
                Người Jrai thường sinh sống trong những ngôi nhà sàn dài,
                gắn bó mật thiết với núi rừng và đời sống cộng đồng làng.
                Trang phục thổ cẩm cùng các nhạc cụ dân tộc tạo nên bản sắc riêng biệt.
            </p>

        </div>

    </div>

    <!-- BAHNAR -->

    <div class="card">

        <img src="bana.jpg">

        <div class="content">

            <i class="fa-solid fa-house"></i>

            <h2>Ba Na (Bahnar)</h2>

            <p>
                Người Ba Na là một trong những dân tộc lâu đời của Tây Nguyên.
                Họ nổi tiếng với kiến trúc nhà rông cao lớn nằm giữa làng,
                biểu tượng của tinh thần đoàn kết cộng đồng.
                Văn hóa Ba Na gắn liền với sử thi Tây Nguyên,
                lễ hội cồng chiêng và nghề dệt thổ cẩm truyền thống.
                Người Ba Na còn có nhiều phong tục đặc sắc trong cưới hỏi,
                sinh hoạt cộng đồng và tín ngưỡng dân gian.
            </p>

        </div>

    </div>

    <!-- Ê ĐÊ -->

    <div class="card">

        <img src="ede.jpg">

        <div class="content">

            <i class="fa-solid fa-fire"></i>

            <h2>Ê Đê</h2>

            <p>
                Người Ê Đê mang đậm nét văn hóa mẫu hệ đặc trưng của Tây Nguyên.
                Họ nổi tiếng với những ngôi nhà dài truyền thống,
                nơi nhiều thế hệ cùng sinh sống.
                Văn hóa Ê Đê gắn liền với cồng chiêng,
                nghệ thuật hát kể Khan và các lễ hội truyền thống.
                Nghề dệt thổ cẩm cùng hoa văn độc đáo
                là nét đẹp văn hóa nổi bật của dân tộc Ê Đê.
            </p>

        </div>

    </div>

    <!-- KINH -->

    <div class="card">

        <img src="kinh.jpg">

        <div class="content">

            <i class="fa-solid fa-city"></i>

            <h2>Kinh</h2>

            <p>
                Người Kinh sinh sống rộng khắp tại Gia Lai
                và đóng vai trò quan trọng trong phát triển kinh tế,
                giáo dục, thương mại và văn hóa đô thị.
                Sự giao lưu giữa người Kinh với các dân tộc Tây Nguyên
                đã tạo nên sự đa dạng văn hóa đặc sắc cho vùng đất Gia Lai.
                Nhiều phong tục, ẩm thực và lễ hội truyền thống
                được gìn giữ và phát triển qua nhiều thế hệ.
            </p>

        </div>

    </div>

    <!-- M'NÔNG -->

    <div class="card">

        <img src="mnong.jpg">

        <div class="content">

            <i class="fa-solid fa-tree"></i>

            <h2>M'Nông</h2>

            <p>
                Người M'Nông có đời sống gắn liền với núi rừng Tây Nguyên,
                nổi tiếng với nghệ thuật kể sử thi và văn hóa cồng chiêng.
                Họ có nhiều phong tục truyền thống độc đáo,
                đặc biệt trong sinh hoạt cộng đồng và tín ngưỡng dân gian.
                Người M'Nông còn nổi bật với kỹ thuật săn bắt,
                chế tác nhạc cụ và đời sống văn hóa đậm chất Tây Nguyên.
            </p>

        </div>

    </div>

    <!-- TÀY -->

    <div class="card">

        <img src="tay.jpg">

        <div class="content">

            <i class="fa-solid fa-water"></i>

            <h2>Tày</h2>

            <p>
                Người Tày di cư đến Gia Lai từ các tỉnh miền núi phía Bắc,
                mang theo nhiều nét văn hóa truyền thống đặc sắc.
                Họ nổi tiếng với hát then,
                đàn tính và các lễ hội dân gian truyền thống.
                Trang phục dân tộc Tày giản dị nhưng mang đậm bản sắc văn hóa,
                góp phần tạo nên sự đa dạng dân tộc tại Gia Lai.
            </p>
        </div>
    </div>
</div>
 <!-- NÚT QUAY VỀ -->

        <div class="home-btn">

            <a href="index.php" class="btn-home">

                <i class="fas fa-home"></i> Quay về Trang Chủ

            </a>

        </div>



</body>
</html>