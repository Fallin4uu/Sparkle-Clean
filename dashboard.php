<?php
session_start();
// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit();
}
include 'api/db_connect.php';

// Fetch client data, including NID status
$client_id = $_SESSION['client_id'];
$client_sql = "SELECT * FROM clients WHERE id = ?";
$stmt = $conn->prepare($client_sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$client_result = $stmt->get_result();
$client = $client_result->fetch_assoc();

// Fetch client appointments
$appt_sql = "SELECT a.appointment_date, a.status, s.service_name FROM appointments a JOIN services s ON a.service_id = s.id WHERE a.client_id = ? ORDER BY a.appointment_date DESC";
$stmt = $conn->prepare($appt_sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$appointments_result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Client Dashboard - SparkleClean</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1><a href="home.php">SparkleClean</a></h1>
            <nav>
                <ul>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="api/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container section">
        <h1 class="page-title">Welcome, <?php echo htmlspecialchars($client['full_name']); ?>!</h1>

        <!-- NID Verification Section -->
        <div class="dashboard-card">
            <h2>Account Verification (NID)</h2>
            <?php if ($client['nid_verified']): ?>
                <p class="status-verified">✓ Your NID has been successfully verified.</p>
            <?php elseif (!empty($client['nid_front_url'])): ?>
                <p class="status-pending">Your NID has been submitted and is pending review.</p>
            <?php else: ?>
                <p>Please upload photos of your National ID (NID) card to verify your account and schedule services.</p>
                <form action="api/verify_nid.php" method="POST" enctype="multipart/form-data" class="nid-form">
                    <div class="input-group">
                        <label for="nid_front">NID Front Side</label>
                        <input type="file" id="nid_front" name="nid_front" required>
                    </div>
                    <div class="input-group">
                        <label for="nid_back">NID Back Side</label>
                        <input type="file" id="nid_back" name="nid_back" required>
                    </div>
                    <button type="submit" class="btn-primary">Upload for Verification</button>
                </form>
            <?php endif; ?>
        </div>

        <!-- Appointments Section -->
        <div class="dashboard-card">
            <h2>My Appointments</h2>
            <?php if ($appointments_result->num_rows > 0): ?>
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($appt = $appointments_result->fetch_assoc()): ?>
                            <tr>
                                <td data-label="Service"><?php echo htmlspecialchars($appt['service_name']); ?></td>
                                <td data-label="Date"><?php echo date("F j, Y, g:i a", strtotime($appt['appointment_date'])); ?>
                                </td>
                                <td data-label="Status"><span
                                        class="status-badge status-<?php echo strtolower($appt['status']); ?>"><?php echo htmlspecialchars($appt['status']); ?></span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have no scheduled appointments. <a href="schedule.php">Book a cleaning today!</a></p>
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