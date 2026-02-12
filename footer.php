<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <div class="footer-logo">
                <i class="fas fa-star"></i>
                <h3>Star Vibe</h3>
            </div>
            <p class="footer-description">
                Your ultimate destination for short video entertainment. 
                Create, share, and discover amazing content.
            </p>
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
                <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul class="footer-links">
                <li><a href="/">Home</a></li>
                <li><a href="/?page=trending">Trending</a></li>
                <li><a href="/?page=following">Following</a></li>
                <li><a href="/?page=upload">Upload</a></li>
                <li><a href="/about.php">About Us</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Legal</h4>
            <ul class="footer-links">
                <li><a href="/privacy.php">Privacy Policy</a></li>
                <li><a href="/terms.php">Terms of Service</a></li>
                <li><a href="/cookies.php">Cookie Policy</a></li>
                <li><a href="/community.php">Community Guidelines</a></li>
                <li><a href="/contact.php">Contact Us</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Support</h4>
            <ul class="footer-links">
                <li><a href="/help.php">Help Center</a></li>
                <li><a href="/safety.php">Safety Center</a></li>
                <li><a href="/report.php">Report Content</a></li>
                <li><a href="/creator.php">Creator Portal</a></li>
                <li><a href="/advertise.php">Advertise</a></li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> Star Vibe. All rights reserved.</p>
        </div>
        <div class="footer-info">
            <p>Made with <i class="fas fa-heart" style="color: #ff416c;"></i> for video creators</p>
        </div>
        <div class="language-selector">
            <select id="language-select">
                <option value="en" selected>English</option>
                <option value="es">Español</option>
                <option value="fr">Français</option>
                <option value="de">Deutsch</option>
                <option value="si">සිංහල</option>
            </select>
        </div>
    </div>
</footer>

<style>
.footer {
    background: linear-gradient(135deg, var(--light-bg), var(--dark-bg));
    padding: 40px 20px 20px;
    margin-top: 40px;
    border-top: 1px solid var(--border-color);
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-section {
    padding: 0 15px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.footer-logo i {
    color: var(--accent-color);
    font-size: 1.8rem;
}

.footer-logo h3 {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.footer-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 20px;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: var(--text-color);
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background-color: var(--primary-color);
    transform: translateY(-3px);
}

.footer-section h4 {
    color: var(--text-color);
    margin-bottom: 20px;
    font-size: 1.2rem;
    position: relative;
    padding-bottom: 10px;
}

.footer-section h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), transparent);
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.footer-links a::before {
    content: '›';
    color: var(--primary-color);
}

.footer-links a:hover {
    color: var(--text-color);
    padding-left: 5px;
}

.footer-bottom {
    max-width: 1200px;
    margin: 30px auto 0;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.copyright, .footer-info {
    color: var(--text-secondary);
}

.language-selector select {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--border-color);
    color: var(--text-color);
    padding: 8px 15px;
    border-radius: 5px;
    outline: none;
    cursor: pointer;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .footer-content {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Language selector
    const languageSelect = document.getElementById('language-select');
    if (languageSelect) {
        languageSelect.addEventListener('change', function() {
            // In a real app, this would change the language
            console.log('Language changed to:', this.value);
        });
    }
});
</script>