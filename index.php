<?php
session_start();
require_once 'config/database.php';
require_once 'config/security.php';
require_once 'config/encryption.php';

$db = new Database();
$conn = $db->connect();
$security = new Security($conn);
$encryption = new Encryption();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Get current page
$page = isset($_GET['page']) ? $security->sanitizeInput($_GET['page']) : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data: https:; media-src 'self' https:; connect-src 'self' https:;">
    <meta name="csrf-token" content="<?php echo $security->csrfToken(); ?>">
    <title>Star Vibe - Short Video Platform</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png">
</head>
<body>
    <!-- Loading Splash Screen -->
    <div id="splash-screen">
        <div class="splash-content">
            <div class="logo-animation">
                <i class="fas fa-star"></i>
                <h1>Star Vibe</h1>
            </div>
            <div class="loading-spinner"></div>
            <p>Loading your video experience...</p>
        </div>
    </div>

    <!-- No Internet Connection Message -->
    <div id="offline-message" style="display: none;">
        <div class="offline-alert">
            <i class="fas fa-wifi-slash"></i>
            <h3>No Internet Connection</h3>
            <p>Please check your network connection</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container" id="main-container" style="display: none;">
        <!-- Navigation Bar -->
        <?php include 'includes/navbar.php'; ?>
        
        <div class="main-content">
            <!-- Sidebar -->
            <?php if($isLoggedIn): ?>
                <?php include 'includes/sidebar.php'; ?>
            <?php endif; ?>
            
            <!-- Main Area -->
            <div class="content-area">
                <?php
                // Route based on page parameter
                if(!$isLoggedIn) {
                    switch($page) {
                        case 'register':
                            include 'auth/register.php';
                            break;
                        case 'login':
                        default:
                            include 'auth/login.php';
                    }
                } else {
                    switch($page) {
                        case 'upload':
                            include 'modules/video-upload.php';
                            break;
                        case 'profile':
                            include 'modules/profile.php';
                            break;
                        case 'following':
                            include 'modules/following.php';
                            break;
                        case 'trending':
                            include 'modules/trending.php';
                            break;
                        case 'home':
                        default:
                            include 'modules/video-feed.php';
                    }
                }
                ?>
            </div>
        </div>
        
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>

    <!-- JavaScript Files -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/offline.js"></script>
    <?php if($isLoggedIn): ?>
        <script src="assets/js/video.js"></script>
        <script src="assets/js/likes.js"></script>
    <?php else: ?>
        <script src="assets/js/auth.js"></script>
    <?php endif; ?>
    
    <script>
        // Show splash screen for 3 seconds
        setTimeout(() => {
            document.getElementById('splash-screen').style.opacity = '0';
            document.getElementById('main-container').style.display = 'block';
            
            setTimeout(() => {
                document.getElementById('splash-screen').style.display = 'none';
            }, 500);
        }, 3000);
    </script>
</body>
</html>
<?php $db->disconnect(); ?>