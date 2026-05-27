<?php 
session_start();
include 'config/db.php';

if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    die("Không tìm thấy bài viết");
}

$slug = $_GET['slug'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    die("Bài viết không tồn tại hoặc đã bị xóa.");
}

// Tăng lượt xem
$pdo->prepare("UPDATE posts SET views = views + 1 WHERE id = ?")
     ->execute([$post['id']]);

$page_title = htmlspecialchars($post['title']);
include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <article class="card shadow-sm border-0 overflow-hidden">
                
                <?php if (!empty($post['image'])): ?>
                    <img src="<?= htmlspecialchars($post['image']) ?>" 
                         class="card-img-top w-100" 
                         style="max-height: 520px;" 
                         alt="<?= htmlspecialchars($post['title']) ?>">
                <?php endif; ?>

                <div class="card-body p-4 p-md-5">
                    <h1 class="fs-2 fw-bold mb-3"><?= htmlspecialchars($post['title']) ?></h1>
                    
                    <div class="d-flex flex-wrap gap-3 text-muted mb-4">
                        <span>📅 <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></span>
                        <span>👁️ <?= number_format($post['views']) ?> lượt xem</span>
                        <?php if (!empty($post['category'])): ?>
                            <span class="badge bg-primary"><?= htmlspecialchars($post['category']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="content fs-5 lh-lg">
                        <?= $post['content'] ?>   
                    </div>

                    <!-- Reaction -->
                    <div class="border-top border-bottom py-3 my-4 d-flex gap-2">
                        <button onclick="likePost(<?= $post['id'] ?>)" id="like-btn" 
                                class="btn btn-light flex-grow-1 d-flex align-items-center justify-content-center gap-2">
                            <span id="like-icon">❤️</span> 
                            <span id="like-count">0</span> Thích
                        </button>
                        
                        <button onclick="sharePost()" 
                                class="btn btn-light flex-grow-1 d-flex align-items-center justify-content-center gap-2">
                            📤 Chia sẻ
                        </button>
                    </div>

                    <!-- Comment -->
                    <h5 class="mb-3">💬 Bình luận <span id="comment-count" class="text-muted">(0)</span></h5>
                    <div id="comments-list" class="mb-4"></div>

                    <?php if (isset($_SESSION['user'])): ?>
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width:45px;height:45px;">👤</div>
                        </div>
                        <div class="flex-grow-1">
                            <textarea id="comment-text" class="form-control" rows="3" 
                                placeholder="Viết bình luận của bạn..."></textarea>
                            <div class="text-end mt-2">
                                <button onclick="postComment(<?= $post['id'] ?>)" 
                                        class="btn btn-primary">Đăng bình luận</button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info text-center">
                        <a href="login.php" class="text-decoration-underline">Đăng nhập</a> để bình luận
                    </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    </div>
</div>

<script>
async function likePost(postId) { /* giữ nguyên code like */ }
async function postComment(postId) { /* giữ nguyên */ }
async function loadComments(postId) { /* giữ nguyên */ }

loadComments(<?= $post['id'] ?>);
</script>

<?php include 'includes/footer.php'; ?>