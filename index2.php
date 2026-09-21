<?php

$user =$_GET['user'];
$location =$_GET['location'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello, pls fill out this form</h1>
    
    <form action="index.php" method="get"> <br>
        <label for="name">Name:</label> <br>
        <input type="text" name="user"/> <br> <br>
        <label for="location">Location:</label> <br>
        <input type="text" name="location"/> <br> <br>
        <input type="submit" value="Submit"> <br> <br>
    </form>
        <b>Hello <?= $user ?>, you are from <?= $location; ?>.</b>
</body>
</html>