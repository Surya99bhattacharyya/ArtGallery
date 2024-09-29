<?php
$servername = "localhost";  // Change this if your MySQL server is hosted elsewhere
$username = "root";  // MySQL username (default is 'root')
$password = "";  // MySQL password (default is empty for 'root' user)
$dbname = "art_gallery";  // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
