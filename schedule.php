<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Schedule a Cleaning - SparkleClean</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
  <?php session_start();
  include 'api/db_connect.php'; ?>
  <header class="main-header">
    <div class="container">
      <h1><a href="home.php">SparkleClean</a></h1>
      <nav>
        <ul>
          <li><a href="services.php">Services</a></li>
          <li><a href="reviews.php">Reviews</a></li>
          <li><a href="workers.php">Our Team</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="schedule.php" class="btn-nav active">Schedule</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container section">
    <h1 class="page-title">Book Your Cleaning Appointment</h1>
    <div class="form-container">
      <?php if (isset($_SESSION['client_id'])): ?>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['client_name']); ?>! Fill out the form below to request an
          appointment. We will contact you to confirm.</p>
        <form action="api/schedule_appointment.php" method="POST">
          <div class="input-group">
            <label for="service">Select Service</label>
            <select id="service" name="service_id" required>
              <option value="">-- Choose a service --</option>
              <?php
              $result = $conn->query("SELECT id, service_name FROM services ORDER BY service_name");
              while ($service = $result->fetch_assoc()) {
                echo "<option value='{$service['id']}'>{$service['service_name']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="input-group">
            <label for="date">Preferred Date & Time</label>
            <input type="datetime-local" id="date" name="appointment_date" required>
          </div>
          <div class="input-group">
            <label for="address">Cleaning Address</label>
            <textarea id="address" name="address" rows="3" required
              placeholder="Enter the full address for the cleaning service..."></textarea>
          </div>
          <div class="input-group">
            <label for="notes">Additional Notes</label>
            <textarea id="notes" name="notes" rows="4"
              placeholder="Any special instructions? (e.g., pets in the home, specific areas to focus on)"></textarea>
          </div>
          <button type="submit" class="btn-primary">Request Appointment</button>
        </form>
      <?php else: ?>
        <p>You must be <a href="login.php">logged in</a> to schedule a cleaning service. Please log in or <a
            href="registration.php">create an account</a>.</p>
      <?php endif; ?>
    </div>
  </main>

  <footer class="main-footer">
    <div class="container">
      <p>&copy; <?php echo date("Y"); ?> SparkleClean Services. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>