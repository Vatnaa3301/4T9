<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store - Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #000;
            background: #fff;
            line-height: 1.6;
        }

        /* Header & Navigation */
        header {
            border-bottom: 1px solid #e5e5e5;
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
        }

        .menu-icon {
            display: flex;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            width: 24px;
        }

        .menu-icon span {
            display: block;
            height: 2px;
            background: #000;
            transition: 0.3s;
        }

        .logo {
            font-size: 42px;
            font-weight: 900;
            letter-spacing: -2px;
            text-decoration: none;
            color: #000;
        }

        .top-actions {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            border: none;
            border-bottom: 1px solid #000;
            padding: 5px 0;
            font-size: 11px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            width: 180px;
            background: transparent;
            outline: none;
        }

        .top-actions a {
            text-decoration: none;
            color: #000;
            font-size: 11px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: color 0.3s;
        }

        .top-actions a:hover {
            color: #666;
        }

        /* Main Navigation */
        nav {
            border-top: 1px solid #e5e5e5;
        }

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #000;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: color 0.3s;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #666;
        }

        .view-options {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .view-label {
            font-size: 11px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .view-btn {
            border: 1px solid #000;
            background: transparent;
            padding: 4px 10px;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .view-btn:hover,
        .view-btn.active {
            background: #000;
            color: #fff;
        }

        .filters-btn {
            border: 1px solid #000;
            background: transparent;
            padding: 6px 16px;
            font-size: 11px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filters-btn:hover {
            background: #000;
            color: #fff;
        }

        /* Main Content */
        main {
            padding: 0;
        }

        /* Hero Slider */
        .hero-slider {
            position: relative;
            width: 100%;
            height: 600px;
            overflow: hidden;
            background: #f5f5f5;
        }

        .hero-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 2s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-content {
            position: absolute;
            text-align: center;
            color: #fff;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 64px;
            font-weight: 300;
            letter-spacing: 8px;
            text-transform: uppercase;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .hero-content p {
            font-size: 16px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .hero-btn {
            background: #fbfbfb;
            color: #000;
            border: 1px solid #000000;
            padding: 14px 40px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .hero-btn:hover {
            background: #000;
            color: #fff;
        }

        /* Slider Navigation */
        .slider-nav {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 3;
        }

        .slider-dot {
            width: 0px;
            height: 0px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            border: 1px solid #fff;
            cursor: pointer;
            transition: all 0.3s;
        }

        .slider-dot.active {
            background: #fff;
        }

        .slider-arrows {
            position: absolute;
            width: 100%;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 3;
        }

        .slider-arrow {
            background: rgba(255, 255, 255, 0);
            border: none;
            width: 45px;
            height: 45px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 20px;
            color: #ffffffff;
        }

        .slider-arrow:hover {
            background: #fff;
            color: #000;
        }

        /* Category Cards */
        .category-section {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 40px;
        }

        .category-section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .category-section-title h2 {
            font-size: 14px;
            font-weight: 400;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 15px;
        }

        .category-section-title h1 {
            font-size: 48px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #000;
            margin-bottom: 20px;
        }

        .category-section-title .divider {
            width: 80px;
            height: 2px;
            background: #000;
            margin: 0 auto;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .category-card {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            height: 500px;
            border-radius: 2px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease, filter 0.3s ease;
        }

        .category-card:hover img {
            transform: scale(1.08);
            filter: brightness(0.8);
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 60%, transparent 100%);
            padding: 50px 35px;
            color: #fff;
            transition: all 0.3s ease;
        }

        .category-card:hover .category-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.6) 60%, transparent 100%);
            padding: 55px 35px;
        }

        .category-card h3 {
            font-size: 42px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 12px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
            transition: all 0.3s ease;
        }

        .category-card:hover h3 {
            letter-spacing: 5px;
            transform: translateY(-5px);
        }

        .category-card p {
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.95;
            font-weight: 400;
            border-left: 3px solid #fff;
            padding-left: 15px;
            transition: all 0.3s ease;
        }

        .category-card:hover p {
            padding-left: 20px;
            opacity: 1;
        }

        /* Featured Products */
        .featured-section {
            max-width: 1400px;
            margin: 80px auto;
            padding: 0 40px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5;
        }

        .section-header h2 {
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .view-all-btn {
            background: transparent;
            color: #000;
            border: 1px solid #000;
            padding: 10px 30px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .view-all-btn:hover {
            background: #000;
            color: #fff;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .product-card {
            position: relative;
            cursor: pointer;
        }

        .product-image {
            position: relative;
            width: 100%;
            height: 450px;
            overflow: hidden;
            background: #f5f5f5;
            margin-bottom: 15px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #000;
            color: #fff;
            padding: 6px 12px;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .quick-add {
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
            background: #fff;
            border: none;
            padding: 12px;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .product-card:hover .quick-add {
            opacity: 1;
        }

        .quick-add:hover {
            background: #000;
            color: #fff;
        }

        .product-info {
            text-align: left;
        }

        .product-name {
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
            color: #000;
        }

        .product-price {
            font-size: 14px;
            font-weight: 500;
            color: #000;
        }

        .product-colors {
            display: flex;
            gap: 6px;
            margin-top: 8px;
        }

        .color-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 1px solid #e5e5e5;
            cursor: pointer;
        }

        /* Footer */
        footer {
            background: #f8f8f8;
            border-top: 1px solid #e5e5e5;
            margin-top: 80px;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 50px 40px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section ul li a {
            color: #666;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: #000;
        }

        .newsletter input {
            border: none;
            border-bottom: 1px solid #000;
            padding: 8px 0;
            font-size: 13px;
            width: 100%;
            background: transparent;
            outline: none;
            margin-bottom: 10px;
        }

        .newsletter button {
            background: #000;
            color: #fff;
            border: none;
            padding: 10px 24px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .newsletter button:hover {
            background: #333;
        }

        .footer-bottom {
            border-top: 1px solid #e5e5e5;
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-bottom p {
            font-size: 12px;
            color: #666;
        }

        .social-links {
            display: flex;
            gap: 20px;
        }

        .social-links a {
            color: #666;
            text-decoration: none;
            font-size: 12px;
            text-transform: uppercase;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #000;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-container,
            .footer-container,
            .category-section,
            .featured-section {
                padding: 0 20px;
            }

            .nav-links {
                gap: 15px;
            }

            .nav-links a {
                font-size: 11px;
            }

            .hero-slider {
                height: 400px;
            }

            .hero-content h1 {
                font-size: 36px;
                letter-spacing: 4px;
            }

            .hero-content p {
                font-size: 13px;
            }

            .category-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .category-card {
                height: 350px;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .product-image {
                height: 300px;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .logo {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
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
                    <a href="#" onclick="openCart(); return false;" style="position: relative;">SHOPPING BAG <span id="cartCount" style="position: absolute; top: -8px; right: -8px; background: #000; color: #fff; border-radius: 50%; width: 18px; height: 18px; font-size: 10px; display: flex; align-items: center; justify-content: center; font-weight: bold;">0</span></a>
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

    <!-- Main Content -->
    <main>
        <!-- Hero Slider -->
        <section class="hero-slider">
            <div class="hero-slide active">
                <img src="image/hero4.png" alt="New Collection">
                <div class="hero-content">
                    <h1>MEN</h1>
                    <p>Discover the MEN Collection</p>
                    <a href="men.php" class="hero-btn">Shop Now</a>
                </div>
            </div>
            
            <div class="hero-slide">
                <img src="image/hero2.png" alt="Winter Collection">
                <div class="hero-content">
                    <h1>WOMEN STYLE</h1>
                    <p>Discover the WOMEN Collection</p>
                    <a href="women.php" class="hero-btn">Explore</a>
                </div>
            </div>
            
            <div class="hero-slide">
                <img src="image/hero5.png" alt="Accessories">
                <div class="hero-content">
                    <h1>ACCESSORIES</h1>
                    <p>Complete Your Look</p>
                    <a href="accessories.php" class="hero-btn">View All</a>
                </div>
            </div>
            
            <div class="slider-arrows">
                <button class="slider-arrow prev" onclick="changeSlide(-1)">‹</button>
                <button class="slider-arrow next" onclick="changeSlide(1)">›</button>
            </div>
            
            <div class="slider-nav">
                <span class="slider-dot active" onclick="currentSlide(0)"></span>
                <span class="slider-dot" onclick="currentSlide(1)"></span>
                <span class="slider-dot" onclick="currentSlide(2)"></span>
            </div>
        </section>

        <!-- Category Cards -->
        <section class="category-section">
            <div class="category-section-title">
                <h2>Shop By</h2>
                <h1>CATEGORY</h1>
                <div class="divider"></div>
            </div>
            
            <div class="category-grid">
                <div class="category-card" onclick="window.location.href='men.php'">
                    <img src="image/MEN.png" alt="Men's Collection">
                    <div class="category-overlay">
                        <h3>MEN</h3>
                        <p>Explore Collection</p>
                    </div>
                </div>
                
                <div class="category-card" onclick="window.location.href='women.php'">
                    <img src="image/WOMEN.png" alt="Women's Collection">
                    <div class="category-overlay">
                        <h3>WOMEN</h3>
                        <p>Explore Collection</p>
                    </div>
                </div>
                
                <div class="category-card" onclick="window.location.href='accessories.php'">
                    <img src="image/ACC.png" alt="Accessories">
                    <div class="category-overlay">
                        <h3>ACCESSORIES</h3>
                        <p>Explore Collection</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Products -->
        <section class="featured-section">
            <div class="section-header">
                <h2>Featured Products</h2>
                <a href="#" class="view-all-btn">View All Products</a>
            </div>
            
            <div class="products-grid">
                <!-- Product 1 -->
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge">New</span>
                        <img src="image/accessories/Keepall Bandoulière 25.png" alt="Keepall Bandoulière 25">
                        <button class="quick-add" onclick="addToCart(1, 'featured')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">Keepall Bandoulière 25</div>
                        <div class="product-price">$59.99</div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #000;"></span>
                            <span class="color-dot" style="background: #fff;"></span>
                            <span class="color-dot" style="background: #888;"></span>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="image/menpage/RELAXED FIT ABSTRACT PRINT SHIRT.png" alt="Relaxed Fit Abstract Print Shirt">
                        <button class="quick-add" onclick="addToCart(2, 'featured')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">Relaxed Fit Abstract Print Shirt</div>
                        <div class="product-price">$89.99</div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #4169E1;"></span>
                            <span class="color-dot" style="background: #000;"></span>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge">Sale</span>
                        <img src="image/menpage/TEXTURED EMBROIDERY SHIRT.png" alt="Textured Embroidery Shirt">
                        <button class="quick-add" onclick="addToCart(3, 'featured')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">Textured Embroidery Shirt</div>
                        <div class="product-price">$59.99</div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #FFC0CB;"></span>
                            <span class="color-dot" style="background: #87CEEB;"></span>
                            <span class="color-dot" style="background: #fff; border-color: #000;"></span>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="image/accessories/Vivienne Backpack.png" alt="Vivienne Backpack">
                        <button class="quick-add" onclick="addToCart(4, 'featured')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">Vivienne Backpack</div>
                        <div class="product-price">$79.99</div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #fff; border-color: #000;"></span>
                            <span class="color-dot" style="background: #000;"></span>
                        </div>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge">New</span>
                        <img src="image/accessories/Montsouris PM.png" alt="Leather Crossbody Bag">
                        <button class="quick-add" onclick="addToCart(5, 'featured')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">Leather Crossbody Bag</div>
                        <div class="product-price">$119.99</div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #8B4513;"></span>
                            <span class="color-dot" style="background: #000;"></span>
                        </div>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="image/accessories/LV x TM Venice NM.png" alt="LV x TM Venice NM">
                        <button class="quick-add" onclick="addToCart(6, 'featured')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">LV x TM Venice NM</div>
                        <div class="product-price">$49.99</div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #808080;"></span>
                            <span class="color-dot" style="background: #000;"></span>
                            <span class="color-dot" style="background: #F5F5DC;"></span>
                        </div>
                    </div>
                </div>

                <!-- Product 7 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="image/womenpage/Monogram Toweling Cardigan.png" alt="Monogram Toweling Cardigan">
                        <button class="quick-add" onclick="addToCart(7, 'featured')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">Monogram Toweling Cardigan</div>
                        <div class="product-price">$69.99</div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #000;"></span>
                            <span class="color-dot" style="background: #D2B48C;"></span>
                        </div>
                    </div>
                </div>

                <!-- Product 8 -->
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge">Sale</span>
                        <img src="image/accessories/Christopher MM.png" alt="Christopher MM">
                        <button class="quick-add" onclick="addToCart(8, 'featured')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">Christopher MM</div>
                        <div class="product-price">$39.99</div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #FFD700;"></span>
                            <span class="color-dot" style="background: #C0C0C0;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Hero Slider Functionality
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.slider-dot');
        
        // Auto-slide every 5 seconds
        setInterval(() => {
            changeSlide(1);
        }, 5000);
        
        function changeSlide(direction) {
            slides[currentSlideIndex].classList.remove('active');
            dots[currentSlideIndex].classList.remove('active');
            
            currentSlideIndex += direction;
            
            if (currentSlideIndex >= slides.length) {
                currentSlideIndex = 0;
            } else if (currentSlideIndex < 0) {
                currentSlideIndex = slides.length - 1;
            }
            
            slides[currentSlideIndex].classList.add('active');
            dots[currentSlideIndex].classList.add('active');
        }
        
        function currentSlide(index) {
            slides[currentSlideIndex].classList.remove('active');
            dots[currentSlideIndex].classList.remove('active');
            
            currentSlideIndex = index;
            
            slides[currentSlideIndex].classList.add('active');
            dots[currentSlideIndex].classList.add('active');
        }
    </script>

    <?php include 'includes/cart-styles.php'; ?>
    <?php include 'includes/cart.php'; ?>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Help</h3>
                    <ul>
                        <li><a href="#">Customer Service</a></li>
                        <li><a href="#">Track Your Order</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Size Guide</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">Our Story</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Sustainability</a></li>
                        <li><a href="#">Gift Cards</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">Accessibility</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Newsletter</h3>
                    <p style="font-size: 13px; color: #666; margin-bottom: 15px;">
                        Subscribe to receive updates, access to exclusive deals, and more.
                    </p>
                    <div class="newsletter">
                        <input type="email" placeholder="Enter your email">
                        <button>Subscribe</button>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 Fashion Store. All rights reserved.</p>
                <div class="social-links">
                    <a href="#">Instagram</a>
                    <a href="#">Facebook</a>
                    <a href="#">Twitter</a>
                    <a href="#">Pinterest</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>