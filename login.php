<?php
session_start();
include('config.php');

// Initialize error message
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        $error_message = 'Both fields are required.';
    } else {
        try {
            // Check if the user exists
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->execute(['username' => htmlspecialchars($username)]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Regenerate session ID to prevent session fixation attacks
                session_regenerate_id(true);
                // Set session and redirect to homepage
                $_SESSION['user'] = $user['username']; // Storing username from DB for consistency
                header('Location: index.php');
                exit;
            } else {
                $error_message = 'Invalid username or password.';
            }
        } catch (Exception $e) {
            // Log the exception and show a generic error message
            error_log($e->getMessage());
            $error_message = 'An error occurred. Please try again later.';
        }
    }
}
?>

<?php include('header.php'); ?>

<div class="login-form">
    <h2>Login</h2>
    <?php if ($error_message): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
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
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</div>


