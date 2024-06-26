<!DOCTYPE html>
<html>
<head>
<title>Word Frequency Counter</title>
</head>
<body>
<h2>Word Frequency Counter</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Enter a string: <input type="text" name="input_string" required>
<br><br>
<input type="submit" name="submit" value="Count Words">
</form>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function sanitizeInput($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $input_string = sanitizeInput($_POST["input_string"]);
        $word_array = str_word_count(strtolower($input_string), 1);
        $word_count = array_count_values($word_array);
        arsort($word_count);
        echo "<h3>Word Frequency:</h3>";
        foreach ($word_count as $word => $count) {
            echo "$word : $count<br>";
        }
        echo "<h3>Most Used Word:</h3>";
        reset($word_count);
        $most_used_word = key($word_count);
        echo "$most_used_word : " . current($word_count) . "<br>";

        echo "<h3>Least Used Word:</h3>";
        end($word_count);
        $least_used_word = key($word_count);
        echo "$least_used_word : " . current($word_count) . "<br>";
    }
    ?>
</body>
