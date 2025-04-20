<?php
include 'db.php';  // Assuming this file has your PostgreSQL connection setup

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use pg_escape_string to escape user input
    $name = pg_escape_string($conn, $_POST['name']);
    $email = pg_escape_string($conn, $_POST['email']);
    $message = pg_escape_string($conn, $_POST['message']);

    // PostgreSQL query with placeholders to avoid SQL injection
    $sql = 'INSERT INTO contact_messages (name, email, message) VALUES ($1, $2, $3)';
    
    // Prepare and execute the statement
    $result = pg_prepare($conn, "insert_contact_message", $sql);
    
    if ($result) {
        // Execute the prepared statement with actual values
        $result_execute = pg_execute($conn, "insert_contact_message", array($name, $email, $message));
        
        if ($result_execute) {
            header("Location: contact.php?status=success");
        } else {
            header("Location: contact.php?status=error");
        }
    } else {
        header("Location: contact.php?status=error");
    }

    // Close the connection
    pg_close($conn);
}
?>
