<!DOCTYPE html>
<html>
<head>
    <title>Dictionary</title>
</head>
<body>
    <h1>Dictionary</h1>
    <form method="post" action="">
        <label for="word">Enter a word:</label>
        <input type="text" id="word" name="word" required>
        <input type="submit" name="submit" value="Search">
    </form>
    <?php
        $dictionary = array("apple" => "a round fruit with red or green skin and a whitish interior",
        "computer" => "an electronic device for storing and processing data",
        "book" => "a written or printed work consisting of pages glued or sewn together",
        "sun" => "the star around which the Earth orbits",
        "ocean" => "a large body of salt water that covers most of the Earth's surface",
        "mountain" => "a large natural elevation of the Earth's surface rising abruptly from the surrounding level",
        "flower" => "the seed-bearing part of a plant, consisting of reproductive organs",
        "music" => "vocal or instrumental sounds combined in such a way as to produce beauty of form, harmony, and expression of emotion",
        "friend" => "a person whom one knows and with whom one has a bond of mutual affection",
        "dream" => "a series of thoughts, images, and sensations occurring in a person's mind during sleep"
        );
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search_word = $_POST["word"];
            if (array_key_exists($search_word, $dictionary)) {
                echo "<p><strong>Meaning of \"$search_word\":</strong> " . $dictionary[$search_word] . 
                "</p>";
            } else {
                echo "<p><strong>$search_word Word not found.</strong></p>";
            }
        }
    ?>
</body>
</html>
