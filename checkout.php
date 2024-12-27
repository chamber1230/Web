<?php
session_start();

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty. Please add products to the cart before proceeding.";
    exit;
}

// Check if the user is logged in (optional, if you have user authentication)
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to proceed with the checkout.";
    exit;
}

?>

<?php include('header.php'); ?>

<div class="checkout">
    <h2>Checkout</h2>
    <form action="process_checkout.php" method="POST">
        <h3>Billing Information</h3>
        <label for="billing_name">Name:</label>
        <input type="text" name="billing_name" id="billing_name" required><br>

        <label for="billing_address">Address:</label>
        <textarea name="billing_address" id="billing_address" required></textarea><br>

        <label for="billing_phone">Phone Number:</label>
        <input type="text" name="billing_phone" id="billing_phone" required><br>

        <h3>Payment Information</h3>
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bank_transfer">Bank Transfer</option>
        </select><br>

        <h3>Your Cart</h3>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
            $total_price = 0;
            foreach ($_SESSION['cart'] as $item) {
                $item_total = $item['product_price'] * $item['quantity'];
                $total_price += $item_total;
                echo "<tr>";
                echo "<td>{$item['product_name']}</td>";
                echo "<td>₱{$item['product_price']}</td>";
                echo "<td>{$item['quantity']}</td>";
                echo "<td>₱$item_total</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <h3>Total Price: ₱<?php echo $total_price; ?></h3>

        <button type="submit" name="place_order">Place Order</button>
    </form>
</div>

<?php include('footer.php'); ?>
