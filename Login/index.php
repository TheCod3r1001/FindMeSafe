<?php
if (isset($_COOKIE['username'])) {
    header("Location: /");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form action="" method="post">
      <div class="input-group">
        <label for="username">Username:</label>
        <div class="input-wrapper">
          <span class="icon">@</span>
          <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>
      </div>

      <div class="input-group">
        <label for="password">Password:</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
          <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>
      </div>

      <input type="submit" name="submit" value="Login">

      <div class="forgot">
        Not a Member? <a href="/Signup">Signup</a>
      </div>
    </form>
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById('password');
      const toggleIcon = document.querySelector('.toggle-password');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.textContent = '🔒';
      } else {
        passwordField.type = 'password';
        toggleIcon.textContent = '👁️';
      }
    }
  </script>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "findmesafe";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM credentials WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();

    if ($hashedPassword === $storedPassword) {
      setcookie("username", $username, time() + (86400 * 30), "/"); // Set cookie for 30 days
      header("Location: /");
      exit();
    } else {
      echo "<p>Invalid username or password.</p>";
    }

    $stmt->close();
    $conn->close();
  }
  ?>
</body>
</html>
