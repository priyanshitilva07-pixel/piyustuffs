<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: admin_login.php");
    exit;
}

if (isset($_GET['id'])) {
    $conn_admin = connect_admin_db();
    $product_id = $_GET['id'];
    
    $stmt = $conn_admin->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    
    if ($stmt->execute()) {
        header("location: admin.php");
    } else {
        echo "Error deleting record: " . $conn_admin->error;
    }
    
    $stmt->close();
    $conn_admin->close();
} else {
    header("location: admin.php");
}
?>
