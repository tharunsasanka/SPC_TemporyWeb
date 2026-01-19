<?php 
require_once 'config/db.php';
include 'includes/header.php'; 

// --- SINGLE NEWS VIEW (When you click Read More) ---
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $newsItem = $stmt->fetch();

    if ($newsItem):
?>
    <section class="section">
        <div style="max-width: 800px; margin: auto;">
            <h1><?= htmlspecialchars($newsItem['title']) ?></h1>
            <p style="color: gray;">Published on <?= $newsItem['publish_date'] ?></p>
            
            <img src="<?= !empty($newsItem['image_path']) ? $newsItem['image_path'] : 'assets/images/sm.jpg' ?>" 
                 style="width: 100%; border-radius: 10px; margin-top: 1rem;">

            <?php if (!empty($newsItem['image_path_2'])): ?>
                 <img src="<?= $newsItem['image_path_2'] ?>" 
                      style="width: 100%; border-radius: 10px; margin-top: 1rem;">
            <?php endif; ?>

            <div class="content" style="font-size: 1.1rem; line-height: 1.6; margin-top: 1rem;">
                <?= nl2br(htmlspecialchars($newsItem['content'])) ?>
            </div>
            <br>
            <a href="news.php" class="btn">← Back to News</a>
        </div>
    </section>
<?php 
    else: 
        echo "<p class='section' style='text-align:center;'>News item not found.</p>";
    endif;

// --- ALL NEWS LIST VIEW ---
} else {
    $stmt = $pdo->query("SELECT * FROM news ORDER BY publish_date DESC");
    $allNews = $stmt->fetchAll();
?>
    <section class="section">
        <h1 class="section-title">College News</h1>
        <div class="card-grid">
            <?php foreach ($allNews as $news): ?>
                <div class="card">
                    <img src="<?= !empty($news['image_path']) ? $news['image_path'] : 'assets/images/sm.jpg' ?>" 
                         alt="News" 
                         style="width:100%; height:200px; object-fit:cover;">
                    
                    <?php if (!empty($news['image_path_2'])): ?>
                        <img src="<?= $news['image_path_2'] ?>" 
                             alt="News 2nd" 
                             style="width:100%; height:200px; object-fit:cover; margin-top:5px;">
                    <?php endif; ?>

                    <div class="card-content">
                        <h3><?= htmlspecialchars($news['title']) ?></h3>
                        <small><?= $news['publish_date'] ?></small>
                        <a href="news.php?id=<?= $news['id'] ?>" class="btn" style="display:block; margin-top:10px; text-align:center;">Read Full Article</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php } ?>

<?php include 'includes/footer.php'; ?>