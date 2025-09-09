<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Our Team - SparkleClean</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
    <?php include 'api/db_connect.php'; ?>
    <header class="main-header">
        <div class="container">
            <h1><a href="home.php">SparkleClean</a></h1>
            <nav>
                <ul>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="reviews.php">Reviews</a></li>
                    <li><a href="workers.php" class="active">Our Team</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="schedule.php" class="btn-nav">Schedule</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container section">
        <h1 class="page-title">Meet Our Professional Team</h1>
        <div class="grid-3">
            <?php
            // Fetch all active workers from the database
            $sql = "SELECT full_name, specialty, bio, photo_url FROM workers WHERE is_active = TRUE";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($worker = $result->fetch_assoc()) {
                    echo '<div class="worker-card">';
                    echo '    <img src="' . htmlspecialchars($worker['photo_url']) . '" alt="Photo of ' . htmlspecialchars($worker['full_name']) . '">';
                    echo '    <h3>' . htmlspecialchars($worker['full_name']) . '</h3>';
                    echo '    <h4>' . htmlspecialchars($worker['specialty']) . '</h4>';
                    echo '    <p>' . htmlspecialchars($worker['bio']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p>Our team information is currently being updated.</p>";
            }
            ?>
        </div>
    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> SparkleClean Services. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>