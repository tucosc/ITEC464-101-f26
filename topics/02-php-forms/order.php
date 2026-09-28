<?php
session_start(); // start section

$name = "";
$email = "";
$product = "";
$quantity = 1;

$errors = [];

$prices = [
    "Laptop" => 900,
    "Monitor" => 250
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $product = trim($_POST["product"] ?? "");
    $quantity = $_POST["quantity"] ?? "";

    // Validate name
    if (empty($name)) {
        $errors["name"] = "Customer name is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    }

    // Validate product
    if (empty($product)) {
        $errors["product"] = "Please select a product.";
    } elseif (!array_key_exists($product, $prices)) {
        $errors["product"] = "Invalid product selected.";
    }

    // Validate quantity
    if (empty($quantity)) {
        $errors["quantity"] = "Quantity is required.";
    } elseif (!is_numeric($quantity) || $quantity < 1) {
        $errors["quantity"] = "Quantity must be at least 1.";
    }

    // ALL VALID
    if (empty($errors)) {

        $_SESSION["order"] = [
            "name" => $name,
            "email" => $email,
            "product" => $product,
            "quantity" => $quantity,
            "shipping" => $_POST["shipping"] ?? "Standard",
            "instructions" => trim($_POST["instructions"] ?? "")
        ];

        header("Location: process-order.php");
        exit;
    }
}
?>
