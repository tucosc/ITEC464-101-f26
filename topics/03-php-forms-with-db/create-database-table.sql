/* Create our labs database */
CREATE DATABASE IF NOT EXISTS labs_db;
USE labs_db;

-- Create a user and grant privileges
CREATE USER IF NOT EXISTS 'wp_user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON labs_db.* TO 'wp_user'@'%';
FLUSH PRIVILEGES;

-- Create the orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    product VARCHAR(50) NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    shipping VARCHAR(20) NOT NULL,
    instructions TEXT,
    unit_price DECIMAL(10, 2) NOT NULL,
    order_total DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
