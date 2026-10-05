<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Circle calculator</title>
</head>
<body>

    <form method="post">
        <label for="radius">Radius:</label>
        <input type="number" name="radius" id="radius" step="0.01" required>
        <button type="submit">Calculate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Set the values and get user input
        $a = 3.14;
        $b = $_POST["radius"];

        // Calculate area
        $c = $a * ((int)$b ** 2);
        $d = round($c, 2);

        echo "<p>AREA: $d</p>";

        // Calculate circumference
        $e = 2 * $a * (int)$b;
        $f = round($e, 2);

        echo "<p>CIRCUMFERENCE: $f</p>"; // Display the circumference in the web page
    }
    ?>

</body>
</html>
