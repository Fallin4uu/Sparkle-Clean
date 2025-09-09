<?php
// Start the session on every page that includes this header
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="main-header">
    <div class="container">
        <h1><a href="home.php">SparkleClean</a></h1>
        <nav>
            <ul>
                <li><a href="services.php">Services</a></li>
                <li><a href="reviews.php">Reviews</a></li>
                <li><a href="workers.php">Our Team</a></li>
                <li><a href="contact.php">Contact</a></li>
                
                <?php if (isset($_SESSION['client_id'])): ?>
                    <!-- Links for logged-in users -->
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="api/logout.php" class="btn-nav">Logout</a></li>
                <?php else: ?>
                    <!-- Links for guests -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="registration.php" class="btn-nav">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
