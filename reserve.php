<?php
// Replace with your actual PostgreSQL connection
include 'db.php';  // Ensure you have the correct PostgreSQL database connection here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape input using pg_escape_string for PostgreSQL
    $name = pg_escape_string($conn, $_POST['name']);
    $email = pg_escape_string($conn, $_POST['email']);
    $phone = pg_escape_string($conn, $_POST['phone']);
    $date = pg_escape_string($conn, $_POST['date']);
    $time = pg_escape_string($conn, $_POST['time']);
    $guests = pg_escape_string($conn, $_POST['guests']);

    // Check if the date and time are in the future
    $reservation_datetime = strtotime("$date $time");
    if ($reservation_datetime < time()) {
        header("Location: reservation.php?status=error");
        exit();
    }

    // Insert query for PostgreSQL
    $sql = "INSERT INTO reservations (name, email, phone, date, time, guests) 
            VALUES ('$name', '$email', '$phone', '$date', '$time', '$guests')";

    // Execute the query using pg_query()
    if (pg_query($conn, $sql)) {
        header("Location: reservation.php?status=success");
    } else {
        header("Location: reservation.php?status=error");
    }

    // Close the connection
    pg_close($conn);
}
?>
