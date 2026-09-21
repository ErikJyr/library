<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>odd or even</title>
</head>
<body>

    <form method="post">
        <label for="n">Enter number:</label>
        <input type="text" name="n" id="n" required>
        <button type="submit">Check</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $n = $_POST["n"];

        if (!is_numeric($n) || (int)$n != $n) {
            echo "<p>Please enter a valid integer.</p>";
        } else {
            $n = (int)$n;

            if ($n % 2 == 0) {
                echo "<p>The number is even.</p>";
            } else {
                echo "<p>The number sure looks odd.</p>";
            }
        }
    }
    ?>

</body>
</html>
