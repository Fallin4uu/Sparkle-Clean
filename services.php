<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Services - SparkleClean</title>
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
          <li><a href="services.php" class="active">Services</a></li>
          <li><a href="reviews.php">Reviews</a></li>
          <li><a href="workers.php">Our Team</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="schedule.php" class="btn-nav">Schedule</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container section">
    <h1 class="page-title">Our Cleaning Services</h1>
    <div class="grid-3">
      <?php
                // Fetch all services from the database
                $sql = "SELECT service_name, description, icon_url FROM services";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($service = $result->fetch_assoc()) {
                        echo '<article class="service-card-full">';
                        echo '    <img src="' . htmlspecialchars($service['icon_url']) . '" alt="" aria-hidden="true"/>';
                        echo '    <h3>' . htmlspecialchars($service['service_name']) . '</h3>';
                        echo '    <p>' . htmlspecialchars($service['description']) . '</p>';
                        echo '    <a href="schedule.php" class="btn-secondary">Book Now</a>';
                        echo '</article>';
                    }
                } else {
                    echo "<p>No services are currently available.</p>";
                }
            ?>
    </div>
  </main>

  <footer class="main-footer">
    <div class="container">
      <p>&copy;
        <?php echo date("Y"); ?> SparkleClean Services. All rights reserved.
      </p>
    </div>
  </footer>
</body>

</html>