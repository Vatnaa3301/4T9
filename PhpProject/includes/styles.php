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
        padding: 20px 0;
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

    /* Product Grid */
    .products-section {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 60px 0 40px 0;
        border-bottom: 1px solid #e5e5e5;
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 300;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    .filter-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .filter-label {
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #666;
    }

    .filter-dropdown {
        padding: 8px 16px;
        border: 1px solid #e5e5e5;
        background: #fff;
        font-size: 11px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        cursor: pointer;
        outline: none;
        transition: border-color 0.3s;
        font-family: inherit;
    }

    .filter-dropdown:hover,
    .filter-dropdown:focus {
        border-color: #000;
    }

    .page-header {
        text-align: center;
        padding: 40px 0;
        border-bottom: 1px solid #e5e5e5;
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 300;
        letter-spacing: 4px;
        text-transform: uppercase;
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
        .products-section {
            padding: 0 20px;
        }

        .nav-links {
            gap: 15px;
        }

        .nav-links a {
            font-size: 11px;
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

    /* Shopping Cart Styles */
    .cart-icon {
        position: relative;
        cursor: pointer;
    }

    .cart-count {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #000;
        color: #fff;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>
<?php include 'cart-styles.php'; ?>
