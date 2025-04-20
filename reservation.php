<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Reservation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color:rgb(248, 248, 248);
        }
        .container {
            width: 90%;
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            text-align: left;
        }
        input, select, button {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border: none;
            margin-top: 15px;
        }
        button:hover {
            background-color: #218838;
        }
        .home-button {
            background-color: #007bff;
            margin-top: 10px;
        }
        .home-button:hover {
            background-color: #0056b3;
        }
        .success, .error {
            text-align: center;
            font-weight: bold;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body style="background-image:url('images/bg1.jpg');background-size:cover;">
    <div class="container">
        <h2>Book a Table</h2>
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <p class="success">Reservation successful!</p>
        <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <p class="error">Error occurred. Please try again.</p>
        <?php endif; ?>
        
        <form action="reserve.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <label for="guests">Number of Guests:</label>
            <select id="guests" name="guests">
                <option value="1">1 Person</option>
                <option value="2">2 People</option>
                <option value="3">3 People</option>
                <option value="4">4 People</option>
                <option value="5">5 People</option>
                <option value="6">6+ People</option>
            </select>

            <button type="submit">Reserve Now</button>
        </form>

        <!-- Home Page Button -->
        <button class="home-button" onclick="window.location.href='home.php';">Go to Homepage</button>
    </div>
</body>
</html>
