<?php
include 'db.php'; // Ensure this file connects to your PostgreSQL database

// Fetch menu items from the database
$sql = "SELECT * FROM menu_items";
$result = pg_query($conn, $sql); // Execute the query in PostgreSQL
$menu = [];

if ($result) {
    // Iterate over each row in the result set
    while ($row = pg_fetch_assoc($result)) {
        $menu[$row['category']][] = $row;
    }
} else {
    // Handle error if query fails
    echo "Error executing query: " . pg_last_error($conn);
}

// Close the PostgreSQL connection
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Menu</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        
        .category {
            margin-bottom: 40px;
            text-align: center;
        }
        
        /* Updated category styling */
        .category-title {
            font-size: 28px;
            font-weight: bold;
            color: #6c432b; /* Dark Brown */
            text-transform: uppercase;
            background-color: #ffeeba; /* Light Yellow */
            padding: 12px 25px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-bottom: 4px solid #d39e00; /* Slightly darker yellow */
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }
        .item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .item img {
            width: 100%;
            height: 180px;
            border-radius: 10px;
            object-fit: cover;
        }
        .item h4 {
            margin: 10px 0;
            color: #333;
        }
        .item p {
            color: #777;
            font-size: 16px;
        }
        .item button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }
        .item button:hover {
            background: #218838;
        }
        .cart-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px;
            border-radius: 5px;
        }
        .cart-link:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Our Menu</h2>

    <?php foreach ($menu as $category => $items): ?>
        <div class="category">
            <h3 class="category-title"><?php echo $category; ?></h3>
            <div class="grid">
                <?php foreach ($items as $item): ?>
                    <div class="item">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                        <h4><?php echo $item['name']; ?></h4>
                        <p>₹<?php echo $item['price']; ?></p>
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <input type="hidden" name="name" value="<?php echo $item['name']; ?>">
                            <input type="hidden" name="price" value="<?php echo $item['price']; ?>">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="cart.php" class="cart-link">View Cart</a>
</div>

</body>
</html>
