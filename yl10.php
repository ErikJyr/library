<!DOCTYPE html>
<html lang="en">
<body>

<form method="post">

    <label>Name:</label>
    <input type="text" name="name" required>
    <br><br>

    <label>Do you live at Saaremaa?</label>
    <select name="answer">
        <option value="y">Yes</option>
        <option value="n">No</option>
    </select>
    <br><br>

    <label>Age:</label>
    <input type="number" name="age" min="0">
    <br><br>

    <button type="submit">Submit</button>

</form>

<?php

if ($_POST) {

    $name = $_POST["name"];
    $answer = strtolower($_POST["answer"]);
    $age = (int)$_POST["age"];

    echo "Hello, $name!<br>";

    if ($answer == "y" || $answer == "yes") {

        echo "Tere kõgile saarlastele!<br>";

        if ($age < 18) {
            echo "Did you know that you aren't old enough to drive?";
        } else {
            echo "Did you know that you are old enough to drive?";
        }

    } elseif ($answer == "n" || $answer == "no") {

        echo "";

    } else {

        echo "Unrecognized response";

    }
}

?>

</body>
</html>

