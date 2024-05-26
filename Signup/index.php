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
  <title>Signup Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Signup</h2>
    <form action="" method="post">
      <div class="input-group">
        <label for="username">Username:</label>
        <div class="input-wrapper">
          <span class="icon">@</span>
          <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>
      </div>

      <div class="input-group">
        <label for="email">Email:</label>
        <div class="input-wrapper">
          <span class="icon">📧</span>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
      </div>

      <div class="input-group">
        <label for="password">Password:</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
          <span class="toggle-password" onclick="togglePassword('password', 'togglePassword1')" id="togglePassword1">👁️</span>
        </div>
      </div>

      <div class="input-group">
        <label for="confirm-password">Confirm Password:</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
          <span class="toggle-password" onclick="togglePassword('confirm-password', 'togglePassword2')" id="togglePassword2">👁️</span>
        </div>
      </div>

      <div class="input-group">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">I agree to the <a href="terms-and-policies.html" target="_blank">Terms and Policies</a></label>
      </div>

      <input type="submit" name="submit" value="Signup">

      <div class="forgot">
        Already a Member? <a href="login.php">Login</a>
      </div>
    </form>
  </div>

  <script>
    function togglePassword(fieldId, toggleId) {
      const passwordField = document.getElementById(fieldId);
      const toggleIcon = document.getElementById(toggleId);
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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($password === $confirmPassword) {
      $hashedPassword = hash('sha256', $password);

      $servername = "localhost";
      $dbusername = "root";
      $dbpassword = "";
      $dbname = "findmesafe";

      $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $stmt = $conn->prepare("INSERT INTO credentials (username, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $username, $email, $hashedPassword);

      if ($stmt->execute()) {
        header("Location: /Login");
        exit();
      } else {
        echo "<p>Error: " . $stmt->error . "</p>";
      }

      $stmt->close();
      $conn->close();
    } else {
      echo "<p>Passwords do not match.</p>";
    }
  }
  ?>
</body>
</html>
