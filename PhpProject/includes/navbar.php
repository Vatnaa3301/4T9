<header>
    <div class="header-container">
        <div class="top-bar">
            <a href="index.php" class="logo">4T9</a>
            
            <div class="top-actions">
                <div class="search-box">
                    <input type="text" placeholder="SEARCH">
                </div>
                <a href="admin/login.php">LOG IN</a>
                <a href="about.php">ABOUT</a>
                <a href="#" onclick="openCart(); return false;" class="cart-icon">
                    SHOPPING BAG
                    <span class="cart-count" id="cartCount" style="display: none;">0</span>
                </a>
            </div>
        </div>
        
        <nav>
            <div class="main-nav">
                <ul class="nav-links">
                    <li><a href="men.php">MEN</a></li>
                    <li><a href="women.php">WOMEN</a></li>
                    <li><a href="accessories.php">ACCESSORIES</a></li>
                </ul>
                
                <div class="view-options">
                    <span class="view-label">VIEW</span>
                    <button class="view-btn active">2</button>
                    <button class="view-btn">3</button>
                    <button class="filters-btn">FILTERS</button>
                </div>
            </div>
        </nav>
    </div>
</header>
