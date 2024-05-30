\<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "feedback_db";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO feedback (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Feedback Submitted successfully');</script>";
    } else {
        echo "<script>alert('Failed to submit feedback');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
</head>
<body>
    <h2>Feedback Form</h2>
    <form action="" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="subject">Subject:</label><br>
        <input type="text" id="subject" name="subject" required><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <br>
    <a href="review_feedback.php">Review Feedback</a>
</body>
</html>
----review.php------
<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "feedback_db";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Feedback</title>
</head>
<body>
    <h2>Review Feedback</h2>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
            echo "<td>" . htmlspecialchars($row['message']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No feedback available.";
    }
    ?>
    <br>
    <a href="index.php">Back to Feedback Form</a>
</body>
</html>
