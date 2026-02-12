<aside class="sidebar">
    <div class="sidebar-header">
        <h3>Menu</h3>
        <button class="sidebar-close" id="sidebar-close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <ul class="sidebar-menu">
        <li>
            <a href="/" class="<?php echo $page === 'home' ? 'active' : ''; ?>">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="/?page=trending" class="<?php echo $page === 'trending' ? 'active' : ''; ?>">
                <i class="fas fa-fire"></i>
                <span>Trending</span>
            </a>
        </li>
        <li>
            <a href="/?page=following" class="<?php echo $page === 'following' ? 'active' : ''; ?>">
                <i class="fas fa-user-friends"></i>
                <span>Following</span>
            </a>
        </li>
        <li>
            <a href="/?page=subscriptions" class="<?php echo $page === 'subscriptions' ? 'active' : ''; ?>">
                <i class="fas fa-star"></i>
                <span>Subscriptions</span>
            </a>
        </li>
        <li>
            <a href="/playlists.php">
                <i class="fas fa-list"></i>
                <span>Playlists</span>
            </a>
        </li>
        <li>
            <a href="/history.php">
                <i class="fas fa-history"></i>
                <span>History</span>
            </a>
        </li>
        <li>
            <a href="/watch-later.php">
                <i class="fas fa-clock"></i>
                <span>Watch Later</span>
            </a>
        </li>
        <li>
            <a href="/liked-videos.php">
                <i class="fas fa-thumbs-up"></i>
                <span>Liked Videos</span>
            </a>
        </li>
    </ul>
    
    <div class="sidebar-divider"></div>
    
    <div class="sidebar-section">
        <h4>Following</h4>
        <div class="following-list">
            <!-- Following users will be loaded here -->
            <?php
            if($isLoggedIn) {
                // Load following users
                $stmt = $conn->prepare("
                    SELECT u.username, u.profile_pic 
                    FROM follows f 
                    JOIN users u ON f.following_id = u.id 
                    WHERE f.follower_id = ? 
                    ORDER BY f.created_at DESC 
                    LIMIT 10
                ");
                $stmt->execute([$_SESSION['user_id']]);
                $following = $stmt->fetchAll();
                
                foreach($following as $user) {
                    echo '
                    <a href="/profile.php?user=' . $user['username'] . '" class="following-item">
                        <img src="' . ($user['profile_pic'] ?: 'assets/images/default-avatar.png') . '" 
                             alt="' . $user['username'] . '" class="following-avatar">
                        <span>' . $user['username'] . '</span>
                    </a>';
                }
            }
            ?>
        </div>
    </div>
    
    <div class="sidebar-divider"></div>
    
    <div class="sidebar-section">
        <h4>Categories</h4>
        <div class="category-list">
            <a href="/category.php?cat=gaming" class="category-item">
                <i class="fas fa-gamepad"></i>
                <span>Gaming</span>
            </a>
            <a href="/category.php?cat=music" class="category-item">
                <i class="fas fa-music"></i>
                <span>Music</span>
            </a>
            <a href="/category.php?cat=comedy" class="category-item">
                <i class="fas fa-laugh"></i>
                <span>Comedy</span>
            </a>
            <a href="/category.php?cat=sports" class="category-item">
                <i class="fas fa-football-ball"></i>
                <span>Sports</span>
            </a>
            <a href="/category.php?cat=education" class="category-item">
                <i class="fas fa-graduation-cap"></i>
                <span>Education</span>
            </a>
            <a href="/category.php?cat=beauty" class="category-item">
                <i class="fas fa-palette"></i>
                <span>Beauty</span>
            </a>
            <a href="/category.php?cat=food" class="category-item">
                <i class="fas fa-utensils"></i>
                <span>Food</span>
            </a>
            <a href="/category.php?cat=travel" class="category-item">
                <i class="fas fa-plane"></i>
                <span>Travel</span>
            </a>
        </div>
    </div>
    
    <div class="sidebar-footer">
        <a href="/settings.php" class="sidebar-link">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
        <a href="/help.php" class="sidebar-link">
            <i class="fas fa-question-circle"></i>
            <span>Help</span>
        </a>
        <a href="/feedback.php" class="sidebar-link">
            <i class="fas fa-comment-alt"></i>
            <span>Send Feedback</span>
        </a>
    </div>
</aside>

<style>
.sidebar {
    width: 250px;
    background-color: rgba(26, 26, 46, 0.95);
    padding: 20px 0;
    height: calc(100vh - 70px);
    position: fixed;
    left: 0;
    top: 70px;
    overflow-y: auto;
    backdrop-filter: blur(10px);
    border-right: 1px solid var(--border-color);
    z-index: 900;
    transition: transform 0.3s ease;
}

.sidebar-header {
    display: none;
    padding: 0 20px 20px;
    border-bottom: 1px solid var(--border-color);
    margin-bottom: 20px;
}

.sidebar-header h3 {
    color: var(--text-color);
    margin: 0;
}

.sidebar-close {
    display: none;
    background: none;
    border: none;
    color: var(--text-color);
    cursor: pointer;
    font-size: 1.2rem;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
}

.sidebar-menu li {
    margin-bottom: 5px;
}

.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px 20px;
    color: var(--text-color);
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    margin: 0 10px;
    border-radius: 8px;
}

.sidebar-menu a:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
}

.sidebar-menu a.active {
    background: linear-gradient(90deg, var(--primary-color), transparent);
    border-left: 3px solid var(--accent-color);
}

.sidebar-menu a.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background-color: var(--accent-color);
}

.sidebar-menu i {
    width: 20px;
    text-align: center;
    font-size: 1.1rem;
}

.sidebar-divider {
    height: 1px;
    background-color: var(--border-color);
    margin: 20px 20px;
}

.sidebar-section {
    padding: 0 20px;
    margin-bottom: 20px;
}

.sidebar-section h4 {
    color: var(--text-color);
    margin-bottom: 15px;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.8;
}

.following-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.following-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    color: var(--text-color);
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.following-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.following-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--primary-color);
}

.category-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.category-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    color: var(--text-color);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.category-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
}

.category-item i {
    width: 20px;
    text-align: center;
    font-size: 1rem;
}

.sidebar-footer {
    padding: 20px;
    border-top: 1px solid var(--border-color);
    margin-top: auto;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.sidebar-link:hover {
    color: var(--text-color);
}

/* Scrollbar Styling */
.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: var(--border-color);
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background-color: var(--primary-color);
}

/* Responsive Design */
@media (max-width: 992px) {
    .sidebar {
        transform: translateX(-100%);
        top: 60px;
        height: calc(100vh - 60px);
        width: 280px;
        box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
    }
    
    .sidebar.active {
        transform: translateX(0);
    }
    
    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .sidebar-close {
        display: block;
    }
}

@media (max-width: 576px) {
    .sidebar {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Close sidebar on mobile
    const sidebarClose = document.getElementById('sidebar-close');
    if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('active');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        const sidebar = document.querySelector('.sidebar');
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        
        if (window.innerWidth <= 992 && sidebar && sidebar.classList.contains('active')) {
            if (!sidebar.contains(e.target) && 
                !mobileMenuBtn.contains(e.target) && 
                e.target !== mobileMenuBtn) {
                sidebar.classList.remove('active');
            }
        }
    });
});
</script>