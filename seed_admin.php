<?php
include 'db_connect.php';

$conn_admin = connect_admin_db();

// Truncate the admins table to start fresh
$conn_admin->query("TRUNCATE TABLE admins");

$username = 'admin';
$password = password_hash('password', PASSWORD_DEFAULT);

$stmt = $conn_admin->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "Admin user seeded successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn_admin->close();
?>
