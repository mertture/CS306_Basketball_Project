<?php

$db = mysqli_connect('localhost', 'root', '', 'cs306_basketball_project');

if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error. ']');
}


if (isset($_POST['player_id'])) {

    $player_id = $_POST['player_id'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $birth_date = $_POST['birth_date'];
    $height = $_POST['height'];

    $sql_statement = "INSERT INTO players(player_id, f_name, l_name,
                                  birth_date, height)
                      VALUES ('$player_id', '$f_name', '$l_name', '$birth_date', '$height')";



$result = mysqli_query($db, $sql_statement);
    
echo " My result is" . $result;
}

else {
    echo "The form is not set yet.";
}

?>