<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'quantity' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $item['id']) {
            $cart_item['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    header("Location: cart.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['remove'])) {
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $_GET['remove']) {
            unset($_SESSION['cart'][$key]);
        }
    }

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .cart-table th, .cart-table td {
            text-align: center;
            vertical-align: middle;
        }
        .cart-total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
        }
        .btn-remove {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-remove:hover {
            background-color: #c82333;
        }
        .btn-checkout {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            text-align: center;
            width: 100%;
        }
        .btn-checkout:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="cart-title">🛒 Your Cart</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table table-bordered cart-table">
            <thead class="table-dark">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $cart_item): 
                    $subtotal = $cart_item['price'] * $cart_item['quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo $cart_item['name']; ?></td>
                        <td>₹<?php echo number_format($cart_item['price'], 2); ?></td>
                        <td><?php echo $cart_item['quantity']; ?></td>
                        <td>₹<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <a href="cart.php?remove=<?php echo $cart_item['id']; ?>" class="btn btn-remove">❌ Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-total">
            Total: <span class="text-success">₹<?php echo number_format($total, 2); ?></span>
        </div>

        <a href="billing.php" class="btn btn-primary mt-3" style="display: block; text-align: center; padding: 10px; font-size: 18px;">
    Proceed to Checkout
        </a>
        
        <a href="menu.php" class="btn btn-secondary mt-3" style="display: block; text-align: center; padding: 10px; font-size: 18px;">
    Continue Shopping
        </a>
        
    <?php else: ?>
        <p class="text-center mt-4">Your cart is empty. <a href="menu.php">Continue shopping</a>.</p>
    <?php endif; ?>
</div>

</body>
</html>
