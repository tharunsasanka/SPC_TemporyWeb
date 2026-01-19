<?php 
require_once 'config/db.php';
include 'includes/header.php'; 

$stmt = $pdo->query("SELECT * FROM clubs");
?>

<section class="section">
    <h1 class="section-title">Clubs & Societies</h1>
    <div class="card-grid">
        <?php while($club = $stmt->fetch()): ?>
            <div class="card">
                <div style="padding: 2rem; text-align: center;">
                    <img src="<?= !empty($club['logo_path']) ? $club['logo_path'] : 'assets/images/logo-light.png' ?>" style="width: 80px; height: 80px; object-fit: contain;">
                    <h3><?= htmlspecialchars($club['name']) ?></h3>
                    <p><?= htmlspecialchars($club['description']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>