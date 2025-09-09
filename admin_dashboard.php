<?php
session_start();
// Security check: If admin is not logged in, redirect to login page.
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
include 'api/db_connect.php';

// Fetch all clients with pending NID verification
$sql = "SELECT id, full_name, nid_number, nid_front_url, nid_back_url FROM clients WHERE nid_verified = FALSE AND nid_front_url IS NOT NULL AND nid_back_url IS NOT NULL";
$pending_clients = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard - NID Verification</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1>SparkleClean - Admin Panel</h1>
            <nav>
                <ul>
                    <li><a href="api/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container section">
        <h1 class="page-title">Pending NID Verifications</h1>

        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<div class="alert alert-success">Client verification status updated successfully.</div>';
            } else {
                echo '<div class="alert alert-danger">An error occurred. Please try again.</div>';
            }
        }
        ?>

        <div class="admin-table-container">
            <?php if ($pending_clients->num_rows > 0): ?>
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>NID Number</th>
                            <th>NID Images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($client = $pending_clients->fetch_assoc()): ?>
                            <tr>
                                <td data-label="Client Name"><?php echo htmlspecialchars($client['full_name']); ?></td>
                                <td data-label="NID Number"><?php echo htmlspecialchars($client['nid_number']); ?></td>
                                <td data-label="NID Images">
                                    <a href="<?php echo htmlspecialchars($client['nid_front_url']); ?>" target="_blank"
                                        class="btn-secondary small-btn">View Front</a>
                                    <a href="<?php echo htmlspecialchars($client['nid_back_url']); ?>" target="_blank"
                                        class="btn-secondary small-btn">View Back</a>
                                </td>
                                <td data-label="Action">
                                    <form action="api/admin_verify_handler.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="client_id" value="<?php echo $client['id']; ?>">
                                        <button type="submit" name="action" value="approve"
                                            class="btn-success small-btn">Approve</button>
                                    </form>
                                    <form action="api/admin_verify_handler.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="client_id" value="<?php echo $client['id']; ?>">
                                        <button type="submit" name="action" value="reject"
                                            class="btn-danger small-btn">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>There are no pending NID verifications at this time.</p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>