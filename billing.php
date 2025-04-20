<?php
session_start();
if (empty($_SESSION['cart'])) {
    header("Location: menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .billing-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body style="background-image:url('images/bb-bg.jpg');background-size:cover;">

<div class="container">
    <h2 class="billing-title">💳 Billing Information</h2>
    
    <form action="process_order.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Billing Address</label>
            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn-submit">Proceed to Payment</button>
    </form>
</div>

</body>
</html>
