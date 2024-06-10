<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "techwise_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to insert data
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        // Insertion successful
        header("location: /techwise/test_landing.php");
    } else {
        // Insertion failed
        echo "Error: " . $conn->error;
    }
}
?>