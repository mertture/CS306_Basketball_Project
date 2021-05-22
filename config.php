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
    "standing" => "Standing",
    "f_name" => "First Name",
    "l_name" => "Last Name",
    "birth_date" => "Birth Day",
    "height" => "Height",
    "game_id" => "Game ID",
    "place" => "Place",
    "home_score" => "Home Score",
    "away_score" => "Away Score",
    "home_id" => "Home ID",
    "away_id" => "Away ID",
    "game_date" => "Game Date",
    "home_name" => "Home Name",
    "away_name" => "Away Name",
    "start_date" => "Start Date",
    "end_date" => "End Date"

];


?>