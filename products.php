<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "rice_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add to cart functionality
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    
    // Check if the cart session exists, otherwise create an empty cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }

    // If not found, add the product to the cart with quantity 1
    if (!$found) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'quantity' => 1
        ];
    }

    // Redirect to cart page or display a message
    header('Location: cart.php');
    exit();
}

// Fetch products from the database
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<?php include('header.php'); ?>

<!-- Display Products -->
<div class="featured-products">
    <h2>Our Products</h2>
    <div class="product-grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="images/<?php echo $row['Pimage']; ?>" alt="<?php echo $row['Pname']; ?>" class="product-image">
                    <h3><?php echo $row['Pname']; ?></h3>
                    <p>Type: <?php echo $row['Ptype']; ?></p>
                    <p>Price: ₱<?php echo $row['Pprice']; ?></p>
                    <p>Available: <?php echo $row['Pquantity']; ?></p>
                    <form method="post" action="">
                        <input type="hidden" name="product_id" value="<?php echo $row['Product_ID']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $row['Pname']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['Pprice']; ?>">
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
    </div>
</div>

<?php include('footer.php'); ?>

<?php $conn->close(); ?>
