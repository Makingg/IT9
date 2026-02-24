<?php

function computeSubtotal($price, $quantity) {
    return $price * $quantity;
}

function computeDiscount($subtotal) {
    return $subtotal * 0.10;
}

function computeTax($amountAfterDiscount) {
    return $amountAfterDiscount * 0.12;
}

function computeFinalAmount($subtotal, $discount, $tax) {
    return ($subtotal - $discount) + $tax;
}

function formatCurrency($amount) {
    return "₱" . number_format($amount, 2);
}
$item = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $subtotal = computeSubtotal($price, $quantity);
    $discount = computeDiscount($subtotal);
    $taxableAmount = $subtotal - $discount;
    $tax = computeTax($taxableAmount);
    $finalAmount = computeFinalAmount($subtotal, $discount, $tax);

    $item = [
        "name" => $item,
        "price" => $price,
        "quantity" => $quantity,
        "subtotal" => $subtotal,
        "discount" => $discount,
        "tax" => $tax,
        "finalAmount" => $finalAmount
    ];
}

?>