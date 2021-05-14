<!DOCTYPE html>
<html>

<head>
<title> Basketball League Database Application || Selection </title>

<link rel="stylesheet" href="styles/selection_view.css">
<!-- BOOTSTRAP CSS -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
  <div class="" align="center">
    <div class="">

    <!-- TITLE -->
      <h1 class="">SELECTION </h1>


      <!-- MAIN MENU -->
      <a href="index.php" class=""> Go to the main page</a>

      <!-- CONNECTING DATABASE -->
      <?php
              include "config.php";

              $sql_statement = "SHOW TABLES FROM cs306_basketball_project";
              $result = mysqli_query($db, $sql_statement);
        ?>
        <br>
        <br>

        <!-- CHOOSE TABLE DROPDOWN -->
        <div class = "wrapper">
                  <div class = "menu">
                      <form action="selection_view.php" method="POST">
                          <!-- After form submitted, we direct admin to same page which following if will return true -->
                          Select a table:
                          <select name="table_name" onchange="this.form.submit()">
                              <option value="" disabled selected><?php if (isset($_POST['table_name'])) {echo $_POST['table_name'];} else { echo 'Select';}?></option>
                              <?php
                                  if($result) {
                                      while($table = mysqli_fetch_assoc($result)) {
                                          foreach ($table as $key => $value) {
                                              echo "<option value =\"$value\">$value</option>";
                                          }
                                      }
                                  }
                              ?>
                          </select>
                      </form>
                  </div>
              </div>
          </br>

          <!-- After user submitted form -->
          <?php

          if (isset($_POST['table_name'])) {

              $table_name = $_POST['table_name'];
              $sql_statement = "SHOW KEYS FROM ".$table_name." WHERE Key_name = 'PRIMARY'";
              $result = mysqli_query($db, $sql_statement);
              $key_columns=array();
              if($result) {
                  while($table = mysqli_fetch_assoc($result)) {
                      array_push($key_columns, $table["Column_name"]);
                  }
              }

              $sql_statement = "SELECT * FROM $table_name";
              $result = mysqli_query($db, $sql_statement);
              echo "$table_name table <br/><br/>";

              if(!$result or mysqli_num_rows($result) === 0) {
                  echo 'It is empty!';
              } else {
                  echo '<div class="table_view">';
                  $fieldinfo = $result -> fetch_fields();

                  // FILTER BY
                    $fields = "";
                    foreach ($fieldinfo as $val) {
                        $fields .= $val -> name.", ";
                    }
                    $fields = substr($fields,0,-2);

                    echo '<form action="selection_view.php" method="POST">
                    <input type="text" name="valueToFilter" placefolder="Filter table by value"><br><br>
                    <input class="btn btn-primary" type="submit" name="search" value="SEARCH" placefolder="Filter" onclick="this.form.submit()"><br><br>
                    <input type="hidden" name="selected_table" value="'.$table_name.'">
                    <input type="hidden" name="table_attributes" value="('.$fields.')"></form>';

                  // RESULT TABLE
                  echo '<table class="table table-bordered" style="width:'.(count($fieldinfo) * 10).'vw">';
                  echo '<thead>';
                  echo "<tr>";
                  foreach ($fieldinfo as $val) {
                      echo "<th>".$val -> name." </th>";
                  }
                  echo "</tr>";
                  echo '</thead>';

                  echo '<tbody>';
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      foreach ($row as $key => $value) {
                          echo "<td>".$value."</td>";
                      }
                      echo "</form></td></tr>";
                  }
                  echo '</tbody>';
                  echo "</table>";
                  echo '</div>';
              }

          } else if (isset($_POST['search'])) {

              $filterValue = $_POST['valueToFilter'];
              $table_name = $_POST['selected_table'];
              $columns = $_POST['table_attributes'];

              $query = "SELECT * FROM ".$table_name." WHERE CONCAT".$columns."LIKE '%".$filterValue."%'";
              $result = mysqli_query($db, $query);

              if(!$result or mysqli_num_rows($result) === 0) {
                  echo 'No Match!';
              } else {
                  echo "SHOWING RESULTS FOR: ".$filterValue;
                  echo '<div class="table_view">';
                  $fieldinfo = $result -> fetch_fields();
                  echo '<table class="table table-bordered" style="width:'.(count($fieldinfo) * 10).'vw">';
                  echo '<thead>';
                  echo "<tr>";
                  foreach ($fieldinfo as $val) {
                      echo "<th>".$val -> name." </th>";
                  }
                  echo "</tr>";
                  echo '</thead>';
                  echo '<tbody>';
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      foreach ($row as $key => $value) {
                          echo "<td>".$value."</td>";
                      }
                      echo "</form></td></tr>";
                  }
                  echo '</tbody>';
                  echo "</table>";
                  echo '</div>';
              }
          }
      ?>
  </div>
  </div>
</body>
</html>
