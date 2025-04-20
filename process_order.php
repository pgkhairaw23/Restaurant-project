<?php 
session_start();
include 'db.php'; // Ensure that this file contains the PostgreSQL connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));

    // Calculate total amount from cart session
    $total_amount = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }
    }

    // Insert order details into database using PostgreSQL
    $sql = "INSERT INTO orders (name, email, phone, address, total_amount) VALUES ($1, $2, $3, $4, $5)";
    
    // Prepare the query
    $stmt = pg_prepare($conn, "insert_order", $sql);
    
    // Execute the query with parameters
    $result = pg_execute($conn, "insert_order", array($name, $email, $phone, $address, $total_amount));

    if ($result) {
        $_SESSION['cart'] = []; // Clear the cart after successful order placement

        // Display bill
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Order Confirmation</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body class='bg-light'>
            <div class='container mt-5'>
                <div class='card shadow p-4'>
                    <h2 class='text-center text-success'>Order Placed Successfully!</h2>
                    <h4 class='mt-3'>Customer Details:</h4>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Phone:</strong> $phone</p>
                    <p><strong>Address:</strong> $address</p>
                    <h4 class='mt-4'>Total Amount: <span class='text-primary'>₹$total_amount</span></h4>
                    <div class='text-center mt-4 d-flex flex-column align-items-center'>
                    <form action='save_bill.php' method='POST' class='w-100' style='max-width: 400px;'>
                        <input type='hidden' name='name' value='" . htmlspecialchars($name) . "'>
                        <input type='hidden' name='email' value='" . htmlspecialchars($email) . "'>
                        <input type='hidden' name='phone' value='" . htmlspecialchars($phone) . "'>
                        <input type='hidden' name='address' value='" . htmlspecialchars($address) . "'>
                        <input type='hidden' name='total_amount' value='" . htmlspecialchars($total_amount) . "'>
                        <button type='submit' class='btn btn-success w-100 py-2'>💾 Save Bill</button>
                    </form>
                    <a href='home.php' class='btn btn-primary w-100 mt-3 py-2' style='max-width: 400px;'>🏠 Back to Home</a>
                </div>
                </div>
            </div>
        </body>
        </html>";
    } else {
        die("Order failed! " . pg_last_error($conn));
    }

    // No need to close the PostgreSQL connection explicitly, it's automatically closed at the end of the script.
    // But you can manually close if needed
    // pg_close($conn);
}
?>
