<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "techwise_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitBtn'])) {
    $un = $_POST['username'];
    $pw = $_POST['password'];

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $un, $pw);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the data
    $row = $result->fetch_assoc();

    // Check if user exists
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $un;
        header("location: /techwise/test_landing.php");
        exit; // Ensure no further code execution after redirection
    } else {
        echo "Invalid username or password";
    }
}
?>
