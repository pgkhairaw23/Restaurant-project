<?php
session_start();
include 'db.php'; // Include PostgreSQL connection (this should contain pg_connect)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Normal user login using PostgreSQL
    $sql = "SELECT * FROM users WHERE username = $1";  // $1 is the placeholder for the username
    $stmt = pg_prepare($conn, "login_query", $sql);  // Prepare the query
    $result = pg_execute($conn, "login_query", array($username));  // Execute the query with parameters

    if ($result) {
        $user = pg_fetch_assoc($result);  // Fetch the result as an associative array
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "An error occurred while processing your request.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('images/lbg.jpg') no-repeat center center fixed;
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
            width: 500px;
        }
    </style>
</head>
<body>
    <div class="login-card" >
        <h3 class="text-center">Login</h3>
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
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <form action="admin_login.php" method="GET">
            <button type="submit" class="btn btn-danger w-100 mt-2">Login as Admin</button>
        </form>
        <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
