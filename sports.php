<?php 
require_once 'config/db.php';
include 'includes/header.php'; 

$stmt = $pdo->query("SELECT * FROM sports");
?>

<section class="section">
    <h1 class="section-title">Sports at Sripalee</h1>
    <div class="card-grid">
        <?php while($sport = $stmt->fetch()): ?>
            <div class="card">
                <img src="<?= !empty($sport['image_path']) ? $sport['image_path'] : 'assets/images/sports-bg.jpg' ?>" style="height: 150px;">
                <div class="card-content">
                    <h3><?= htmlspecialchars($sport['name']) ?></h3>
                    <p><strong>Achievements:</strong></p>
                    <p><?= nl2br(htmlspecialchars($sport['achievements'])) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>