<?php
session_start();
include 'db_connect.php';

// Security check: Only admins can perform this action
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403); // Forbidden
    echo "Access denied.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_POST['client_id'];
    $action = $_POST['action']; // 'approve' or 'reject'

    if ($action === 'approve') {
        // Set nid_verified to TRUE
        $sql = "UPDATE clients SET nid_verified = TRUE WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $client_id);
    } elseif ($action === 'reject') {
        // For rejection, we clear the uploaded file paths so the user can re-upload.
        // We also keep nid_verified as FALSE.
        $sql = "UPDATE clients SET nid_front_url = NULL, nid_back_url = NULL WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $client_id);
    } else {
        // Invalid action
        header("Location: ../admin_dashboard.php?status=error");
        exit();
    }

    if ($stmt->execute()) {
        header("Location: ../admin_dashboard.php?status=success");
    } else {
        header("Location: ../admin_dashboard.php?status=error");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../admin_dashboard.php");
    exit();
}
?>