<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);

    if (empty($username)) {
        $error = "Please enter a username.";
    } else {
        $_SESSION['username'] = $username;

        setcookie("username", $username, time() + 3600, "/");

        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>REMS - Login</title>
</head>
<body>

<h2>Real Estate Management System</h2>
<h3>Login</h3>

<?php if (!empty($error)) echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>"; ?>

<form method="POST" action="">
    Username: <input type="text" name="username"><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>