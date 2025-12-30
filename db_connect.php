<?php
$servername = "localhost";
$username = "root";
$password = "";

function connect_admin_db() {
    global $servername, $username, $password;
    $conn = new mysqli($servername, $username, $password, "ultras_admin");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function connect_customer_db() {
    global $servername, $username, $password;
    $conn = new mysqli($servername, $username, $password, "ultras_customers");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
