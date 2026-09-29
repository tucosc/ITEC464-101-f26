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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Order Form</title>
    <link rel="stylesheet" href="order.css">
</head>

<body>
    <h1>Simple Order Form</h1>
    <form action="order.php" method="post">
        <p>
            <label>Customer Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error"><?php echo $errors['name'] ?? ""; ?></span>
        </p>
        <p>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $errors['email'] ?? ""; ?></span>
        </p>
        <p>
            <label>Product</label>
            <select name="product">
                <option value="">--Select a product--</option>
                <option <?php if($product == 'Laptop') echo "selected"; ?>>Laptop</option>
                <option <?php if($product == 'Monitor') echo "selected"; ?>>Monitor</option>
            </select>
            <span class="error"><?php echo $errors['product'] ?? ""; ?></span>
        </p>

        <p>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1">
        </p>

        <p>
            <label>Shipping Method</label>
            <input type="radio" id="standard" name="shipping" value="Standard" checked>
            <label for="standard">Standard</label>

            <input type="radio" id="express" name="shipping" value="Express">
            <label for="express">Express</label>

            <input type="radio" id="overnight" name="shipping" value="Overnight">
            <label for="overnight">Overnight</label>
        </p>

        <p>
            <label for="instructions">Instructions</label>
            <textarea name="instructions" rows="3" cols="40"></textarea>
        </p>

        <button type="submit">Place Order</button>

    </form>
</body>

</html>
