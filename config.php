<?php
$db = mysqli_connect('localhost', 'root', '', 'cs306_basketball_project');

if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error. ']');
}


$attributes = [
    "tid" => "Team ID",
    "player_id" => "Player ID",
    "home_win" => "Home Wins",
    "home_loses" => "Home Loses",
    "away_win" => "Away Wins",
    "away_loses" => "Away Loses",
    "s_year" => "Season",
    "name" => "Team",
    "total_scored" => "Scored Points",
    "standing" => "Standing"
];


?>