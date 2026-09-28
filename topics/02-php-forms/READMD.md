# ITEC 464 - PHP Simple Web Form Exercise

This exercise demonstrates how to create and process an HTML form using PHP.

## Learning Objectives

After completing this exercise, you should be able to:

- Create an HTML form that submits data using `POST`
- Retrieve submitted form values using PHP
- Validate form input
- Display inline validation error messages
- Use an associative array to store validation errors
- Validate an email address using `filter_var()`
- Preserve form values after validation errors
- Use PHP sessions to pass validated data between pages
- Use an associative array to store product prices
- Calculate an order total using product price and quantity
- Safely display user input using `htmlspecialchars()`

## Files

The exercise contains three files:

```text
order.php
process-order.php
order.css
```

### `order.php`

Displays the order form and performs server-side validation.

The form validates:

- Customer Name
- Email Address
- Product
- Quantity

Validation errors are stored in an associative array:

```php
$errors = [];
```

For example:

```php
if (empty($name)) {
    $errors["name"] = "Customer name is required.";
}
```

The error can then be displayed beside the appropriate field:

```php
<span class="error">
    <?php echo $errors["name"] ?? ""; ?>
</span>
```

If validation succeeds, the order information is placed into the session:

```php
$_SESSION["order"] = [
    "name" => $name,
    "email" => $email,
    "product" => $product,
    "quantity" => $quantity,
    "shipping" => $shipping,
    "instructions" => $instructions
];
```

The user is then redirected to:

```text
process-order.php
```

---

### `process-order.php`

Retrieves the validated order information from the session and processes the order.

Product prices are stored in an associative array:

```php
$prices = [
    "Laptop" => 900,
    "Monitor" => 250
];
```

The selected product determines the price:

```php
$price = $prices[$product];
```

The order total is calculated using:

```php
$total = $price * $quantity;
```

The completed order is then displayed to the user.

---

### `order.css`

Contains the styling for the form and validation messages.

Example:

```css
.error {
    color: red;
    font-size: 12px;
}
```

## Application Flow

```text
order.php
    |
    | Submit Form
    v
Validate Input
    |
    +---- Invalid ----> Display Inline Errors
    |
    +---- Valid
             |
             v
      Store Data in Session
             |
             v
      process-order.php
             |
             v
      Calculate Order Total
             |
             v
        Display Results
```

## Important PHP Concepts

### Reading Form Data

```php
$name = trim($_POST["name"] ?? "");
```

### Validating Email

```php
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Please enter a valid email address.";
}
```

### Checking for Validation Errors

```php
if (empty($errors)) {
    // Form is valid
}
```

### Starting a Session

```php
session_start();
```

### Storing Data in a Session

```php
$_SESSION["order"] = $order;
```

### Safely Displaying User Input

```php
echo htmlspecialchars($name);
```

## Running the Exercise

PHP must be running through a web server. Do not simply double-click the `.php` files.

For example, using our lab/PHP development server:

```text
http://localhost:8000/lab01/order.php
```

## Try It Yourself

After reviewing the completed example, try extending the application.

Possible improvements include:

- Add additional products
- Add additional shipping methods
- Add shipping charges
- Validate the shipping method
- Validate special instructions
- Add sales tax
- Display a complete order summary
- Format the form using additional CSS

---

**ITEC 464 - Web Development**  
Towson University  
Dr. William Thompson
