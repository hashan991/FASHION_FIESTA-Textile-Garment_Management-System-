<?php
$servername = "localhost";
$username = "root";
$password = "RUWINIfeb13";
$database = "clothing";

$conn = new mysqli($servername, $username, $password, $database,3306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
