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
        $currentEmail = $row['email'];

        // Handle update profile request
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
            $newName = $_POST['name'];
            $newMobile = $_POST['mobile'];
            $newEmail = $_POST['email'];
            $newPassword = $_POST['pswd'];

            // Validate inputs (you can add more validations as needed)
            if (empty($newName) || empty($newMobile) || empty($newEmail) || empty($newPassword)) {
                echo "<script>alert('All fields are required!');</script>";
            } else {
                // Hash the new password before storing it in the database for security
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Perform the database query to update user profile
                $updateSql = "UPDATE user SET name='$newName', mobile='$newMobile', email='$newEmail', password='$hashedPassword' WHERE email='$currentEmail'";
                if ($conn->query($updateSql) === TRUE) {
                    echo "<script>alert('Profile updated successfully!');</script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
    } else {
        // Handle the case when the user does not exist with the given email
        echo "<script>alert('User not found!');</script>";
        header("Location: ../index.php"); // Redirect to index.php if user not found
        exit();
    }
} else {
    // Handle the case when the email cookie is not set
    echo "<script>alert('Email cookie not set!');</script>";
    header("Location: ../index.php"); // Redirect to index.php if email cookie not set
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Profile</title>
    <link rel="stylesheet" type="text/css" href="../styles/signupsignin.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="outer-main">
        <div class="main" style="height:auto">
            <input type="checkbox" id="chk" aria-hidden="true">
            <div class="profile-update" style="color:white;padding:4%;">
                <h2>Update Profile</h2>
                <form method="post">
                    <input type="text" name="name" placeholder="Full Name" value="<?php echo $name; ?>" required="">
                    <input type="text" name="mobile" placeholder="Mobile Number" value="<?php echo $mobile; ?>" required="">
                    <input type="email" name="email" placeholder="Email" value="<?php echo $currentEmail; ?>" required="">
                    <input type="password" name="pswd" placeholder="New Password" required="">
                    <button type="submit" name="update" class="update-btn">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
