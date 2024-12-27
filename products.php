<?php
// Start the session
session_start();

// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to handle adding to cart
function addToCart($product_id, $product_name, $product_price) {
    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Increase the quantity
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // Add product to cart
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }
}

// Check if the add to cart button was pressed
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Call the add to cart function
    addToCart($product_id, $product_name, $product_price);

    // Feedback message
    $message = "{$product_name} has been added to your cart.";
}
?>

<?php include('header.php'); ?>

<div class="products">
    <h2>Our Products</h2>

    <!-- Product 1: Basmati Rice -->
    <div class="product">
        <img src="images/basmatirice.jpg" alt="Basmati Rice">
        <h3>Basmati Rice</h3>
        <p>Price: 50.00 per kg</p>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="1">
            <input type="hidden" name="product_name" value="Basmati Rice">
            <input type="hidden" name="product_price" value="50.00">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 2: Jasmine Rice -->
    <div class="product">
        <img src="images/jasminerice.png" alt="Jasmine Rice">
        <h3>Jasmine Rice</h3>
        <p>Price: 50.00 per kg</p>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="2">
            <input type="hidden" name="product_name" value="Jasmine Rice">
            <input type="hidden" name="product_price" value="50.00">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 3: Arborio Rice -->
    <div class="product">
        <img src="images/arboriorice.jpg" alt="Arborio Rice">
        <h3>Arborio Rice</h3>
        <p>Price: 25.00 per kg</p>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="3">
            <input type="hidden" name="product_name" value="Arborio Rice">
            <input type="hidden" name="product_price" value="25.00">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 4: Sushi Rice -->
    <div class="product">
        <img src="images/sushirice.jpg" alt="Sushi Rice">
        <h3>Sushi Rice</h3>
        <p>Price: 50.00 per kg</p>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="4">
            <input type="hidden" name="product_name" value="Sushi Rice">
            <input type="hidden" name="product_price" value="50.00">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 5: Sinandomeng Rice -->
    <div class="product">
        <img src="images/sinandomengrice.jpg" alt="Sinandomeng Rice">
        <h3>Sinandomeng Rice</h3>
        <p>Price: 55.00 per kg</p>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="5">
            <input type="hidden" name="product_name" value="Sinandomeng Rice">
            <input type="hidden" name="product_price" value="55.00">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 6: Brown Rice -->
    <div class="product">
        <img src="images/brownrice.jpg" alt="Brown Rice">
        <h3>Brown Rice</h3>
        <p>Price: 50.00 per kg</p>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="6">
            <input type="hidden" name="product_name" value="Brown Rice">
            <input type="hidden" name="product_price" value="50.00">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 7: Wild Rice -->
    <div class="product">
        <img src="images/wildrice.jpg" alt="Wild Rice">
        <h3>Wild Rice</h3>
        <p>Price: 25.00 per kg</p>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="7">
            <input type="hidden" name="product_name" value="Wild Rice">
            <input type="hidden" name="product_price" value="25.00">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 8: White Rice -->
    <div class="product">
        <img src="images/whiterice.jpg" alt="White Rice">
        <h3>White Rice</h3>
        <p>Price: 50.00 per kg</p>
        <form method="post" action="">
            <input type="hidden" name="product_id" value="8">
            <input type="hidden" name="product_name" value="White Rice">
            <input type="hidden" name="product_price" value="50.00">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>

<?php
// Display the cart message if a product is added
if (isset($message)) {
    echo "<p class='cart-message'>{$message}</p>";
}
?>
