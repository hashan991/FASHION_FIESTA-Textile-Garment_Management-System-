<?php
include('header.php');

include('../config.php');

// Check if the form is submitted for signup
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['pswd'];

    // Hash the password before storing it in the database for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Perform the database query to insert the new user
    $sql = "INSERT INTO user (name, mobile, email, password) VALUES ('$name', '$mobile', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!');</script>";
        $email = $_POST['email'];
        setcookie('email', $email, time() + 3600, '/'); // Set a cookie for email, expires in 1 hour (3600 seconds)
        header("Location: ../index.php"); // Redirect to index.php after successful signup
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $loginEmail = $_POST['login_email'];
    $loginPassword = $_POST['login_pswd'];

    // Perform the database query to check login credentials
    $sql = "SELECT * FROM user WHERE email='$loginEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($loginPassword, $row['password'])) {
            echo "<script>alert('Login successful!');</script>";
            $email = $_POST['login_email'];
            setcookie('email', $email, time() + 3600, '/');
            header("Location: ../index.php"); 
            exit();
        } else {
            echo "<script>alert('Invalid email or password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="../styles/signupsignin.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="outer-main">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup">
                <form method="post">
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input type="text" name="name" placeholder="Full Name" required="">
                    <input type="text" name="mobile" placeholder="Mobile Number" required="">
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="pswd" placeholder="Password" required="">
                    <button type="submit" name="signup">Sign up</button>
                </form>
            </div>

            <div class="login">
                <form method="post">
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="login_email" placeholder="Email" required="">
                    <input type="password" name="login_pswd" placeholder="Password" required="">
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </div>

    </div>

</body>

</html>