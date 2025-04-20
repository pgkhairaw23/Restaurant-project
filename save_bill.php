<?php
session_start();
include 'db.php';  // Assuming this file has your PostgreSQL connection setup

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $total_amount = $_POST['total_amount'];

    // PostgreSQL query - syntax is similar but does not use prepared statement "?" binding like MySQL
    $sql = "INSERT INTO bill (name, email, phone, address, total_amount) VALUES ($1, $2, $3, $4, $5)";
    
    // Prepare the statement and bind parameters in PostgreSQL
    $stmt = pg_prepare($conn, "insert_bill", $sql);
    
    // Execute the prepared statement
    $result = pg_execute($conn, "insert_bill", array($name, $email, $phone, $address, $total_amount));

    if ($result) {
        unset($_SESSION['bill']);
        echo "<script>alert('Bill saved successfully!'); window.location.href='home.php';</script>";
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}
?>
