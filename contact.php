<?php 

$page_title = "Liên Hệ - Văn Hóa Gia Lai";
include 'includes/header.php'; 

if ($_POST) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Gửi email (cần cấu hình mail server)
    $to = "your-email@gmail.com";
    $subject = "Liên hệ từ website Văn Hóa Gia Lai";
    $body = "Họ tên: $name\nEmail: $email\n\nNội dung:\n$message";
    mail($to, $subject, $body);
    
    $success = "Cảm ơn bạn! Chúng tôi đã nhận được tin nhắn.";
}
?>
<div class="container my-5">
    <h2 class="text-center mb-5">Liên Hệ Với Chúng Tôi</h2>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php if(isset($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Họ và tên" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea name="message" rows="6" class="form-control" placeholder="Nội dung liên hệ..." required></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-lg">Gửi Tin Nhắn</button>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>