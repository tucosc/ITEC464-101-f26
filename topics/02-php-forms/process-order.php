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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Results</title>
</head>

<body>
    <h1>Order Received</h1>

    <p>
        Customer:
        <?php echo htmlspecialchars($name); ?>
    </p>

    <p>
        Email: <?php echo htmlspecialchars($email); ?>
    </p>

    <p>
        Product: <?php echo htmlspecialchars($product); ?>
    </p>

    <p>
        Quantity: <?php echo htmlspecialchars($quantity); ?>
    </p>

    <p> Shipping: <?php echo htmlspecialchars($shipping); ?> </p>

    <p>
        Special Instructions: <?php echo htmlspecialchars($instructions); ?>
    </p>

    <p>
        Price: 
        $<?php echo number_format($price, 2); ?>
    </p>

    <h2>
        Order Total:
        $<?php echo number_format($total, 2); ?>
    </h2>

</body>

</html>
