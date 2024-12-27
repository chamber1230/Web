<?php
session_start();
include('config.php');

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error_message = 'All fields are required.';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Passwords do not match.';
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the user into the database
        $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        try {
            $stmt->execute(['username' => $username, 'password' => $hashed_password]);
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $error_message = 'Username is already taken.';
        }
    }
}
?>

<?php include('header.php'); ?>

<div class="register-form">
    <h2>Register</h2>
    <?php if ($error_message): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit">Register</button>
    </form>
</div>

<?php include('footer.php'); ?>


<?php if (isset($_SESSION['user'])): ?>
    <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user']); ?>)</a></li>
<?php else: ?>
    <li><a href="login.php">Login</a></li>
<?php endif; ?>
