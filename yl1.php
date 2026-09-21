<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EEK Converter</title>
</head>
<body>

    <form method="post">
        <label for="eek">EEK:</label>
        <input type="number" name="eek" id="eek">
        <button type="submit">Convert</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $a = 15.6466;
        $b = $_POST["eek"];

        $c = (int)$b / $a;
        $d = round($c, 2);

        echo "<p>EUR: $d</p>";
        
    }
    ?>

</body>
</html>

