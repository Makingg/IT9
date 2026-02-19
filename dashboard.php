<?php
session_start();

// Guard: must be logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Initialize listings in session if not yet existing
if (!isset($_SESSION['listings'])) {
    $_SESSION['listings'] = [];
}

$errors = [];

// ── HANDLE FORM SUBMIT ──
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $title   = $_POST['title'];
    $price   = $_POST['price'];
    $address = $_POST['address'];

    if (empty($title)) {
        $errors[] = "Error: Property title is required.";
    }

    if (empty($price)) {
        $errors[] = "Error: Price is required.";
    } elseif (!is_numeric($price) || $price <= 0) {
        $errors[] = "Error: Price must be a valid positive number.";
    }

    if (empty($address)) {
        $errors[] = "Error: Address is required.";
    }

    if (empty($errors)) {
        $_SESSION['listings'][] = [
            'title'   => $title,
            'price'   => $price,
            'address' => $address,
        ];
    }
}

// ── HANDLE DELETE ──
if (isset($_GET['delete'])) {
    $index = (int) $_GET['delete'];
    if (isset($_SESSION['listings'][$index])) {
        array_splice($_SESSION['listings'], $index, 1);
    }
    header("Location: main.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>REMS Form</title>
</head>
<body>

<h2>Real Estate Management System</h2>

<p>
    Logged in as: <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>
    &nbsp;|&nbsp;
    <?php
    if (isset($_COOKIE["username"])) {
        echo "Cookie: " . htmlspecialchars($_COOKIE["username"]);
    } else {
        echo "Cookie not found!";
    }
    ?>
    &nbsp;|&nbsp;
    <a href="logout.php">Logout</a>
</p>

<hr>

<h3>Add Property Listing</h3>
<form method="POST" action="">
    Property Title: <input type="text" name="title"><br><br>
    Price (PHP): <input type="number" name="price"><br><br>
    Address: <input type="text" name="address"><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
foreach ($errors as $e) {
    echo "<p style='color:red;'>" . $e . "</p>";
}
?>

<hr>

<h3>Saved Listings (<?php echo count($_SESSION['listings']); ?>)</h3>

<?php if (empty($_SESSION['listings'])): ?>
    <p>No listings yet.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Price (PHP)</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        <?php foreach ($_SESSION['listings'] as $i => $listing): ?>
        <tr>
            <td><?php echo $i + 1; ?></td>
            <td><?php echo htmlspecialchars($listing['title']); ?></td>
            <td><?php echo htmlspecialchars($listing['price']); ?></td>
            <td><?php echo htmlspecialchars($listing['address']); ?></td>
            <td><a href="?delete=<?php echo $i; ?>" onclick="return confirm('Delete this listing?')">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>