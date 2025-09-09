<?php
session_start();
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['client_id'])) {
    header("Location: ../login.php?error=loginrequired");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_SESSION['client_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    // Optional: add service_id if you want to link reviews to services
    // $service_id = $_POST['service_id'];

    $sql = "INSERT INTO reviews (client_id, rating, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $client_id, $rating, $comment);

    if ($stmt->execute()) {
        header("Location: ../reviews.php?status=success");
    } else {
        header("Location: ../reviews.php?status=error");
    }
    $stmt->close();
    $conn->close();
}
?>