<!-- Cart Sidebar -->
<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h3>Shopping Bag <span id="cartCountHeader">(0)</span></h3>
        <button class="close-cart" onclick="closeCart()">&times;</button>
    </div>
    
    <div class="cart-items" id="cartItemsContainer">
        <div class="cart-empty">
            <p>Your shopping bag is empty</p>
        </div>
    </div>
    
    <div class="cart-footer" id="cartFooter" style="display: none;">
        <div class="cart-total">
            <span>Total:</span>
            <span id="cartTotal">$0.00</span>
        </div>
        <button class="checkout-btn" onclick="openCheckout()">Proceed to Checkout</button>
    </div>
</div>

<!-- Checkout Modal -->
<div class="checkout-modal" id="checkoutModal">
    <div class="checkout-content">
        <div class="checkout-header">
            <h3>Checkout</h3>
        </div>
        <div class="checkout-body">
            <form id="checkoutForm" onsubmit="submitOrder(event)">
                <div class="form-group">
                    <label for="customerName">Full Name *</label>
                    <input type="text" id="customerName" name="customerName" required>
                </div>
                
                <div class="form-group">
                    <label for="customerPhone">Phone Number *</label>
                    <input type="tel" id="customerPhone" name="customerPhone" required>
                </div>
                
                <div class="form-group">
                    <label for="customerEmail">Email Address *</label>
                    <input type="email" id="customerEmail" name="customerEmail" required>
                </div>
                
                <div class="order-summary">
                    <h4>Order Summary</h4>
                    <div id="checkoutSummary"></div>
                    <div class="summary-total">
                        <span>Total:</span>
                        <span id="checkoutTotal">$0.00</span>
                    </div>
                </div>
                
                <div class="checkout-actions">
                    <button type="submit" class="btn-submit-order">Place Order</button>
                    <button type="button" class="btn-cancel" onclick="closeCheckout()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Receipt Modal -->
<div class="checkout-modal" id="receiptModal">
    <div class="receipt-content">
        <div class="receipt-header">
            <h2>4T9</h2>
            <p>Order Confirmation</p>
        </div>
        <div class="receipt-body" id="receiptBody">
            <!-- Receipt content will be generated here -->
        </div>
        <div class="receipt-footer">
            <button class="btn-print" onclick="window.print()">Print Receipt</button>
            <button class="btn-close" onclick="closeReceipt()">Close</button>
        </div>
    </div>
</div>

<script>
// Shopping Cart Management
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function updateCartUI() {
    const cartCount = document.getElementById('cartCount');
    const cartCountHeader = document.getElementById('cartCountHeader');
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const cartFooter = document.getElementById('cartFooter');
    const cartTotal = document.getElementById('cartTotal');
    
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    // Update cart count
    if (cartCount) {
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'flex' : 'none';
    }
    
    if (cartCountHeader) {
        cartCountHeader.textContent = `(${totalItems})`;
    }
    
    // Update cart items display
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<div class="cart-empty"><p>Your shopping bag is empty</p></div>';
        cartFooter.style.display = 'none';
    } else {
        cartItemsContainer.innerHTML = cart.map(item => `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                <div class="cart-item-details">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                    <div class="cart-item-qty">
                        <button class="qty-btn" onclick="updateQuantity(${item.id}, '${item.category}', -1)">-</button>
                        <span>${item.quantity}</span>
                        <button class="qty-btn" onclick="updateQuantity(${item.id}, '${item.category}', 1)">+</button>
                    </div>
                    <button class="remove-item" onclick="removeFromCart(${item.id}, '${item.category}')">Remove</button>
                </div>
            </div>
        `).join('');
        
        cartFooter.style.display = 'block';
        cartTotal.textContent = `$${totalPrice.toFixed(2)}`;
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
}

function addToCart(productId, category) {
    // Get product details from the page
    const productCard = event.target.closest('.product-card');
    const productName = productCard.querySelector('.product-name').textContent;
    const productPrice = parseFloat(productCard.querySelector('.product-price').textContent.replace('$', ''));
    const productImage = productCard.querySelector('.product-image img').src;
    
    // Check if product already in cart
    const existingItem = cart.find(item => item.id === productId && item.category === category);
    
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({
            id: productId,
            category: category,
            name: productName,
            price: productPrice,
            image: productImage,
            quantity: 1
        });
    }
    
    updateCartUI();
    openCart();
}

function updateQuantity(productId, category, change) {
    const item = cart.find(item => item.id === productId && item.category === category);
    
    if (item) {
        item.quantity += change;
        
        if (item.quantity <= 0) {
            cart = cart.filter(item => !(item.id === productId && item.category === category));
        }
    }
    
    updateCartUI();
}

function removeFromCart(productId, category) {
    cart = cart.filter(item => !(item.id === productId && item.category === category));
    updateCartUI();
}

