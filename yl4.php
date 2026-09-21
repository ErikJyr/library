<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Smaller number</title>
</head>
<body>

    <form method="post">
        <label for="num1">Enter first number:</label>
        <input type="number" name="num1" id="num1" step="any" required>
        <br><br>

        <label for="num2">Enter second number:</label>
        <input type="number" name="num2" id="num2" step="any" required>
        <br><br>

        <button type="submit">Compare</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $num1 = (float)$_POST["num1"];
        $num2 = (float)$_POST["num2"];

        if ($num1 < $num2) {
            $num3 = $num1;
        } else {
            $num3 = $num2;
        }

        echo "<p>The smaller number is: $num3</p>";
    }
    ?>

</body>
</html>