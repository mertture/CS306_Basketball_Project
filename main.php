<!DOCTYPE html>
<html>

<head>
<title> Basketball League Database Application </title>

<link rel="stylesheet" href="styles/selection_view.css">
<!-- BOOTSTRAP CSS -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style> 
thead {
    border-bottom: 1px solid rgba( 0, 0, 0, 0.30 );
    box-sizing: border-box;
    display: table-header-group;
    vertical-align: middle;
    border-color: inherit;
    border-collapse: separate;
    border-spacing: 0;
    font-family: MorganSansRegular,Arial;
    font-size: 16px;
    font-weight: 100;
}
hr {
    display: block;
    unicode-bidi: isolate;
    margin-block-start: 0.5em;
    margin-block-end: 0.5em;
    margin-inline-start: auto;
    margin-inline-end: auto;
}
hr.section-title {
    overflow: visible;
    padding: 0;
    border: none;
    color: #000;
    text-align: center;
    height: 2px;
    background-image: linear-gradient(to right,rgba(0,0,0,0),rgba(0,0,0,.5),rgba(0,0,0,0));
}
#teams_id td {
  padding: 16px;
  text-align:center;
}

#teams_h_id td {
  padding-bottom :8px;
  text-align:center;
  font-weight: bold;
}

td > a:first-child {
  text-decoration: none;
  color: inherit;
  display: inline-block;     
   position: relative;    
   z-index: 1;     
   padding: 1.5em;     
   margin: -2em; 
}
a {
  color: #5165ff;
}


#teams_id:hover,
focus-within {
  background: #f2f3ff;
  outline: none;
}
</style>
</head>

<body>
  <div class="dashboard" align="center">
    <div class="header">

    <!-- TITLE -->
      <h1 class="title"> Basketball App </h1>

    </div>
      <ul style ="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);">
        <li><a class="active" href="#home">Home</a></li>
        <li><a href="#news">Teams</a></li>
        <li><a href="#contact">Players</a></li>
        <li><a href="#about">Games</a></li>
      </ul>

    <div class ="row p-2">
      <div class ="col-12 mt2">
          <h1> TEAM STANDINGS </h1>
          <hr class ="section-title">
            <br>
          </hr>
      </div>
    </div>
    


    <div class = "col-12">
          <?php
        include 'config.php';
        $sql_statement = "SELECT * FROM team_stats ORDER BY standing";
        $result = mysqli_query($db, $sql_statement);
        $fieldinfo = $result -> fetch_fields();
                    
        echo '<table style="width:' .(count($fieldinfo) * 9).'vw"> ';
        echo "<thead id ='teams_h_id'>";
        foreach ($fieldinfo as $val) {
          if ($val->name != "tid") {
            echo "<td> ".$attributes[$val -> name]. "</td>";
          }
          if ($val->name == "tid") {
            echo "<td> "."Team". "</td>";
          }
        }
        echo "<td >"."Points"."</td>";
        echo "</thead>";
        while ($row = mysqli_fetch_assoc($result)) { 
          
          echo "<tr id='teams_id'> ";
            foreach ($row as $key => $value) {
              if ($key == "standing") {
                echo "<td style='background-color: #ebebeb; width: 20px;'><a style='color: #008b96;' href='#'>".$value."</a></td>";
              }

              else {
              if ($key != "tid") {
                echo "<td><a href='#'>".$value."</a></td>";
              }
            }
                if ($key == "tid") {

                  $sql_statementTeam = "SELECT teams.name FROM teams, team_stats WHERE $value=teams.tid;";
                  $resultTeam = mysqli_query($db, $sql_statementTeam);
                  $fieldinfoTeam = $resultTeam -> fetch_fields();
                  
                  $rowTeam = mysqli_fetch_assoc($resultTeam);
                    
                    foreach ($rowTeam as $keyTeam => $valueTeam) {
                      if ($keyTeam == "name") {
                      echo "<td><a href='#'>".$valueTeam."</a></td>";
                      }
                    }
                  
                }
                if($key == "total_scored") {
                  echo "<td><a href='#'>".(($row['home_win']+$row['away_win'])*2 + ($row['away_loses']+$row['home_loses']))."</a></td>";
                }
              }
              
            echo "</tr>";
            
        }
        echo "</table>";
      
      ?>
    </div>
  </div>


  


</body>
</html>
