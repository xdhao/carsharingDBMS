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
        if (isset($_GET['tbname'])&&isset($_GET['edid'])) {
          $cur_tb = $_GET['tbname'];
          $eid = $_GET['edid'];

          // выполнение запроса
          $sql = "SELECT * FROM " . $cur_tb . "";
          $res = OCIParse($conn, $sql);
          oci_execute($res);

          echo "<div class=\"Tbname_andbtn\"><h3>" . $cur_tb . " Add <a href=\"checkTable.php?tbname=" . $cur_tb . "\"><button type=\"button\" class=\"left_arrow\"> Back</button></a></h3></div>";
          echo "<div class=\"cardsbd\">
              <div class=\"card\">
                <div class=\"container\">";
          echo "<form action=\"dbWorkEdit.php?tbname=". $cur_tb ."&edid=" . $eid . "\" method=\"post\">";

          for ($i = 1; $i-1 < oci_num_fields($res); $i++) {
            if (oci_field_name($res,$i)!="ID") {
              $names[] = oci_field_name($res,$i);
            }
          }

          $sql1 = "SELECT * FROM " . $cur_tb . " WHERE id='" . $eid . "'";
          $result1 = OCIParse($conn, $sql1);
          oci_execute($result1);

          while ($row = oci_fetch_row($result1)) {
            for ($i = 1; $i < $fields=count($row); $i++) {
              echo "<p>". $names[$i-1] .": <input type=\"text\" name=\"".  $names[$i-1] ."\" value=\"" . $row[$i] . "\"/></p>";

            }
          }

          echo "<p><button type=\"submit\" class=\"save\"> Save</button></p>
               </form>";
          echo "</div></div></div>";

        }
    ?>
  </body>
</html>
