<?php
session_start();

// Save listings before logging out
$saved_listings = $_SESSION['listings'] ?? [];

// Destroy session
session_destroy();

// Restart session and put listings back
session_start();
$_SESSION['listings'] = $saved_listings;

// DELETE COOKIE
setcookie("username", "", time() - 3600, "/");

header("Location: login.php");
exit();
?>