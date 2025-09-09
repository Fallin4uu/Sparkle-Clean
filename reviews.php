<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Client Reviews - SparkleClean</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
  <?php session_start(); include 'api/db_connect.php'; ?>
  <header class="main-header">
    <div class="container">
      <h1><a href="home.php">SparkleClean</a></h1>
      <nav>
        <ul>
          <li><a href="services.php">Services</a></li>
          <li><a href="reviews.php" class="active">Reviews</a></li>
          <li><a href="workers.php">Our Team</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="schedule.php" class="btn-nav">Schedule</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container section">
    <h1 class="page-title">What Our Clients Say</h1>
    <div class="review-list-full">
      <?php
                // Fetch all reviews from the database
                $sql = "SELECT r.rating, r.comment, c.full_name FROM reviews r JOIN clients c ON r.client_id = c.id ORDER BY r.review_date DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($review = $result->fetch_assoc()) {
                        $rating_stars = str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']);
                        echo '<div class="review-full">';
                        echo '    <div class="star-rating">' . $rating_stars . '</div>';
                        echo '    <p>“' . htmlspecialchars($review['comment']) . '”</p>';
                        echo '    <div class="author">— ' . htmlspecialchars($review['full_name']) . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No reviews have been submitted yet.</p>";
                }
             ?>
    </div>

    <div class="review-form-container">
      <h2>Leave a Review</h2>
      <?php if (isset($_SESSION['client_id'])): ?>
      <form action="api/submit_review.php" method="POST">
        <div class="input-group">
          <label for="rating">Your Rating</label>
          <select id="rating" name="rating" required>
            <option value="5">★★★★★ (Excellent)</option>
            <option value="4">★★★★☆ (Great)</option>
            <option value="3">★★★☆☆ (Good)</option>
            <option value="2">★★☆☆☆ (Fair)</option>
            <option value="1">★☆☆☆☆ (Poor)</option>
          </select>
        </div>
        <div class="input-group">
          <label for="comment">Your Feedback</label>
          <textarea id="comment" name="comment" rows="5" required
            placeholder="Tell us about your experience..."></textarea>
        </div>
        <button type="submit" class="btn-primary">Submit Review</button>
      </form>
      <?php else: ?>
      <p>You must be <a href="login.php">logged in</a> to leave a review.</p>
      <?php endif; ?>
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