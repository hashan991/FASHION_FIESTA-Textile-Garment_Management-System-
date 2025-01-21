<?php
$servername = "localhost";
$username = "root";
$password = "hasa11";
$database = "clothing";

$conn = new mysqli($servername, $username, $password, $database,3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
