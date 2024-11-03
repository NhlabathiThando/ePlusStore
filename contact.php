<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - FastBite & Groceries</title>
</head>
<body>
    <section>
        <h2>Contact Us</h2>
        <p>We would love to hear from you! Whether you have a question about our menu, want to give feedback, or need help with an order, feel free to reach out using the form below or through our contact details.</p>

        <h3>Get in Touch</h3>
        <form action="submit_contact.php" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="5" required></textarea><br><br>

            <button type="submit">Send Message</button>
        </form>

        <h3>Our Contact Information</h3>
        <ul>
            <li><strong>Phone:</strong> +1 (123) 456-7890</li>
            <li><strong>Email:</strong> support@fastbitegroceries.com</li>
            <li><strong>Address:</strong> 123 FastBite Street, Food Town, FT 12345</li>
        </ul>

        <h3>Operating Hours</h3>
        <ul>
            <li><strong>Monday - Friday:</strong> 9:00 AM - 10:00 PM</li>
            <li><strong>Saturday:</strong> 10:00 AM - 11:00 PM</li>
            <li><strong>Sunday:</strong> Closed</li>
        </ul>
    </section>
</body>
</html>
