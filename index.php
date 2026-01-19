<?php
require_once 'config/db.php';
include 'includes/header.php';

// Fetch Latest News (Limit 3)
$newsStmt = $pdo->query("SELECT * FROM news ORDER BY publish_date DESC LIMIT 3");
$newsItems = $newsStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Upcoming Events (Limit 2)
$eventStmt = $pdo->query("SELECT * FROM events WHERE type='upcoming' ORDER BY event_date ASC LIMIT 2");
$events = $eventStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero">
    <h1>Welcome to Sripalee College</h1>
    <p>Excellence in Education, Character, and Culture</p>
    <a href="about.php" class="btn">Explore Our College</a>
</section>

<section class="section">
    <h2 class="section-title">Latest News</h2>
    <div class="card-grid">
        <?php foreach ($newsItems as $news): ?>
            <div class="card">
                <img src="<?= !empty($news['image_path']) ? $news['image_path'] : 'assets/images/sm.jpg' ?>" 
                     alt="Main Image" 
                     style="width:100%; height:200px; object-fit:cover;">

                <?php if (!empty($news['image_path_2'])): ?>
                    <img src="<?= $news['image_path_2'] ?>" 
                         alt="Second Image" 
                         style="width:100%; height:200px; object-fit:cover; margin-top:5px;">
                <?php endif; ?>

                <div class="card-content">
                    <h3><?= htmlspecialchars($news['title']) ?></h3>
                    <small><?= $news['publish_date'] ?></small>
                    <p><?= substr(htmlspecialchars($news['content']), 0, 100) ?>...</p>
                    <a href="news.php?id=<?= $news['id'] ?>" class="btn">Read More</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="section" style="background-color: var(--card-bg);">
    <h2 class="section-title">Upcoming Events</h2>
    <div class="card-grid">
        <?php foreach ($events as $event): ?>
            <div class="card">
                <div class="card-content" style="text-align: center;">
                    <h3><?= htmlspecialchars($event['title']) ?></h3>
                    <p style="font-size: 1.2rem; color: var(--primary-color); font-weight: bold;">
                        <?= $event['event_date'] ?>
                    </p>
                    <a href="events.php" class="btn">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="section">
    <h2 class="section-title">Life at Sripalee</h2>
    <div class="card-grid">
        <div class="card">
            <img src="assets/images/sports-bg.jpg" alt="Sports" style="height: 200px; width: 100%; object-fit: cover;">
            <div class="card-content">
                <h3>Sports</h3>
                <p>Champions in Cricket, Athletics, and more.</p>
                <a href="sports.php" class="btn">View Sports</a>
            </div>
        </div>
        <div class="card">
            <img src="assets/images/clubs-bg.jpg" alt="Clubs" style="height: 200px; width: 100%; object-fit: cover;">
            <div class="card-content">
                <h3>Clubs & Societies</h3>
                <p>Join the Media Unit, Science Society, and others.</p>
                <a href="clubs.php" class="btn">View Clubs</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>