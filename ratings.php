<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $worker_id = trim($_POST['worker_id']);
    $rating = trim($_POST['rating']);
    $comment = trim($_POST['comment']);
    // In a real app, you would get the user_id from the session
    // $user_id = $_SESSION['id']; 

    if (!empty($worker_id) && !empty($rating)) {
        $sql = "INSERT INTO ratings (worker_id, rating, comment) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("iis", $worker_id, $rating, $comment);

            if ($stmt->execute()) {
                header("location: workers.php?status=success");
            } else {
                header("location: workers.php?status=error");
            }
            $stmt->close();
        }
    } else {
        header("location: workers.php?status=invalid");
    }
    $conn->close();
}
?>
