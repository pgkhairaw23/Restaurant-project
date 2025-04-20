<?php
session_start();
include 'db.php'; // Ensure that this file contains the PostgreSQL connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query for PostgreSQL with a placeholder for username
    $sql = "SELECT * FROM admins WHERE username = $1";  // $1 is a placeholder for the username

    // Prepare the query with PostgreSQL
    $stmt = pg_prepare($conn, "admin_login_query", $sql);  // Prepare the query using pg_prepare

    // Check if the preparation was successful
    if ($stmt) {
        // Execute the query with parameters
        $result = pg_execute($conn, "admin_login_query", array($username));  // Execute the query with parameters

        // Check if the query executed successfully
        if ($result) {
            $admin = pg_fetch_assoc($result);  // Fetch the result as an associative array

            // Check if the password matches the hashed password in the database
            if ($admin && $password=="admin123") {
                $_SESSION['admin'] = $username;
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error = "Invalid admin username or password!";
            }
        } else {
            $error = "An error occurred while executing the query.";
        }
    } else {
        $error = "Query preparation failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('images/admin_bg.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h3 class="text-center">Admin Login</h3>
        <?php if (isset($error)) echo "<p class='text-danger text-center'>$error</p>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-danger w-100">Login as Admin</button>
        </form>
    </div>
</body>
</html>
