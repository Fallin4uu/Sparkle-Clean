<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us - SparkleClean</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container section">
        <h1 class="page-title">Get in Touch</h1>

        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<div class="alert alert-success">Thank you for your message! We will get back to you shortly.</div>';
            } else {
                echo '<div class="alert alert-danger">There was an error sending your message. Please try again.</div>';
            }
        }
        ?>

        <div class="contact-layout">
            <div class="contact-info">
                <h3>Contact Information</h3>
                <p>Have a question or need a custom quote? We're here to help!</p>
                <ul>
                    <li><strong>Email:</strong> contact@sparkleclean.com</li>
                    <li><strong>Phone:</strong> +880 1234-567890</li>
                    <li><strong>Address:</strong> 123 Gulshan Avenue, Dhaka, Bangladesh</li>
                    <li><strong>Hours:</strong> Sun - Thu, 9:00 AM - 6:00 PM</li>
                </ul>
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.38133596168!2d90.27923740039014!3d23.78057325615782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1662718149830!5m2!1sen!2sbd"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <div class="contact-form-container">
                <h3>Send Us a Message</h3>
                <form action="api/contact_handler.php" method="POST">
                    <div class="input-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> SparkleClean Services. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>