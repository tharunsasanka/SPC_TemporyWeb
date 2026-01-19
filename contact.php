<?php 
require_once 'config/db.php';
include 'includes/header.php'; 

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$name, $email, $subject, $message])) {
            $msg = "<p style='color: green; text-align:center;'>Message sent successfully!</p>";
        } else {
            $msg = "<p style='color: red; text-align:center;'>Error sending message.</p>";
        }
    } else {
        $msg = "<p style='color: red; text-align:center;'>Please fill in all required fields.</p>";
    }
}
?>

<section class="section">
    <h1 class="section-title">Contact Us</h1>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; max-width: 1000px; margin: auto;">
        
        <div>
            <h3>Get in Touch</h3>
            <p><strong>Address:</strong> Sripalee College, Horana, Sri Lanka</p>
            <p><strong>Phone:</strong> +94 34 226 1234</p>
            <p><strong>Email:</strong> info@sripaleecollege.lk</p>
            
            <div style="margin-top: 2rem;">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="https://facebook.com" target="_blank" class="social-link facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank" class="social-link instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com" target="_blank" class="social-link youtube"><i class="fab fa-youtube"></i></a>
                    <a href="https://tiktok.com" target="_blank" class="social-link tiktok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <div class="card" style="padding: 2rem;">
            <?= $msg ?>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Your Name" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
                <input type="email" name="email" placeholder="Your Email" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
                <input type="text" name="subject" placeholder="Subject" style="width: 100%; padding: 10px; margin-bottom: 10px;">
                <textarea name="message" rows="5" placeholder="Message" required style="width: 100%; padding: 10px; margin-bottom: 10px;"></textarea>
                <button type="submit" class="btn" style="width: 100%;">Send Message</button>
            </form>
        </div>

    </div>

    <div style="margin-top: 3rem;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63408.79743389033!2d80.02058428805367!3d6.715364893700018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae24fd7f6d4359d%3A0x6295513511456570!2sHorana!5e0!3m2!1sen!2slk!4v1700000000000" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>

<?php include 'includes/footer.php'; ?>s/footer.php'; ?>