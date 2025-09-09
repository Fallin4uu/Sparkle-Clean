<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SparkleClean Services - Professional Cleaning You Can Trust</title>
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

  <main>
    <section class="hero" role="banner">
      <div class="container">
        <h2>Professional Cleaning to Make Your Space Shine</h2>
        <p>Reliable, eco-friendly, and thorough cleaning for homes and offices. Book your appointment today!</p>
        <a href="schedule.php" class="btn-primary" role="button">Book a Cleaning</a>
      </div>
    </section>

    <section id="services" class="container section">
      <h2 class="section-title">Our Cleaning Services</h2>
      <div class="grid-3">
        <?php
                    // Fetch the first 3 services from the database
                    $services_sql = "SELECT service_name, description, icon_url FROM services LIMIT 3";
                    $services_result = $conn->query($services_sql);

                    if ($services_result->num_rows > 0) {
                        while($service = $services_result->fetch_assoc()) {
                            echo '<article class="service-card">';
                            echo '    <img src="' . htmlspecialchars($service['icon_url']) . '" alt="" aria-hidden="true"/>';
                            echo '    <h3>' . htmlspecialchars($service['service_name']) . '</h3>';
                            echo '    <p>' . htmlspecialchars($service['description']) . '</p>';
                            echo '</article>';
                        }
                    } else {
                        echo "<p>No services found.</p>";
                    }
                ?>
      </div>
    </section>

    <section id="reviews" class="section reviews-section">
      <div class="container">
        <h2 class="section-title">What Our Clients Say</h2>
        <div class="review-list">
          <?php
                        // Fetch the 2 most recent reviews from the database
                        $reviews_sql = "SELECT r.rating, r.comment, c.full_name 
                                        FROM reviews r 
                                        JOIN clients c ON r.client_id = c.id 
                                        ORDER BY r.review_date DESC 
                                        LIMIT 2";
                        $reviews_result = $conn->query($reviews_sql);

                        if ($reviews_result->num_rows > 0) {
                            while($review = $reviews_result->fetch_assoc()) {
                                $rating_stars = str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']);
                                echo '<div class="review" role="article">';
                                echo '    <div class="star-rating">' . $rating_stars . '</div>';
                                echo '    <p>“' . htmlspecialchars($review['comment']) . '”</p>';
                                echo '    <div class="author">— ' . htmlspecialchars($review['full_name']) . '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "<p>No reviews yet. Be the first to leave one!</p>";
                        }
                    ?>
        </div>
      </div>
    </section>

    <section id="location" class="section">
      <div class="container">
        <h2 class="section-title">Our Location</h2>
        <div class="map-container">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.38133596168!2d90.27923740039014!3d23.78057325615782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1662718149830!5m2!1sen!2sbd"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </section>
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