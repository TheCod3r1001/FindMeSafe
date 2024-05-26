<?php
// Check if the username cookie is set
if (isset($_COOKIE['username'])) {
    // Unset the cookie by setting its expiration time in the past
    setcookie("username", "", time() - 3600, "/");
}

// Redirect to the login page or any other page
header("Location: /Login");
exit();
?>
