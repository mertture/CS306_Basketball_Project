<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div align="center">
    <b> Welcome to Basketball League Database Application </b>
    <br> <br>
    Fill the information to insert into Players table.
    <br><br><br>
    <a href="index.php"> Go to the main page</a>
</div>

<div align="center">
    <form align="center" action="insertiondb.php" method="POST">
        <input type="text" name="player_id" placeholder="Type player id"><br><br>
        <input type="text" name="f_name" placeholder="Type player's firstname"><br><br>
        <input type="text" name="l_name" placeholder="Type player's lastname"><br><br>
        <input type="date" name="birth_date" placeholder="Type player's birth date"><br><br>
        <input type="number" name="height" placeholder="Type player's height'"><br><br>
        <button> Insert </button>
    </form>
</div>

<div align="center">
    <form align="center" action="insertiondb.php" method="POST">
        <input type="text" name="player_id" placeholder="Type player id"><br><br>
        <input type="text" name="f_name" placeholder="Type player's firstname"><br><br>
        <input type="text" name="l_name" placeholder="Type player's lastname"><br><br>
        <input type="date" name="birth_date" placeholder="Type player's birth date"><br><br>
        <input type="number" name="height" placeholder="Type player's height'"><br><br>
        <button> Insert </button>
    </form>
</div>


</body>
</html>