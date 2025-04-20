<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="conatct_form.php">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .contact-info p {
            font-size: 16px;
            margin: 5px 0;
        }
        .contact-info a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
        .social-media a {
            margin: 0 10px;
            text-decoration: none;
            font-size: 20px;
            color: #007bff;
        }
        .contact-form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input, textarea, button {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
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
        iframe {
            width: 100%;
            height: 300px;
            border: 0;
            margin-top: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body style="background-image:url('images/Cc-bg.jpg');background-size:cover;">

    <div class="container">
        <h2>Contact Us</h2>

        <div class="contact-info">
            <p><strong>📍 Address:</strong> Sane Chowk,Chikhali,Pune,Maharashtra</p>
            <p><strong>📞 Phone:</strong> <a href="tel:+91 9561319726">+91 9561319726</a></p>
            <p><strong>✉️ Email:</strong> <a href="mailto:dinedelight@restaurant.com">dinedelight@restaurant.com</a></p>
        </div>

        <div class="social-media">
            <a href="#" target="_blank">🌐 Website</a>
            <a href="#" target="_blank">📘 Facebook</a>
            <a href="#" target="_blank">📸 Instagram</a>
            <a href="#" target="_blank">🐦 Twitter</a>
        </div>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <p class="success">Message sent successfully! We will get back to you soon.</p>
        <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <p class="error">Error sending message. Please try again.</p>
        <?php endif; ?>

        <form action="contact_form.php" method="POST" class="contact-form">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <!-- Home Page Button -->
        <button class="home-button" onclick="window.location.href='home.php';">Go to Homepage</button>

        <!-- Google Maps -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434508765!2d144.9537363156656!3d-37.81627974202114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d5df1f6e7f1%3A0x5045675218ce6e0!2sMelbourne!5e0!3m2!1sen!2sau!4v1631663741674!5m2!1sen!2sau"></iframe>
    </div>

</body>
</html>
