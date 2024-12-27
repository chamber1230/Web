<?php
session_start();

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty!";
    exit;
}

// Retrieve form data
$billing_name = $_POST['billing_name'];
$billing_address = $_POST['billing_address'];
$billing_phone = $_POST['billing_phone'];
$payment_method = $_POST['payment_method'];

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['product_price'] * $item['quantity'];
}

// Database connection
$conn = new mysqli("localhost", "root", "", "rice_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save order details in the `customer` table
$sql = "INSERT INTO customer (customer_name, customer_address, customer_phone, payment_method, total_price)
        VALUES ('$billing_name', '$billing_address', '$billing_phone', '$payment_method', '$total_price')";

if ($conn->query($sql) === TRUE) {
    // Get the customer ID or order ID
    $customer_id = $conn->insert_id;

    // Save each product in the cart (Optional: You may need an `order_items` table)
    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $price = $item['product_price'];

        // Optionally, insert these into an order_items table (if you have one)
        $sql_item = "INSERT INTO order_items (customer_id, product_id, quantity, price)
                     VALUES ('$customer_id', '$product_id', '$quantity', '$price')";
        $conn->query($sql_item);
    }

    // Clear the cart after placing the order
    unset($_SESSION['cart']);

    echo "Order placed successfully! Your order ID is " . $customer_id;
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
