<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: http://localhost/website.php");
    exit();
}

// Check if the request method is POST and if the file was uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qr_attendance_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user ID from the session
    $userID = $_SESSION['user_id'];

    // Define target directory and file name
    $targetDir = "profile_pictures/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        // Update user's profile picture path in the database
        $updateSql = "UPDATE tbl_student SET profile_picture = '$targetFile' WHERE tbl_student_id = '$userID'";
        if ($conn->query($updateSql) === TRUE) {
            // Redirect the user back to their profile page with the updated profile picture
            header("Location: http://localhost/qr-code-attendance-system/profile.php");
            exit();
        } else {
            $_SESSION['upload_error'] = "Error updating profile picture: " . $conn->error;
        }
    } else {
        $_SESSION['upload_error'] = "Sorry, there was an error uploading your file.";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request method is not POST or file was not uploaded, redirect to the profile page
    header("Location: http://localhost/qr-code-attendance-system/profile.php");
    exit();
}
?>
