<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/table.css">
  <title>Carsharing Admin Panel</title>
</head>
  <body>
    <div class="shp">
      <ul id="navbar">
            <a href="#" style="padding: 6px; width: 300px; color: #000000; float: left; text-decoration: none; text-align: center;">Carsharing Admin Panel</a>
            <li><a href="#">Базы</a>
              <ul>
                <li><a href="#">БД 1</a></li>
                <li><a href="#">БД 2</a></li>
                <li><a href="#">БД 3</a></li>
              </ul>
            </li>
            <li><a href="../main.php">Главная</a></li>
          </ul>
    </div>
    <!-- ЗАПОЛНЕНИЕ ТАБЛИЦЫ ДАННЫМИ ИЗ БД -->
    <?php
    include_once 'connect.php';
        if (isset($_GET['tbname'])) {
          $cur_tb = $_GET['tbname'];

          echo "<div class=\"Tbname_andbtn\"><h3>" . $cur_tb . " <a href=\"formForAdd.php?tbname=" . $cur_tb . "\"><button type=\"button\" class=\"add\"> Add</button></a>
          <a href=\"tables.php\"><button type=\"button\" class=\"left_arrow\"> Back</button></a></div>";


          //название колонок
          $result = pg_query($conn,"SELECT column_name from information_schema.columns where information_schema.columns.table_name='" . $cur_tb . "'");

          echo "<div class=\"tablica\"><table class=\"table\">
                <thead><tr>";
          while($row=pg_fetch_assoc($result)) {
            echo "<th>" . $row['column_name'] . "</th>";
            $names[] = $row['column_name'];
          }
          echo "<td>DB Work</td>";
          echo "</tr>";
          echo "</thead>";

          //значения полей
          $result1 = pg_query("SELECT * FROM " . $cur_tb . "");
          while($row=pg_fetch_assoc($result1)) {
            echo "<tr>";
            foreach ($names as $v) {
                echo "<td>" . $row[$v] . "</td>";
            }
            echo "<td><a href=\"formForEdit.php?edid=" . $row['id'] . "&tbname=" . $cur_tb . "\"><button type=\"button\" class=\"edit\"></button></a>
             <a href=\"deleteOne.php?delid=" .  $row['id'] . "&tbname=" . $cur_tb . "\"><button type=\"button\" class=\"delete\"></button></a></td>";
            echo "</tr>";
          }
         }
    ?>
    </table>
  </div>
  </body>
</html>
