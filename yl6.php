<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Biggest number</title>
</head>
<body>

    <form method="post">
        <label for="a">Enter 1st num:</label>
        <input type="number" name="a" id="a" step="any" required>
        <br><br>

        <label for="b">Enter 2nd num:</label>
        <input type="number" name="b" id="b" step="any" required>
        <br><br>

        <label for="c">Enter 3rd num:</label>
        <input type="number" name="c" id="c" step="any" required>
        <br><br>

        <button type="submit">Find biggest</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $a = (float)$_POST["a"];
        $b = (float)$_POST["b"];
        $c = (float)$_POST["c"];

        if ($a >= $b && $a >= $c) {
            $biggest = $a;
        } elseif ($b >= $a && $b >= $c) {
            $biggest = $b;
        } else {
            $biggest = $c;
        }

        echo "<p>The biggest number is: $biggest</p>";
    }
    ?>

</body>
</html>

