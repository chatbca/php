<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>

<body>
    <h2>Contact Form</h2>

    <form action="sub_form.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>

#sub_form.php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    echo "<h2>Form Submission Result</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Message:</strong> $message</p>";
} else {

    echo "<p>Access denied.</p>";
}
?>
