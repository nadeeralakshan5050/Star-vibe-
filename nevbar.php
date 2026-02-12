<nav class="navbar">
    <div class="nav-brand">
        <a href="/">
            <i class="fas fa-star"></i>
            <h2>Star Vibe</h2>
        </a>
    </div>
    
    <div class="nav-search">
        <form action="/search.php" method="GET" class="search-form">
            <input type="text" name="q" placeholder="Search videos, creators, tags..." 
                   class="search-input" id="search-input">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    
    <div class="nav-menu">
        <?php if($isLoggedIn): ?>
            <!-- Upload Button -->
            <a href="/?page=upload" class="nav-link upload-btn">
                <i class="fas fa-plus-circle"></i>
                <span>Upload</span>
            </a>
            
            <!-- Notifications -->
            <div class="notification-dropdown">
                <button class="nav-link notification-btn" id="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count">3</span>
                </button>
                <div class="notification-menu" id="notification-menu">
                    <div class="notification-header">
                        <h4>Notifications</h4>
                        <a href="#" class="mark-all-read">Mark all as read</a>
                    </div>
                    <div class="notification-list">
                        <!-- Notifications will be loaded here -->
                    </div>
                    <a href="/notifications.php" class="view-all">View all notifications</a>
                </div>
            </div>
            
            <!-- Messages -->
            <a href="/messages.php" class="nav-link">
                <i class="fas fa-envelope"></i>
            </a>
            
            <!-- User Profile -->
            <div class="user-dropdown">
                <button class="user-menu-btn">
                    <img src="<?php echo $_SESSION['user_avatar'] ?? 'assets/images/default-avatar.png'; ?>" 
                         alt="Profile" class="user-avatar">
                    <span><?php echo $_SESSION['username'] ?? 'User'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-menu">
                    <a href="/profile.php" class="user-menu-item">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <a href="/settings.php" class="user-menu-item">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <a href="/creator.php" class="user-menu-item">
                        <i class="fas fa-video"></i> Creator Studio
                    </a>
                    <a href="/analytics.php" class="user-menu-item">
                        <i class="fas fa-chart-line"></i> Analytics
                    </a>
                    <div class="user-menu-divider"></div>
                    <a href="/auth/logout.php" class="user-menu-item logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Guest Menu -->
            <a href="/?page=login" class="nav-link login-btn">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
            <a href="/?page=register" class="nav-link register-btn">
                <i class="fas fa-user-plus"></i>
                <span>Register</span>
            </a>
        <?php endif; ?>
    </div>
    
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobile-menu-btn">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<style>
.navbar {
    background: linear-gradient(90deg, rgba(15, 15, 35, 0.95), rgba(26, 26, 46, 0.95));
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000;
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border-color);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.nav-brand a {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.nav-brand i {
    color: var(--accent-color);
    font-size: 1.8rem;
}

.nav-brand h2 {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-size: 1.8rem;
    margin: 0;
}

.nav-search {
    flex: 1;
    max-width: 500px;
    margin: 0 20px;
}

.search-form {
    display: flex;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 10px 45px 10px 15px;
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    border-radius: 25px;
    color: var(--text-color);
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    background-color: rgba(255, 255, 255, 0.15);
    border-color: var(--primary-color);
    box-shadow: 0 0 0 2px rgba(106, 17, 203, 0.2);
}

.search-btn {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.search-btn:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: var(--text-color);
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 15px;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 15px;
    color: var(--text-color);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.nav-link.upload-btn {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    padding: 8px 20px;
}

.nav-link.upload-btn:hover {
    box-shadow: 0 5px 15px rgba(106, 17, 203, 0.4);
}

/* Notification Dropdown */
.notification-dropdown {
    position: relative;
}

.notification-btn {
    position: relative;
}

.notification-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: var(--accent-color);
    color: white;
    font-size: 0.7rem;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification-menu {
    position: absolute;
    top: 100%;
    right: 0;
    width: 350px;
    background-color: var(--light-bg);
    border: 1px solid var(--border-color);
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    display: none;
    z-index: 1000;
    margin-top: 10px;
}

.notification-menu::before {
    content: '';
    position: absolute;
    top: -10px;
    right: 20px;
    border-width: 0 10px 10px 10px;
    border-style: solid;
    border-color: transparent transparent var(--light-bg) transparent;
}

.notification-dropdown:hover .notification-menu {
    display: block;
}

.notification-header {
    padding: 15px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notification-header h4 {
    margin: 0;
    color: var(--text-color);
}

.mark-all-read {
    color: var(--primary-color);
    text-decoration: none;
    font-size: 0.9rem;
}

.notification-list {
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
}

.view-all {
    display: block;
    text-align: center;
    padding: 10px;
    color: var(--primary-color);
    text-decoration: none;
    border-top: 1px solid var(--border-color);
}

/* User Dropdown */
.user-dropdown {
    position: relative;
}

.user-menu-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: none;
    border: none;
    color: var(--text-color);
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.user-menu-btn:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.user-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--primary-color);
}

.user-menu {
    position: absolute;
    top: 100%;
    right: 0;
    width: 200px;
    background-color: var(--light-bg);
    border: 1px solid var(--border-color);
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    display: none;
    z-index: 1000;
    margin-top: 10px;
}

.user-menu::before {
    content: '';
    position: absolute;
    top: -10px;
    right: 20px;
    border-width: 0 10px 10px 10px;
    border-style: solid;
    border-color: transparent transparent var(--light-bg) transparent;
}

.user-dropdown:hover .user-menu {
    display: block;
}

.user-menu-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 15px;
    color: var(--text-color);
    text-decoration: none;
    transition: all 0.3s ease;
}

