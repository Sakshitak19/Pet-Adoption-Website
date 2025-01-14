<?php
// db.php - Database connection file

$servername = "localhost"; // Database server (use 'localhost' for local development)
$username = "root";        // MySQL username (default for XAMPP is 'root')
$password = "";            // MySQL password (default for XAMPP is an empty string)
$dbname = "pet_adoption";  // Database name (create this database in MySQL)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
