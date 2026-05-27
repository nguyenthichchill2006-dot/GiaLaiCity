<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ẩm Thực Gia Lai</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f4fff6;
            color: #216230;
        }

        /* HEADER */

        header {
            height: 100vh;
            background:
                linear-gradient(rgba(0, 0, 0, 0.45),
                    rgba(0, 0, 0, 0.45)),
                url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600');

            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 20px;
        }

        .hero h1 {
            font-size: 70px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 22px;
            max-width: 900px;
            margin: auto;
            line-height: 1.8;
        }

        /* CONTAINER */

        .container {
            width: 90%;
            max-width: 1400px;
            margin: auto;
            padding: 80px 0;
        }

        /* TITLE */

        .title {
            text-align: center;
            margin-bottom: 60px;
        }

        .title h2 {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .title p {
            font-size: 18px;
            color: #555;
        }

        /* GRID */

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        /* FOOD CARD */

        .food {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: 0.4s;
        }

        .food:hover {
            transform: translateY(-10px);
        }

        .food img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .food-content {
            padding: 25px;
        }

        .food-content i {
            font-size: 38px;
            color: #216230;
            margin-bottom: 15px;
        }

        .food-content h2 {
            margin-bottom: 15px;
            font-size: 28px;
        }

        .food-content p {
            color: #555;
            line-height: 1.8;
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

    <!-- HERO -->

    <header>

        <div class="hero">

            <h1>Ẩm Thực Gia Lai</h1>

            <p>
                Khám phá tinh hoa ẩm thực phố núi,
                nơi hội tụ hương vị Tây Nguyên và nét đẹp miền Trung.
            </p>

        </div>

    </header>

    <!-- CONTENT -->

    <div class="container">

        <div class="title">

            <h2>Đặc Sản Nổi Bật</h2>

            <p>
                Những món ăn làm nên linh hồn của vùng đất Gia Lai.
            </p>

        </div>

        <div class="grid">

            <!-- PHỞ KHÔ -->

            <div class="food">

                <img src="phokho.jpg" alt="Phở Khô Gia Lai">

                <div class="food-content">

                    <i class="fa-solid fa-bowl-food"></i>

                    <h2>Phở Khô Gia Lai</h2>

                    <p>
                        Phở khô Gia Lai còn được gọi là “phở hai tô”.
                        Một tô phở khô ăn cùng thịt băm,
                        hành phi và nước sốt đậm đà,
                        kết hợp với tô nước lèo nóng hổi,
                        tạo nên hương vị đặc trưng khó quên.
                    </p>

                </div>

            </div>

            <!-- BÚN MẮM CUA -->

            <div class="food">

                <img src="buncua.jpg" alt="Bún Mắm Cua">

                <div class="food-content">

                    <i class="fa-solid fa-pepper-hot"></i>

                    <h2>Bún Mắm Cua</h2>

                    <p>
                        Món ăn nổi tiếng với hương vị đậm đà của mắm cua lên men.
                        Bún ăn kèm tóp mỡ, rau sống và bánh đa,
                        mang đến trải nghiệm ẩm thực rất riêng của Tây Nguyên.
                    </p>

                </div>

            </div>

            <!-- GÀ NƯỚNG -->

            <div class="food">

                <img src="ganuong.jpg" alt="Gà Nướng Cơm Lam">

                <div class="food-content">

                    <i class="fa-solid fa-drumstick-bite"></i>

                    <h2>Gà Nướng Cơm Lam</h2>

                    <p>
                        Gà được nướng trên than hồng,
                        da vàng giòn thơm phức,
                        ăn cùng cơm lam dẻo mềm trong ống tre,
                        tạo nên món ăn đậm chất núi rừng Tây Nguyên.
                    </p>

                </div>

            </div>

            <!-- MUỐI KIẾN -->

            <div class="food">

                <img src="muoi.jpg" alt="Muối Kiến Vàng">

                <div class="food-content">

                    <i class="fa-solid fa-fire"></i>

                    <h2>Muối Kiến Vàng</h2>

                    <p>
                        Đặc sản nổi tiếng vùng Ayun Pa và Krông Pa.
                        Muối được chế biến từ kiến vàng rừng,
                        có vị chua thanh và cay nồng,
                        thường dùng để chấm bò một nắng.
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

    </div>

</body>

</html>