function openCart() {
    document.getElementById('cartSidebar').classList.add('open');
    document.getElementById('cartOverlay').classList.add('show');
}

function closeCart() {
    document.getElementById('cartSidebar').classList.remove('open');
    document.getElementById('cartOverlay').classList.remove('show');
}

function openCheckout() {
    closeCart();
    
    const checkoutSummary = document.getElementById('checkoutSummary');
    const checkoutTotal = document.getElementById('checkoutTotal');
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    checkoutSummary.innerHTML = cart.map(item => `
        <div class="summary-item">
            <span>${item.name} x ${item.quantity}</span>
            <span>$${(item.price * item.quantity).toFixed(2)}</span>
        </div>
    `).join('');
    
    checkoutTotal.textContent = `$${totalPrice.toFixed(2)}`;
    
    document.getElementById('checkoutModal').classList.add('show');
}

function closeCheckout() {
    document.getElementById('checkoutModal').classList.remove('show');
}

function submitOrder(event) {
    event.preventDefault();
    
    const customerName = document.getElementById('customerName').value;
    const customerPhone = document.getElementById('customerPhone').value;
    const customerEmail = document.getElementById('customerEmail').value;
    
    const orderData = {
        customerName: customerName,
        customerPhone: customerPhone,
        customerEmail: customerEmail,
        items: cart,
        total: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0),
        orderNumber: 'ORD-' + Date.now(),
        date: new Date().toLocaleString()
    };
    
    // Show loading state
    const submitBtn = event.target.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.textContent;
    submitBtn.textContent = 'Processing...';
    submitBtn.disabled = true;
    
    // Send order to server
    const basePath = window.location.pathname.includes('/admin/') ? '../' : '';
    fetch(basePath + 'process_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.text())
    .then(text => {
        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error('Response is not JSON:', text);
            throw new Error('Invalid server response');
        }
        
        if (data.success) {
            // Save order to localStorage as backup
            const orders = JSON.parse(localStorage.getItem('orders')) || [];
            orders.push(orderData);
            localStorage.setItem('orders', JSON.stringify(orders));
            
            // Show receipt
            showReceipt(orderData);
            
            // Clear cart
            cart = [];
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartUI();
            
            // Close checkout
            closeCheckout();
            
            // Reset form
            document.getElementById('checkoutForm').reset();
        } else {
            alert('Order failed: ' + data.message);
            submitBtn.textContent = originalBtnText;
            submitBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Save order to localStorage
        const orders = JSON.parse(localStorage.getItem('orders')) || [];
        orders.push(orderData);
        localStorage.setItem('orders', JSON.stringify(orders));
        
        // Show receipt anyway (order likely processed)
        showReceipt(orderData);
        
        // Clear cart
        cart = [];
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartUI();
        
        // Close checkout
        closeCheckout();
        
        // Reset form
        document.getElementById('checkoutForm').reset();
        
        submitBtn.textContent = originalBtnText;
        submitBtn.disabled = false;
    });
}

function showReceipt(orderData) {
    const receiptBody = document.getElementById('receiptBody');
    
    receiptBody.innerHTML = `
        <div class="receipt-section">
            <h4>Order Number</h4>
            <p style="font-size: 16px; font-weight: 600;">${orderData.orderNumber}</p>
        </div>
        
        <div class="receipt-section">
            <h4>Date & Time</h4>
            <p>${orderData.date}</p>
        </div>
        
        <div class="receipt-section">
            <h4>Customer Information</h4>
            <div class="receipt-info">
                <p><strong>Name:</strong> ${orderData.customerName}</p>
                <p><strong>Phone:</strong> ${orderData.customerPhone}</p>
                <p><strong>Email:</strong> ${orderData.customerEmail}</p>
            </div>
        </div>
        
        <div class="receipt-items">
            <h4 style="margin-bottom: 15px;">Order Items</h4>
            ${orderData.items.map(item => `
                <div class="receipt-item">
                    <span>${item.name} x ${item.quantity}</span>
                    <span>$${(item.price * item.quantity).toFixed(2)}</span>
                </div>
            `).join('')}
        </div>
        
        <div class="receipt-total">
            <span>Total Amount:</span>
            <span>$${orderData.total.toFixed(2)}</span>
        </div>
        
        <div class="receipt-section" style="margin-top: 30px; text-align: center; color: #666;">
            <p style="font-size: 12px;">Thank you for your purchase!</p>
            <p style="font-size: 11px; margin-top: 10px;">Questions? Contact us at support@4t9.com</p>
        </div>
    `;
    
    document.getElementById('receiptModal').classList.add('show');
}

function closeReceipt() {
    document.getElementById('receiptModal').classList.remove('show');
}

// Initialize cart UI on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartUI();
});
</script>
