<?php
class DistanceCalculator {
    public function addDistance($feet1, $inches1, $feet2, $inches2) {
        $totalFeet = $feet1 + $feet2;
        $totalInches = $inches1 + $inches2;
        if ($totalInches>= 12) {
            $totalFeet += floor($totalInches / 12);
            $totalInches %= 12;
        }
        return [$totalFeet, $totalInches];
    }
    public function findDifference($feet1, $inches1, $feet2, $inches2) {
        $totalFeet1 = $feet1 + $inches1 / 12;
        $totalFeet2 = $feet2 + $inches2 / 12;

        $difference = abs($totalFeet1 - $totalFeet2);

        $differenceFeet = floor($difference);
        $differenceInches = ($difference - $differenceFeet) * 12;

        return [$differenceFeet, $differenceInches];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feet1 = $_POST["feet1"];
    $inches1 = $_POST["inches1"];
    $feet2 = $_POST["feet2"];
    $inches2 = $_POST["inches2"];

    $calculator = new DistanceCalculator();

    [$sumFeet, $sumInches] = $calculator->addDistance($feet1, $inches1, $feet2, $inches2);
    echo "Sum: $sumFeet feet $sumInches inches<br>";

    [$diffFeet, $diffInches] = $calculator->findDifference($feet1, $inches1, $feet2, $inches2);
    echo "Difference: $diffFeet feet $diffInches inches";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Distance Calculator</title>
</head>
<body>
<h2>Distance Calculator</h2>
<form action="" method="post">
<label for="feet1">Feet 1:</label>
<input type="number" id="feet1" name="feet1" required>
<label for="inches1">Inches 1:</label>
<input type="number" id="inches1" name="inches1" required><br><br>

<label for="feet2">Feet 2:</label>
<input type="number" id="feet2" name="feet2" required>
<label for="inches2">Inches 2:</label>
<input type="number" id="inches2" name="inches2" required><br><br>

<input type="submit" value="Calculate">
</form>
</body>
</html>
