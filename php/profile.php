<?php
include('header.php');
include('../config.php');

// Check if the email cookie is set
if (isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];

    // Fetch user data from the database based on the email
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $mobile = $row['mobile'];
    } else {
        // Handle the case when the user does not exist with the given email
        echo "<script>alert('User not found!');</script>";
        header("Location: ../index.php"); // Redirect to index.php if user not found
        exit();
    }
} else {
    // Handle the case when the email cookie is not set
    echo "<script>alert('Email cookie not set!');</script>";
    header("Location: ../index.php"); 
    exit();
}

// Handle delete account request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $deleteSql = "DELETE FROM user WHERE email='$email'";
    if ($conn->query($deleteSql) === TRUE) {
        setcookie('email', '', time() - 3600, '/');
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="../styles/signupsignin.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="outer-main">
        <div class="main" style="height: auto;">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="profile" style="color:white;padding:2%">
                <h2>User Profile</h2>
                <p><strong>Name:</strong> <?php echo $name; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Mobile:</strong> <?php echo $mobile; ?></p>

                <form method="post">
                    <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
                </form>

                <a href="updateprofile.php"><button class="update-btn">Update Profile</button></a>
            </div>
        </div>
    </div>
</body>

</html>
