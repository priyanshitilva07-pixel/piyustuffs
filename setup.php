<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create admin database
$sql = "CREATE DATABASE IF NOT EXISTS ultras_admin";
if ($conn->query($sql) === TRUE) {
  echo "Database ultras_admin created successfully<br>";
} else {
  echo "Error creating database: " . $conn->error . "<br>";
}

// Create customer database
$sql = "CREATE DATABASE IF NOT EXISTS ultras_customers";
if ($conn->query($sql) === TRUE) {
  echo "Database ultras_customers created successfully<br>";
} else {
  echo "Error creating database: " . $conn->error . "<br>";
}

// --- Admin Database Setup ---
$conn->select_db("ultras_admin");

// Create admins table
$sql = "CREATE TABLE IF NOT EXISTS admins (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(255) NOT NULL,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
  echo "Table admins created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Create products table
$sql = "CREATE TABLE IF NOT EXISTS products (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  image VARCHAR(255) NOT NULL,
  category VARCHAR(50)
)";
if ($conn->query($sql) === TRUE) {
  echo "Table products created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// --- Customer Database Setup ---
$conn->select_db("ultras_customers");

// Create customers table
$sql = "CREATE TABLE IF NOT EXISTS customers (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  email VARCHAR(50),
  password VARCHAR(255) NOT NULL,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
  echo "Table customers created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Create carts table
$sql = "CREATE TABLE IF NOT EXISTS carts (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  customer_id INT(6) UNSIGNED NOT NULL,
  product_id INT(6) UNSIGNED NOT NULL,
  quantity INT(3) NOT NULL,
  size VARCHAR(10) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
  echo "Table carts created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Create wishlists table
$sql = "CREATE TABLE IF NOT EXISTS wishlists (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  customer_id INT(6) UNSIGNED NOT NULL,
  product_id INT(6) UNSIGNED NOT NULL
)";
if ($conn->query($sql) === TRUE) {
  echo "Table wishlists created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Create orders table
$sql = "CREATE TABLE IF NOT EXISTS orders (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  customer_id INT(6) UNSIGNED NOT NULL,
  fname VARCHAR(30) NOT NULL,
  lname VARCHAR(30) NOT NULL,
  address VARCHAR(255) NOT NULL,
  city VARCHAR(50) NOT NULL,
  zip VARCHAR(10) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL,
  total DECIMAL(10, 2) NOT NULL,
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
  echo "Table orders created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Create order_items table
$sql = "CREATE TABLE IF NOT EXISTS order_items (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_id INT(6) UNSIGNED NOT NULL,
  product_id INT(6) UNSIGNED NOT NULL,
  quantity INT(3) NOT NULL,
  size VARCHAR(10) NOT NULL,
  price DECIMAL(10, 2) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
  echo "Table order_items created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
?>
