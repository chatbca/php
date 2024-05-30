<?php 
    session_start();  
        if (isset($_SESSION['username'])) { 
        header("Location: welcome.php"); 
        exit(); 
    } 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $username = $_POST["username"]; 
        $password = $_POST["password"]; 
       
        if ($username === "user" && $password === "1234") {  
            $_SESSION['username'] = $username;            
            header("Location: welcome.php"); 
            exit(); 
        } else { 
            $error_message = "Invalid username or password. Please try again."; 
        } 
    } 
?>

<!DOCTYPE html> 
<html lang="en"> 
<head>  
    <title>Login</title> 
</head> 
<body> 
    <h2>Login</h2> 
    <form action="" method="post"> 
        <label for="username">Username:</label> <br> 
        <input type="text" id="username" name="username" required> <br><br> 
        <label for="password">Password:</label> <br> 
        <input type="password" id="password" name="password" required> <br><br> 
        <input type="submit" value="Login"> <br> 
         
    </form> 
</body> 
</html> 


#WELCOME>PHP

<?php 
    session_start(); 
    if (!isset($_SESSION['username'])) { 
        header("Location: index.php"); 
        exit(); 
    } 
    
    if (isset($_GET['logout']) && $_GET['logout'] == 1) { 
        $_SESSION = array(); 
        session_destroy();  
        header("Location: index.php"); 
        exit(); 
    } 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <title>Welcome</title> 
</head> 
<body> 
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2> <br> 
    <p>This is a secured area. You are logged in.</p> <br> 
    <a href="welcome.php?logout=1">Logout</a>
</body> 
</html>
