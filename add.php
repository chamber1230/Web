<?php
include('config/db.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form input
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    // Insert into the database
    $sql = "INSERT INTO product (Pname, Ptype, Pprice, Pquantity) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdi', $product_name, $product_type, $product_price, $product_quantity);

    if ($stmt->execute()) {
        $message = "Product added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add a New Product</h1>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form method="POST" action="">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required><br><br>

        <label for="product_type">Product Type:</label>
        <input type="text" name="product_type" id="product_type" required><br><br>

        <label for="product_price">Product Price:</label>
        <input type="number" step="0.01" name="product_price" id="product_price" required><br><br>

        <label for="product_quantity">Product Quantity:</label>
        <input type="text" name="product_quantity" id="product_quantity" required><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
