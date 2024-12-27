<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <title>Nonoy's Rice Store</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="header-container">
            <div class="header-title">
                <img src="images/logo.png" alt="Rice Store Logo" class="logo">
                <h1>Nonoy's Rice Store</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="cart.php">Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user']); ?>)</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>
