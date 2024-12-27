<?php
// Database connection
include('config.php');

$message = "";

// Handle Add Product
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

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

// Handle Update Product
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    $sql = "UPDATE product SET Pname = ?, Ptype = ?, Pprice = ?, Pquantity = ? WHERE Product_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdii', $product_name, $product_type, $product_price, $product_quantity, $product_id);

    if ($stmt->execute()) {
        $message = "Product updated successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
    $stmt->close();
}

// Handle Delete Product
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM product WHERE Product_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $product_id);

    if ($stmt->execute()) {
        $message = "Product deleted successfully!";
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
    <title>Product Management</title>
</head>
<body>
    <h1>Product Management</h1>
    <?php if ($message) echo "<p>$message</p>"; ?>

    <!-- Add Product Form -->
    <h2>Add Product</h2>
    <form method="POST" action="">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required><br><br>

        <label for="product_type">Product Type:</label>
        <input type="text" name="product_type" id="product_type" required><br><br>

        <label for="product_price">Product Price:</label>
        <input type="number" step="0.01" name="product_price" id="product_price" required><br><br>

        <label for="product_quantity">Product Quantity:</label>
        <input type="text" name="product_quantity" id="product_quantity" required><br><br>

        <button type="submit" name="add_product">Add Product</button>
    </form>

    <hr>

    <!-- Product Table -->
    <h2>Product List</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch products from the database
            $result = $conn->query("SELECT * FROM product");
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Product_ID']; ?></td>
                    <td><?php echo $row['Pname']; ?></td>
                    <td><?php echo $row['Ptype']; ?></td>
                    <td><?php echo $row['Pprice']; ?></td>
                    <td><?php echo $row['Pquantity']; ?></td>
                    <td>
                        <!-- Edit Form -->
                        <form method="POST" action="" style="display: inline-block;">
                            <input type="hidden" name="product_id" value="<?php echo $row['Product_ID']; ?>">
                            <input type="text" name="product_name" value="<?php echo $row['Pname']; ?>" required>
                            <input type="text" name="product_type" value="<?php echo $row['Ptype']; ?>" required>
                            <input type="number" step="0.01" name="product_price" value="<?php echo $row['Pprice']; ?>" required>
                            <input type="text" name="product_quantity" value="<?php echo $row['Pquantity']; ?>" required>
                            <button type="submit" name="update_product">Update</button>
                        </form>

                        <!-- Delete Form -->
                        <form method="POST" action="" style="display: inline-block;">
                            <input type="hidden" name="product_id" value="<?php echo $row['Product_ID']; ?>">
                            <button type="submit" name="delete_product">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
