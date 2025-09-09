<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Our Fees - SparkleClean</title>
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
          <li><a href="workers.php">Our Team</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="schedule.php" class="btn-nav">Schedule</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container section">
    <h1 class="page-title">Our Pricing</h1>
    <p class="page-subtitle">Transparent pricing for our professional cleaning services. Custom quotes are available for
      large commercial spaces.</p>
    <table class="fees-table">
      <thead>
        <tr>
          <th>Service</th>
          <th>Description</th>
          <th>Starting Fee</th>
        </tr>
      </thead>
      <tbody>
        <?php
                    $result = $conn->query("SELECT service_name, description, base_fee FROM services ORDER BY base_fee");
                    while($service = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-label='Service'><strong>" . htmlspecialchars($service['service_name']) . "</strong></td>";
                        echo "<td data-label='Description'>" . htmlspecialchars($service['description']) . "</td>";
                        echo "<td data-label='Starting Fee'>৳" . number_format($service['base_fee'], 2) . "</td>";
                        echo "</tr>";
                    }
                ?>
      </tbody>
    </table>
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