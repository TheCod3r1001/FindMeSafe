<?php

// Get the username from cookies
$username = $_COOKIE['username'] ?? '';

// Get the ECID from POST data
$ecid = $_POST['ecid'] ?? '';

// Initialize 'lost' as 0 (false)
$lost = 0;

// Database connection details
$servername = "localhost";
$username_db = "root"; // Change this
$password_db = ""; // Change this
$database = "findmesafe";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert data into 'children' table
$sql = "INSERT INTO children (username, ecid, lost) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $username, $ecid, $lost);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    // Redirect to /FaceRecognition/Upload with the ECID as a query parameter
    header("Location: /FaceRecognition/uploadFace.html?ecid=" . $ecid);
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

?>
