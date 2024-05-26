<?php
// Check if the username cookie is set
$isLoggedIn = isset($_COOKIE['username']);

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

// Initialize an empty array to store child data
$children = array();

// Fetch children data from the database
if ($isLoggedIn) {
    $username = $_COOKIE['username'];
    $sql = "SELECT * FROM children WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch data for each child and store it in the $children array
        while ($row = $result->fetch_assoc()) {
            $children[] = $row;
        }
    }
}

// Initialize an empty array to store lost children data
$lostChildren = array();

// Fetch lost children data from the database where 'lost' value is 1
$sql = "SELECT * FROM children WHERE lost = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch data for each lost child and store it in the $lostChildren array
    while ($row = $result->fetch_assoc()) {
        $lostChildren[] = $row;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Me Safe</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>

<body>
<nav class="navbar">
    <div class="navbar-left">
        <img src="only logo.png" alt="Logo">
        <div class="navbar-center">
            Find Me Safe
        </div>
    </div>
    <div class="navbar-right">
        <a href="/">Home</a>
        <a href="/AboutUs">About Us</a>
        <?php if ($isLoggedIn): ?>
            <a href="/RegisterChild">Register Child</a>
            <a href="/logout">Log Out</a>
        <?php else: ?>
            <a href="/login">Log In</a>
        <?php endif; ?>
    </div>
</nav>

<section class="full-width-card">
    <div class="card-container">
        <h2>Found Lost Child?</h2>
        <button onclick="location.href='/FaceRecognition/scanFace.html'">Find his/her Identity</button>
    </div>
</section>

<div class="title-box">
    <h1>My Children</h1>
</div>
<div class="lost-children">
    <?php foreach ($children as $child): ?>
        <div class="card">
            <img src="/FaceRecognition/Backup/<?php echo $child['ecid']; ?>.png" alt="Child Photo" class="image_momo">
            <div class="card-content">
                <button class="arihant" onclick="location.href='/IPFSapi/retrieve?ecid=<?php echo $child['ecid']; ?>'">View Details</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="title-box">
    <h1>Lost Children</h1>
</div>
<div class="lost-children">
    <?php foreach ($lostChildren as $lostChild): ?>
        <div class="card">
            <img src="/FaceRecognition/Backup/<?php echo $lostChild['ecid']; ?>.png" alt="Lost Child Photo" class="image_momo">
            <div class="card-content">
                <button class="arihant" onclick="location.href='/IPFSapi/retrieve?ecid=<?php echo $lostChild['ecid']; ?>'">View Details</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="bottom-bar">
    &copy; 2024 Find Me Safe. All rights reserved.
</div>
</body>

</html>
