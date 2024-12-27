<?php
session_start();

// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart logic
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }

    // Feedback message
    $message = "{$product_name} has been added to your cart.";
}
?>

<?php include('header.php'); ?>

<div class="hero">
    <h1>Welcome to Nonoy's Rice Store</h1>
    <p>Your one-stop shop for premium rice varieties from around the world.</p>
    <a href="products.php" class="cta-button">Shop Now</a>
</div>

<?php if (isset($message)): ?>
    <p class="message"><?php echo $message; ?></p>
<?php endif; ?>

<div class="featured-products">
    <h2>Featured Products</h2>
    <div class="product-grid">
        <!-- Featured Product 1 -->
        <div class="product-card">
            <img src="images/basmatirice.jpg" alt="Basmati Rice">
            <h3>Basmati Rice</h3>
            <p>₱50.00 per kg</p>
        </div>

        <!-- Featured Product 2 -->
        <div class="product-card">
            <img src="images/jasminerice.png" alt="Jasmine Rice">
            <h3>Jasmine Rice</h3>
            <p>₱50.00 per kg</p>
        </div>

        <!-- Featured Product 3 -->
        <div class="product-card">
            <img src="images/arboriorice.jpg" alt="Arborio Rice">
            <h3>Arborio Rice</h3>
            <p>₱50.00 per kg</p>
        </div>

        <!-- New Products -->
        <!-- Sushi Rice -->
        <div class="product-card">
            <img src="images/sushirice.jpg" alt="Sushi Rice">
            <h3>Sushi Rice</h3>
            <p>₱50.00 per kg</p>
        </div>

        <!-- Sinandomeng Rice -->
        <div class="product-card">
            <img src="images/sinandomengrice.jpg" alt="Sinandomeng Rice">
            <h3>Sinandomeng Rice</h3>
            <p>₱55.00 per kg</p>
        </div>

        <!-- Brown Rice -->
        <div class="product-card">
            <img src="images/brownrice.jpg" alt="Brown Rice">
            <h3>Brown Rice</h3>
            <p>₱50.00 per kg</p>
        </div>

        <!-- Wild Rice -->
        <div class="product-card">
            <img src="images/wildrice.jpg" alt="Wild Rice">
            <h3>Wild Rice</h3>
            <p>₱25.00 per kg</p>
        </div>

        <!-- White Rice -->
        <div class="product-card">
            <img src="images/whiterice.jpg" alt="White Rice">
            <h3>White Rice</h3>
            <p>₱50.00 per kg</p>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
