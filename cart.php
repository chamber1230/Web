<?php
session_start();

// Handle removing items from the cart
if (isset($_POST['remove_item'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
}

// Clear the cart
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
}

include('header.php');
?>

<div class="cart">
    <h2>Your Cart</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty!</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                            <button type="submit" name="remove_item">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total: $<?php echo number_format($total, 2); ?></p>
        <form method="post" action="">
            <button type="submit" name="clear_cart">Clear Cart</button>
        </form>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>
