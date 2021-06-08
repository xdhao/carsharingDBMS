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
          $result = pg_query($conn,"SELECT column_name from information_schema.columns where information_schema.columns.table_name='" . $cur_tb . "'");

          echo "<div class=\"Tbname_andbtn\"><h3>" . $cur_tb . " Add <a href=\"lookTable.php?tbname=" . $cur_tb . "\"><button type=\"button\" class=\"left_arrow\"> Back</button></a></h3></div>";
          echo "<div class=\"cardsbd\">
              <div class=\"card\">
                <div class=\"container\">";
          echo "<form action=\"addToDb.php?tbname=". $cur_tb ."\" method=\"post\">";

          while($row=pg_fetch_assoc($result)) {
            if ($row['column_name']!="id") {
              echo "<p>". $row['column_name'] .": <input type=\"text\" name=\"". $row['column_name'] ."\" /></p>";
            }

          }

          echo "<p><button type=\"submit\" class=\"save\"> Save</button></p>
               </form>";
          echo "</div></div></div>";

        }
    ?>
  </body>
</html>
