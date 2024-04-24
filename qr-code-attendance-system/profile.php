<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: http://localhost/website.php");
    exit();
}

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

// Fetch user information from the session
$userEmail = $_SESSION['user_id'];

// SQL query to fetch user details from tbl_student
$sql = "SELECT s.* FROM tbl_users u
        INNER JOIN tbl_student s ON u.tbl_student_id = s.tbl_student_id
        WHERE u.email = '$userEmail'"; // Adjust this query based on your table structure

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    // Fetch user details
    $row = $result->fetch_assoc();

    // Extract user information
    $studentID = $row['tbl_student_id']; // Assuming this is the primary key
    $studentName = $row['student_name'];
    $courseSection = $row['course_section'];
    $generatedCode = $row['generated_code'];
    $profilePicture = $row['profile_picture']; // Profile picture from tbl_student
} else {
    // Handle errors or display default values
    $studentID = "Unknown";
    $studentName = "Unknown";
    $courseSection = "Unknown";
    $generatedCode = "Unknown";
    $profilePicture = "/img/default.jpeg"; // Set default profile picture path
}

// Handle profile picture upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $targetDir = "./profile_pictures/"; // Directory where the profile pictures will be stored
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        // Update user's profile picture path in the database
        $updateSql = "UPDATE tbl_student SET profile_picture = '$targetFile' WHERE tbl_student_id = '$studentID'";
        if ($conn->query($updateSql) === TRUE) {
            // Redirect the user back to their profile page with the updated profile picture
            header("Location: http://localhost/website/qr-code-attendance-system/profile.php");
            exit();
        } else {
            $_SESSION['upload_error'] = "Error updating profile picture: " . $conn->error;
        }
    } else {
        $_SESSION['upload_error'] = "Sorry, there was an error uploading your file.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
            display: flex;
            background-image: url('/img/background4.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .sidebar {
            width: 250px;
            padding: 20px;
            color: #fff;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            background-color: #0a0a4eec;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: block;
        }

        .profile-info {
            margin-bottom: 15px;
        }

        .profile-info label {
            font-weight: bold;
            margin-right: 5px;
        }

        .profile-info span {
            color: #ccc;
        }

        .navigation-bar {
            margin-top: auto;
        }

        .navigation-bar ul {
            list-style-type: none;
            padding: 0;
        }

        .navigation-bar ul li {
            margin-bottom: 10px;
        }

        .navigation-bar ul li a {
            color: #ccc;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navigation-bar ul li a:hover {
            background-color: #555;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Display user profile information -->
        <?php if (!empty($profilePicture)) : ?>
            <img class="profile-picture" src="<?php echo $profilePicture; ?>" alt="Profile Picture">
        <?php else: ?>
            <img class="profile-picture" src="/img/default.jpeg" alt="Default Profile Picture">
        <?php endif; ?>
        <div class="profile-info">
            <label>Name:</label>
            <span><?php echo $studentName; ?></span>
        </div>
        <div class="profile-info">
            <label>Course Section:</label>
            <span><?php echo $courseSection; ?></span>
        </div>
        <div class="profile-info">
            <label>Generated Code:</label>
            <span><?php echo $generatedCode; ?></span>
        </div>
        <!-- End of user profile information -->
        <div class="navigation-bar">
            <ul>
                <li><a href="http://localhost/website/website.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <h1>Welcome to Your Profile</h1>
        <p>This is where you can add more content related to the user profile.</p>
        <?php if (isset($_SESSION['upload_error'])) : ?>
            <div class="error-message"><?php echo $_SESSION['upload_error']; ?></div>
            <?php unset($_SESSION['upload_error']); ?>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <h2>Change Profile Picture</h2>
            <input type="file" name="file" id="file">
            <input type="submit" value="Upload Image" name="submit" >
        </form>
    </div>
</body>
</html>

