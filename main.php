<!DOCTYPE html>
<html>
<head>
    <title>REMS Form</title>
</head>
<body>

<h2>Real Estate Management System</h2>

<form method="POST" action="">
    Property Title: <input type="text" name="title"><br><br>
    Price (PHP): <input type="number" name="price"><br><br>
    Address: <input type="text" name="address"><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title   = $_POST['title'];
    $price   = $_POST['price'];
    $address = $_POST['address'];

    
    if (empty($title)) {
        echo "Error: Property title is required." . "<br>";
    }

    if (empty($price)) {
        echo "Error: Price is required." . "<br>";
    } elseif (!is_numeric($price) || $price <= 0) {
        echo "Error: Price must be a valid positive number." . "<br>";
    }

    if (empty($address)) {
        echo "Error: Address is required." . "<br>";
    }

    if (!empty($title) && !empty($address) && is_numeric($price) && $price > 0) {
        echo "<h3>Property Listing Received (POST)</h3>";
        echo "Title: "    . htmlspecialchars(string: $title)   . "<br>";
        echo "Price: PHP " . htmlspecialchars(string: $price)  . "<br>";
        echo "Address: "  . htmlspecialchars(string: $address);
    }
}
?>

</body>
</html>