.user-menu-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    padding-left: 20px;
}

.user-menu-item.logout {
    color: var(--danger-color);
}

.user-menu-divider {
    height: 1px;
    background-color: var(--border-color);
    margin: 5px 0;
}

/* Mobile Menu Button */
.mobile-menu-btn {
    display: none;
    background: none;
    border: none;
    color: var(--text-color);
    font-size: 1.5rem;
    cursor: pointer;
    padding: 5px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .nav-search {
        display: none;
    }
    
    .mobile-menu-btn {
        display: block;
    }
    
    .notification-menu {
        position: fixed;
        top: 70px;
        right: 20px;
        left: 20px;
        width: auto;
    }
    
    .user-menu {
        position: fixed;
        top: 70px;
        right: 20px;
        left: 20px;
        width: auto;
    }
}

@media (max-width: 576px) {
    .navbar {
        padding: 10px 15px;
    }
    
    .nav-brand h2 {
        font-size: 1.4rem;
    }
    
    .nav-link span {
        display: none;
    }
    
    .nav-link {
        padding: 8px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                sidebar.classList.toggle('active');
            }
        });
    }
    
    // Search functionality
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    }
    
    // Load notifications
    const notificationBtn = document.getElementById('notification-btn');
    if (notificationBtn && notificationBtn.classList.contains('logged-in')) {
        loadNotifications();
    }
});

async function loadNotifications() {
    try {
        const response = await fetch('/api/get-notifications');
        const data = await response.json();
        
        if (data.success) {
            const notificationList = document.querySelector('.notification-list');
            if (notificationList) {
                notificationList.innerHTML = data.notifications.map(notification => `
                    <div class="notification-item ${notification.read ? 'read' : 'unread'}">
                        <div class="notification-avatar">
                            <img src="${notification.user_avatar}" alt="${notification.user_name}">
                        </div>
                        <div class="notification-content">
                            <p>${notification.message}</p>
                            <span class="notification-time">${notification.time_ago}</span>
                        </div>
                    </div>
                `).join('');
            }
        }
    } catch (error) {
        console.error('Failed to load notifications:', error);
    }
}
</script>