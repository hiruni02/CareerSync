<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/contact.css">
    <title>Contact us</title>
</head>

<body>
    <?php
    include("components/navbar.php");
    ?>
    <div class='page-content'>
        <div class="contact-container">
            <h2>Contact Us</h2>
            <p>If you have any questions, suggestions, or need support, feel free to reach out to us using the form below.</p>

            <form method="POST" class="contact-form">
                <input type="hidden" name="action" value="sending_feedback">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</body>

</html>