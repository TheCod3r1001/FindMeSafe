<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "findmesafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'ecid' parameter is provided in the POST request
if (isset($_GET['ecid'])) {
    $ecid = $_GET['ecid'];

    // Prepare and execute SQL query to update the 'lost' status for the child
    $sql = "UPDATE children SET lost = 1 WHERE ecid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ecid);

    if ($stmt->execute()) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => "Failed to update lost status."));
    }

    // Close statement
    $stmt->close();
} else {
    echo json_encode(array("success" => false, "error" => "'ecid' parameter is missing."));
}

// Close database connection
$conn->close();
?>
