<?php
session_start();

// IMPORTANT: In a real-world application, you would fetch these from a secure 'admins' table in your database.
// For this example, we are hardcoding the credentials for simplicity.
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD_HASH', password_hash('admin123', PASSWORD_DEFAULT)); // Hashed password for "admin123"

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify username and password
    if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
        // Set session variables to mark the admin as logged in
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: ../admin_dashboard.php");
        exit();
    } else {
        // If login fails, redirect back with an error
        header("Location: ../admin_login.php?error=1");
        exit();
    }
} else {
    // If accessed directly, redirect to login
    header("Location: ../admin_login.php");
    exit();
}
?>