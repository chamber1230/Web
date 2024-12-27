<?php include('header.php'); ?>

<div class="contact-form">
    <h2>Contact Us</h2>
    <form action="contact.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit" name="submit">Send Message</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Here you can add code to handle form submission like sending an email or saving to a database
        echo "<p>Thank you for contacting us, $name!</p>";
    }
    ?>
</div>

<?php include('footer.php'); ?>
