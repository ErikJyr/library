<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Circle calculator</title>
</head>
<body>

    <form method="post">
        <label for="raadius">RAADIUS:</label>
        <input type="number" name="raadius" id="raadius" step="1" required>
        <button type="submit">Arvuta</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $a = 3.14;
        $b = $_POST["raadius"];

        // Pindala
        $c = $a * ((int)$b ** 2);
        $d = round($c, 2);

        echo "<p>PINDALA: $d</p>";

        // Ümbermõõt
        $e = 2 * $a * (int)$b;
        $f = round($e, 2);

        echo "<p>ÜMBERMÕÕT: $f</p>";
    }
    ?>

</body>
</html>
