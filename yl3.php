<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>X+XX+XXX</title>
</head>
<body>

    <form method="post">
        <label for="arv">1-9:</label>
        <input type="number" name="arv" id="arv" min="1" max="9" required>
        <button type="submit">Arvuta</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $a = $_POST["arv"];

        $b = (int)$a * 11;
        $c = (int)$a * 111;
        $d = (int)$a + $b + $c;

        echo "<p>Vastus: $d</p>";
    }
    ?>

</body>
</html>

