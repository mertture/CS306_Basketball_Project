<html>
    <head>
        <title>All Matches</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    

    </head>
    <body>
        <?php
            include "config.php";   
        ?>
        
        <div class="container">

            <div class="row p-2 title">
                <div class="col-12 mt-2">
                    <h1 class="custom-font-bold text-center mb-0">
                        GAMES                    
                    </h1>
                    <hr class="section-title">
                </div>
            </div>


            <div class="row text-center m-0 p-1 align-items-center filters">
                <form action='games.php' method='POST'>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                        <label for="col">Select Team</label>
                        <select id="team" name="team" class="form-control">
                            <?php
                            $sql_statement = "SELECT * FROM teams";
                            $result = mysqli_query($db, $sql_statement);
                            echo "<option name =\"team_id\" value=\"\" disabled selected></option>";

                            while ($row = mysqli_fetch_assoc($result)) { 
                                echo "<option name =\"team_id\" value=".$row["tid"].">".$row["name"]."</option>";
                            }

                            ?>
                        </select>
                        </div>
                        <div class="form-group col-sm-4">
                        <label for="start">Games Since</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="form-group col-sm-4">
                        <label for="end">Games Till</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary" style="margin-right:19px">Filter</button>
                        <form action='games.php' method='POST'>
                            <button type="submit" class="btn btn-primary">Clear Filters</button>
                        </form>
                    </div>
                </form>
            </div>
            <hr class="section-title">


            <div class="row text-center m-0 p-1 align-items-center bg-c-league">
            <?php
                $sql_statement = "SELECT games.game_id, games.game_date, t1.name AS home_name, games.home_score, games.away_score, t2.name as away_name, games.place
                    FROM games
                    LEFT JOIN teams AS t1
                    ON games.home_id = t1.tid
                    LEFT JOIN teams AS t2
                    ON games.away_id = t2.tid";
                

                $conditions = array();
                
                if (isset($_POST['team']) && $_POST['team']!=="") {
                    $team = '"'.$_POST['team'].'"';
                    array_push($conditions, "(t1.tid=$team OR t2.tid=$team)");
                }
                if (isset($_POST['start_date']) && $_POST['start_date']!=="") {
                    $start_date = '"'.$_POST['start_date'].'"';
                    array_push($conditions, "(games.game_date>=$start_date)");
                }
                if (isset($_POST['end_date']) && $_POST['end_date']!=="") {
                    $end_date = '"'.$_POST['end_date'].'"';
                    array_push($conditions, "(games.game_date=<$end_date)");
                }

                if(count($conditions)!==0) {
                    $where = " WHERE ".implode(" AND ", $conditions);
                    $sql_statement = $sql_statement.$where;
                }
                
                $result = mysqli_query($db, $sql_statement);


                if(!$result or mysqli_num_rows($result) === 0) {
                    echo 'It is empty!';
                }

                else {
                    $fieldinfo = $result -> fetch_fields();
                }
            ?>


            <table class="table table-striped">
                <thead>
                    <tr>
                    <?php
                        foreach ($fieldinfo as $val) {
                            echo "<th scope='col'>".$attributes[$val -> name]." </td>";
                        }
                    ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) { 
                            echo "<tr>";
                            foreach ($row as $key => $value) {
                                echo "<td>".$value."</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
            
                </tbody>
            </table>

        </div>

        
    </body>
</html>

<?php

// include "display_table.php";
?>