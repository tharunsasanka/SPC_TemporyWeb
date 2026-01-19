<?php 
require_once 'config/db.php';
include 'includes/header.php'; 

$upcomingStmt = $pdo->query("SELECT * FROM events WHERE type='upcoming' ORDER BY event_date ASC");
$pastStmt = $pdo->query("SELECT * FROM events WHERE type='past' ORDER BY event_date DESC");
?>

<section class="section">
    <h1 class="section-title">Upcoming Events</h1>
    <div class="card-grid">
        <?php while($row = $upcomingStmt->fetch()): ?>
            <div class="card" style="border-left: 5px solid var(--secondary-color);">
                <div class="card-content">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <h4 style="color: var(--primary-color);"><?= $row['event_date'] ?></h4>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<section class="section" style="background: var(--card-bg);">
    <h2 class="section-title">Past Events</h2>
    <div class="card-grid">
        <?php while($row = $pastStmt->fetch()): ?>
            <div class="card" style="opacity: 0.8;">
                <div class="card-content">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <small><?= $row['event_date'] ?></small>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>