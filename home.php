<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Custom CSS for Styling */
        body {
            font-family: Arial, sans-serif;
        }
        .hero 
        {
            background: url('images/bg1.jpg') no-repeat center center/cover;
            height: 90vh; /* Adjust height */
           
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            font-size: 28px;
            font-weight: bold;
            font-style:italic;
            padding: 20px;
        }
        
        .menu-section {
            padding: 50px 20px;
            background-color:white;
        }
        .menu-card {
            border-radius: 10px;
            overflow: hidden;
            transition: 0.3s;
        }
        .menu-card:hover {
            transform: scale(1.05);
        }
        .menu-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .txt {
        text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.7), 
                     -2px -2px 3px rgba(0, 0, 0, 0.7); /* Text outline effect */
    }
        .txtcontainer {
            width: 100%;
            text-align: right;
    }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">🍽️ Dine Delight</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="home.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="reservation.php">Reservation</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero">
    <div class="txtcontainer">
        <center>
        <h1 class="txt">DINE-DELIGHT</h1>
        <h1 class="txt">Welcome to Our Restaurant</h1>
        <p  class="txt">Experience delicious meals and a wonderful atmosphere.</p>
        <a href="menu.php" class="btn btn-primary btn-lg">View Menu</a>
</center>
    </div>
</div>

<!-- Featured Menu Section -->
<section class="menu-section">
    <div class="container text-center">
        <h2 class="mb-4">🌟 Featured Dishes</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card menu-card">
                    <img src="images/Grilled_Steak.jpg" alt="Dish 1">
                    <div class="card-body">
                        <h5 class="card-title">Grilled Steak</h5>
                        <p class="card-text">$25.99</p>
                        <a href="menu.php" class="btn btn-success">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card menu-card">
                    <img src="images/Spaghetti_Carbonara.jpg" alt="Dish 2">
                    <div class="card-body">
                        <h5 class="card-title">Spaghetti Carbonara</h5>
                        <p class="card-text">$18.99</p>
                        <a href="menu.php" class="btn btn-success">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card menu-card">
                    <img src="images/Salmon_Sushi.jpg" alt="Dish 3">
                    <div class="card-body">
                        <h5 class="card-title">Salmon Sushi</h5>
                        <p class="card-text">$15.99</p>
                        <a href="menu.php" class="btn btn-success">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    &copy; 2025 Our Restaurant. All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
