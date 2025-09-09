<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Basic server-side validation
    if (!empty($full_name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        $sql = "INSERT INTO contact_messages (full_name, email, message) VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $full_name, $email, $message);

        if ($stmt->execute()) {
            // Success
            header("Location: ../contact.php?status=success");
        } else {
            // Database error
            header("Location: ../contact.php?status=error");
        }
        $stmt->close();
    } else {
        // Validation failed
        header("Location: ../contact.php?status=validation_error");
    }
    $conn->close();
}
?>
