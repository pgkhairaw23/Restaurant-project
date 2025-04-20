<?php
$host = "localhost";  // Database host
$dbname = "restaurant";  // Your PostgreSQL database name
$user = "postgres";  // PostgreSQL username (default is "postgres" or your username)
$pass = "priyanka";  // PostgreSQL password (leave empty if there's no password)

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
