<style>
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

.cart-sidebar {
    position: fixed;
    right: -400px;
    top: 0;
    width: 400px;
    height: 100vh;
    background: #fff;
    box-shadow: -2px 0 10px rgba(0,0,0,0.1);
    transition: right 0.3s ease;
    z-index: 2000;
    overflow-y: auto;
}

.cart-sidebar.open {
    right: 0;
}

.cart-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1999;
    display: none;
}

.cart-overlay.show {
    display: block;
}

.cart-header {
    padding: 20px;
    border-bottom: 1px solid #e5e5e5;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-header h3 {
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.close-cart {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #666;
}

.cart-items {
    padding: 20px;
}

.cart-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e5e5e5;
}

.cart-item-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    background: #f5f5f5;
}

.cart-item-details {
    flex: 1;
}

.cart-item-name {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
}

.cart-item-price {
    font-size: 14px;
    font-weight: 600;
    color: #000;
    margin-bottom: 10px;
}

.cart-item-qty {
    display: flex;
    align-items: center;
    gap: 10px;
}

.qty-btn {
    width: 25px;
    height: 25px;
    border: 1px solid #000;
    background: #fff;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:hover {
    background: #000;
    color: #fff;
}

.remove-item {
    background: none;
    border: none;
    color: #f44336;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    margin-top: 10px;
}

.remove-item:hover {
    text-decoration: underline;
}

.cart-empty {
    text-align: center;
    padding: 40px 20px;
    color: #666;
}

.cart-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    border-top: 1px solid #e5e5e5;
    padding: 20px;
}

.cart-total {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.checkout-btn {
    width: 100%;
    padding: 14px;
    background: #000;
    color: #fff;
    border: none;
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    transition: background 0.3s;
}

.checkout-btn:hover {
    background: #333;
}

/* Checkout Modal */
.checkout-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 3000;
}

.checkout-modal.show {
    display: flex;
}

.checkout-content {
    background: #fff;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    border-radius: 2px;
}

.checkout-header {
    padding: 20px;
    border-bottom: 1px solid #e5e5e5;
}

.checkout-header h3 {
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.checkout-body {
    padding: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 8px;
    color: #333;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #e5e5e5;
    font-size: 14px;
    outline: none;
}

.form-group input:focus {
    border-color: #000;
}

.order-summary {
    background: #f8f8f8;
    padding: 15px;
    margin-bottom: 20px;
}

.order-summary h4 {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    margin-bottom: 5px;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    font-size: 16px;
    font-weight: 600;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid #ddd;
}

.checkout-actions {
    display: flex;
    gap: 10px;
}

.btn-submit-order {
    flex: 1;
    padding: 14px;
    background: #000;
    color: #fff;
    border: none;
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
}

.btn-submit-order:hover {
    background: #333;
}

.btn-cancel {
    flex: 1;
    padding: 14px;
    background: #fff;
    color: #000;
    border: 1px solid #000;
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
}

.btn-cancel:hover {
    background: #f5f5f5;
}

/* Receipt Modal */
.receipt-content {
    background: #fff;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
}

.receipt-header {
    background: #000;
    color: #fff;
    padding: 30px 20px;
    text-align: center;
}

.receipt-header h2 {
    font-size: 28px;
    font-weight: 900;
    letter-spacing: -2px;
    margin-bottom: 10px;
}

.receipt-header p {
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.receipt-body {
    padding: 30px 20px;
}

.receipt-section {
    margin-bottom: 25px;
}

.receipt-section h4 {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    color: #666;
}

.receipt-info p {
    font-size: 13px;
    margin-bottom: 5px;
}

.receipt-items {
    border-top: 1px solid #e5e5e5;
    border-bottom: 1px solid #e5e5e5;
    padding: 15px 0;
    margin: 20px 0;
}

.receipt-item {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    margin-bottom: 10px;
}

.receipt-total {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    font-weight: 600;
    margin-top: 15px;
}

.receipt-footer {
    text-align: center;
    padding: 20px;
    border-top: 1px solid #e5e5e5;
}

.btn-print {
    padding: 12px 30px;
    background: #000;
    color: #fff;
    border: none;
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    margin-right: 10px;
}

.btn-print:hover {
    background: #333;
}

.btn-close {
    padding: 12px 30px;
    background: #fff;
    color: #000;
    border: 1px solid #000;
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
}

.btn-close:hover {
    background: #f5f5f5;
}

@media print {
    body * {
        visibility: hidden;
    }
    .receipt-content, .receipt-content * {
        visibility: visible;
    }
    .receipt-content {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .receipt-footer {
        display: none;
    }
}
</style>
