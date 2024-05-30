<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Simple Calculator</title> 
</head> 
<body> 
    <h2>PHP Calculator</h2> 
    <form action="" method="post"> 
        <input type="text" id="num1" name="num1" pattern="[0-9]+" title="Please enter a valid number" placeholder="Enter the first number" value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>" required> 
        <select id="operation" name="operation" required> 
            <option value="add">+</option> 
            <option value="subtract">-</option> 
            <option value="multiply">*</option> 
            <option value="divide">/</option> 
        </select> 
        <input type="text" id="num2" name="num2" pattern="[0-9]+" title="Please enter a valid number" placeholder="Enter the second number" value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>" required> 
        <input type="submit" value="Calculate"> 
    </form> 
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $num1 = $_POST["num1"]; 
            $num2 = $_POST["num2"]; 
            $operation = $_POST["operation"]; 
            
            if (!is_numeric($num1) || !is_numeric($num2)) { 
                echo "<p style='color: red;'>Please enter valid numbers.</p>"; 
            } else { 
            
            switch ($operation) { 
                case "add": 
                    $result = $num1 + $num2; 
                    break; 
                case "subtract": 
                    $result = $num1 - $num2; 
                    break; 
                case "multiply": 
                    $result = $num1 * $num2; 
                    break; 
                case "divide": 
                
                    if ($num2 == 0) { 
                        echo "<p style='color: red;'>Error: Division by zero is not allowed.</p>"; 
                    } else { 
                        $result = $num1 / $num2; 
                    } 
                    break; 
                default:
                echo "<p style='color: red;'>Invalid operation selected.</p>"; 
                break; 
            } 
            
            if (isset($result)) { 
                echo "<p>Result: $result</p>"; 
            } 
            } 
        } 
    ?> 
</body> 
</html>
