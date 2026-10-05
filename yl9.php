<!DOCTYPE html>
<html lang="en">
<body>

<form method="post">
    <input type="number" name="a" step="any" placeholder="Side 1" required>
    <input type="number" name="b" step="any" placeholder="Side 2" required>
    <input type="number" name="c" step="any" placeholder="Side 3" required>
    <button type="submit">Check</button>
</form>

<?php

if ($_POST) {

    $a = (float)$_POST["a"];
    $b = (float)$_POST["b"];
    $c = (float)$_POST["c"];

    if ($a + $b <= $c || $a + $c <= $b || $b + $c <= $a) {
        echo "The triangle cannot exist.";
    }
    elseif ($a == $b && $b == $c) {
        echo "The triangle is equilateral.";
    }
    elseif ($a == $b || $a == $c || $b == $c) {
        echo "The triangle is isosceles.";
    }
    else {
        echo "The triangle is scalene.";
    }
}

?>

</body>
</html>


<br>    
<b>Equilateral all 3 sides are equal</b> 
<br>
<b>Isosceles 2 sides are equal</b> 
<br>
<b>Scalene all 3 sides are different</b>
<br>


