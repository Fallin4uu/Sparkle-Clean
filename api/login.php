<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, full_name, password FROM clients WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $client = $result->fetch_assoc();
        if (password_verify($password, $client['password'])) {
            $_SESSION['client_id'] = $client['id'];
            $_SESSION['client_name'] = $client['full_name'];
            header("Location: ../schedule.php"); // Redirect to a user dashboard or schedule page
        } else {
            header("Location: ../login.php?error=invalid");
        }
    } else {
        header("Location: ../login.php?error=notfound");
    }
    $stmt->close();
    $conn->close();
}
?>