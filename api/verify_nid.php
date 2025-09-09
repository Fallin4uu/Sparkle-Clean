<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['client_id'])) {
    header("Location: ../login.php?error=loginrequired");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_SESSION['client_id'];

    $target_dir = "../uploads/nid/";

    // Function to handle file upload
    function uploadFile($file_input_name, $client_id, $file_type)
    {
        global $target_dir;
        $target_file = $target_dir . basename($_FILES[$file_input_name]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Generate a unique filename
        $new_filename = $client_id . "_" . $file_type . "_" . time() . "." . $imageFileType;
        $final_path = $target_dir . $new_filename;

        // Check if image file is a actual image or fake image
        if (!getimagesize($_FILES[$file_input_name]["tmp_name"])) {
            return ["success" => false, "error" => "File is not an image."];
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return ["success" => false, "error" => "Sorry, only JPG, JPEG, & PNG files are allowed."];
        }

        if (move_uploaded_file($_FILES[$file_input_name]["tmp_name"], $final_path)) {
            // Return the relative path to store in DB
            return ["success" => true, "path" => "uploads/nid/" . $new_filename];
        } else {
            return ["success" => false, "error" => "Sorry, there was an error uploading your file."];
        }
    }

    $front_upload = uploadFile("nid_front", $client_id, "front");
    $back_upload = uploadFile("nid_back", $client_id, "back");

    if ($front_upload["success"] && $back_upload["success"]) {
        $nid_front_url = $front_upload["path"];
        $nid_back_url = $back_upload["path"];

        $sql = "UPDATE clients SET nid_front_url = ?, nid_back_url = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nid_front_url, $nid_back_url, $client_id);

        if ($stmt->execute()) {
            header("Location: ../dashboard.php?status=nid_success");
        } else {
            header("Location: ../dashboard.php?status=db_error");
        }
        $stmt->close();
    } else {
        // Handle upload error
        $error = $front_upload["error"] ?? $back_upload["error"];
        header("Location: ../dashboard.php?status=upload_error&msg=" . urlencode($error));
    }
    $conn->close();
}
?>