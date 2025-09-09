<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone_number = trim($_POST['phone_number']);
    $nid_number = trim($_POST['nid_number']); // New NID field

    // Basic validation
    if (empty($full_name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($_POST['password']) || empty($nid_number)) {
        header("Location: ../registration.php?status=validation_error");
        exit();
    }

    $sql = "INSERT INTO clients (full_name, email, password, phone_number, nid_number) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $full_name, $email, $password, $phone_number, $nid_number);

    if ($stmt->execute()) {
        header("Location: ../login.php?status=registered_successfully");
    } else {
        // Handle potential duplicate email error
        header("Location: ../registration.php?status=email_exists");
    }
    $stmt->close();
    $conn->close();
}
?>