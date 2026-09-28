<?php
session_start();

if (!isset($_SESSION["order"])) {
    header("Location: order.php");
    exit;
}

$order = $_SESSION["order"];

$name = $order["name"];
$email = $order["email"];
$product = $order["product"];
$quantity = $order["quantity"];
$shipping = $order["shipping"];
$instructions = $order["instructions"];

$prices = [
    "Laptop" => 900,
    "Monitor" => 250
];

$price = $prices[$product];

$total = $price * $quantity;

// Remove order data when finished
unset($_SESSION["order"]);
?>
