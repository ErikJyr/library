<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Leap Year</title>
</head>
<body>

    <form method="post">
        <label for="year">Enter a year:</label>
        <input type="text" name="year" id="year" required>
        <button type="submit">Check</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $year = $_POST["year"];

        if (!filter_var($year, FILTER_VALIDATE_INT)) {
            echo "<p>Please enter a valid number.</p>";
        } else {
            $year = (int)$year;

            if ($year <= 0) {
                echo "<p>Please enter a positive number.</p>";
            } else {

                if (($year % 400 == 0) || ($year % 4 == 0 && $year % 100 != 0)) {
                    echo "<p>$year is a leap year.</p>";
                } else {
                    echo "<p>$year is not a leap year.</p>";
                }
            }
        }
    }
    ?>

</body>
</html>
