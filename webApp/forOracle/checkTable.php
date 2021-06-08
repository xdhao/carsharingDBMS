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

          echo "<div class=\"Tbname_andbtn\"><h3>" . $cur_tb . " <a href=\"visFormAdd.php?tbname=" . $cur_tb . "\"><button type=\"button\" class=\"add\"> Add</button></a>
          <a href=\"alltables.php\"><button type=\"button\" class=\"left_arrow\"> Back</button></a></div>";

          // выполнение запроса
          $sql = "SELECT * FROM " . $cur_tb . "";
          $res = OCIParse($conn, $sql);
          oci_execute($res);

          //начало отрисовки таблицы
          echo "<div class=\"tablica\"><table class=\"table\">
                <thead><tr>";
                // отрисовка шапки таблицы
                for ($i = 1; $i-1 < oci_num_fields($res); $i++) {
                echo "<th>";
                echo oci_field_name($res,$i);
                echo "</th>";
                }
          echo "<td>DB Work</td>";
          echo "</tr>";
          echo "</thead>";

          // отрисовка и заполнение самой таблицы
          while ($row = oci_fetch_row($res)) {
          echo "<tr>";
          for ($i = 0; $i < $fields=count($row); $i++) {
          echo "<td>".$row[$i]."</td>";
          }
          echo "<td><a href=\"visFormEdit.php?edid=" . $row[0] . "&tbname=" . $cur_tb . "\"><button type=\"button\" class=\"edit\"></button></a>
           <a href=\"deleteFromTable.php?delid=" .  $row[0] . "&tbname=" . $cur_tb . "\"><button type=\"button\" class=\"delete\"></button></a></td>";

          echo "</tr>";
          }
         }
    ?>
    </table>
  </div>
  </body>
</html>
