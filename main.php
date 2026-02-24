<?php
include "process.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Summary</title>
</head>
<body>

<h2>Sales Summary</h2>

<?php if ($item): ?>

<p><strong>Item:</strong>
<?php echo $item['name']; ?>
</p>

<p><strong>Price:</strong>
<?php echo formatCurrency($item['price']); ?>
</p>

<p><strong>Quantity:</strong>
<?php echo $item['quantity']; ?>
</p>

<hr>

<p><strong>Subtotal:</strong>
<?php echo formatCurrency($item['subtotal']); ?>
</p>

<p><strong>Discount:</strong>
<?php echo formatCurrency($item['discount']); ?>
</p>

<p><strong>Tax:</strong>
<?php echo formatCurrency($item['tax']); ?>
</p>

<p><strong>Final Amount:</strong>
<?php echo formatCurrency($item['finalAmount']); ?>
</p>

<?php else: ?>
<p>No data submitted.</p>
<?php endif; ?>

<br>
<a href="form.php">Add Another Item</a>

</body>
</html>