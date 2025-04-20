<?php
session_start();
include 'db.php'; // Ensure that you have a proper PostgreSQL connection in db.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Initialize an error variable
    $error = "";

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if username or email already exists in PostgreSQL
        $check_sql = "SELECT * FROM users WHERE username = $1 OR email = $2";
        $stmt = pg_prepare($conn, "check_user", $check_sql);
        $result = pg_execute($conn, "check_user", array($username, $email));

        if (pg_num_rows($result) > 0) {
            $error = "Username or Email already exists!";
        } else {
            // Insert user into PostgreSQL database
            $sql = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
            $stmt = pg_prepare($conn, "insert_user", $sql);
            $result = pg_execute($conn, "insert_user", array($username, $email, $hashed_password));

            if ($result) {
                $_SESSION['user'] = $username; // Log in the user
                header("Location: login.php"); // Redirect to login page
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="background-image:url('images/register-bg.jpg');background-size:cover;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 500px;">
            <h3 class="text-center">Register</h3>
            <?php if (!empty($error)) echo "<p class='text-danger text-center'>$error</p>"; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Register</button>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>
</body>
</html>
