<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - 4T9 Fashion Store</title>
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

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #000 0%, #333 100%);
            color: #fff;
            padding: 120px 40px 80px;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 64px;
            font-weight: 900;
            letter-spacing: -3px;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 18px;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.9;
        }

        /* About Content */
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 40px;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            margin-bottom: 80px;
            align-items: center;
        }

        .about-text h2 {
            font-size: 36px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .about-text p {
            font-size: 16px;
            line-height: 1.8;
            color: #333;
            margin-bottom: 20px;
        }

        .about-image {
            background: #f5f5f5;
            padding: 60px;
            text-align: center;
            border-radius: 2px;
        }

        .profile-icon {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #000 0%, #333 100%);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -2px;
        }

        .profile-details {
            text-align: center;
        }

        .profile-details h3 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .profile-details p {
            font-size: 14px;
            color: #666;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Features Section */
        .features-section {
            background: #f9f9f9;
            padding: 80px 40px;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .features-title {
            text-align: center;
            font-size: 36px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .feature-card {
            background: #fff;
            padding: 40px;
            text-align: center;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .feature-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        /* Mission Section */
        .mission-section {
            padding: 80px 40px;
            background: #000;
            color: #fff;
        }

        .mission-container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .mission-container h2 {
            font-size: 42px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .mission-container p {
            font-size: 18px;
            line-height: 1.8;
            opacity: 0.9;
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 40px;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 36px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .cta-btn {
            display: inline-block;
            padding: 16px 48px;
            background: #000;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: background 0.3s;
        }

        .cta-btn:hover {
            background: #333;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 42px;
            }

            .about-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .mission-container h2 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/styles.php'; ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>4T9</h1>
        <p>Where Fashion Meets Innovation</p>
    </div>

    <!-- About Content -->
    <div class="about-container">
        <div class="about-grid">
            <div class="about-text">
                <h2>Welcome to 4T9</h2>
                <p>
                    4T9 is your premier destination for contemporary fashion, offering a curated selection of 
                    high-quality clothing and accessories for men, women, and everyone in between.
                </p>
                <p>
                    Founded with a passion for style and quality, we believe that fashion is more than just 
                    clothing—it's a form of self-expression. Our carefully selected collections combine 
                    timeless elegance with modern trends, ensuring you always look and feel your best.
                </p>
                <p>
                    From casual everyday wear to sophisticated evening attire, we offer pieces that complement 
                    your unique style and personality.
                </p>
            </div>

            <div class="about-image">
                <div class="profile-icon">PV</div>
                <div class="profile-details">
                    <h3>Pin Vatana</h3>
                    <p>Founder & Developer</p>
                    <p style="margin-top: 10px;">20 Years Old | College Student</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="features-container">
            <h2 class="features-title">Why Choose 4T9</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">✨</div>
                    <h3>Quality First</h3>
                    <p>We carefully curate our collections to ensure every piece meets our high standards of quality and craftsmanship.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🚚</div>
                    <h3>Fast Delivery</h3>
                    <p>Quick and reliable shipping to get your fashion favorites to you as soon as possible.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">💯</div>
                    <h3>Satisfaction Guaranteed</h3>
                    <p>Your happiness is our priority. We're committed to providing an exceptional shopping experience.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">👔</div>
                    <h3>Trendy Collections</h3>
                    <p>Stay ahead of the curve with our constantly updated selection of the latest fashion trends.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Great Prices</h3>
                    <p>Premium fashion at accessible prices. Style shouldn't break the bank.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Personal Style</h3>
                    <p>Find pieces that reflect your unique personality and help you express your individual style.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="mission-section">
        <div class="mission-container">
            <h2>Our Mission</h2>
            <p>
                At 4T9, our mission is to make fashion accessible, enjoyable, and sustainable. 
                We're committed to providing a seamless online shopping experience while offering 
                styles that empower you to express yourself confidently. As a student-led initiative, 
                we understand the importance of quality, affordability, and staying connected to what's trending.
            </p>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <h2>Ready to Elevate Your Style?</h2>
        <a href="index.php" class="cta-btn">Start Shopping</a>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/cart.php'; ?>
</body>
</html>
