<?php
include 'db.php';  // Ensure you have the correct PostgreSQL database connection here

// Hash the password
$password = password_hash('admin123', PASSWORD_DEFAULT);

// Escape the username and password to prevent SQL injection
$username = pg_escape_string($conn, 'admin');
$password = pg_escape_string($conn, $password);

// Insert query for PostgreSQL
$sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

// Execute the query using pg_query()
if (pg_query($conn, $sql)) {
    echo "Admin user created successfully.";
} else {
    echo "Error: " . pg_last_error($conn);
}

// Close the connection
pg_close($conn);
?>
