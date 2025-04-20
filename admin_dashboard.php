<?php
session_start();
include 'db.php'; // Ensure this file connects to your PostgreSQL database

// Fetch total counts
$total_users = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) AS total FROM users"));
$total_orders = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) AS total FROM orders"));
$total_reservations = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) AS total FROM reservations"));
$total_messages = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) AS total FROM contact_messages"));
$total_menu_items = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) AS total FROM menu_items"));
$total_bills = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) AS total FROM bill"));

// Fetch recent orders
$recent_orders = pg_query($conn, "SELECT name, email, phone, total_amount, order_date FROM orders ORDER BY order_date DESC LIMIT 5");

// Fetch recent reservations
$recent_reservations = pg_query($conn, "SELECT name, email, phone, date, time, guests FROM reservations ORDER BY created_at DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Admin Dashboard</h2>
        <div class="row text-center">

            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_users['total']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Orders</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_orders['total']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total Reservations</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_reservations['total']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Total Messages</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_messages['total']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Total Menu Items</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_menu_items['total']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Total Bills</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_bills['total']; ?></h5>
                    </div>
                </div>
            </div>

        </div>

        <h3 class="mt-5">Recent Orders</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = pg_fetch_assoc($recent_orders)): ?>
                    <tr>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['phone']; ?></td>
                        <td>₹<?= number_format($row['total_amount'], 2); ?></td>
                        <td><?= $row['order_date']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3 class="mt-5">Recent Reservations</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Guests</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = pg_fetch_assoc($recent_reservations)): ?>
                    <tr>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['phone']; ?></td>
                        <td><?= $row['date']; ?></td>
                        <td><?= $row['time']; ?></td>
                        <td><?= $row['guests']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
