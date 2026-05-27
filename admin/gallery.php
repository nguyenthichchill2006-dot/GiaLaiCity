<?php 
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config/db.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-dark text-white min-vh-100 p-3">
            <h4>🌿 ADMIN</h4>
            <a href="index.php" class="nav-link text-white">Dashboard</a>
            <a href="posts.php" class="nav-link text-white">Bài viết</a>
            <a href="gallery.php" class="nav-link text-white active">Gallery</a>
        </div>
        <div class="col-md-10 p-4">
            <h2>Gallery Ảnh & Video</h2>
            
            <form action="upload_media.php" method="post" enctype="multipart/form-data" class="mb-4">
                <input type="file" name="media[]" multiple accept="image/*,video/*" class="form-control d-inline w-75">
                <button type="submit" class="btn btn-success">Tải lên</button>
            </form>

            <div class="row">
                <?php
                $files = glob("../uploads/*.{jpg,jpeg,png,gif,mp4,webm}", GLOB_BRACE);
                foreach($files as $file):
                    $filename = basename($file);
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <?php if(in_array($ext, ['mp4','webm'])): ?>
                                <video width="100%" controls>
                                    <source src="<?= $file ?>" type="video/<?= $ext ?>">
                                </video>
                            <?php else: ?>
                                <img src="<?= $file ?>" class="card-img-top" style="height:180px; object-fit:cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <small><?= $filename ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>