<!DOCTYPE html>
<html>
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
<div>
  <h1 style="padding-left : 5px">Cars - таблицы:</h1>
        <?php
        include_once 'connect.php';
        $result = pg_query($conn,"SELECT * FROM information_schema.tables WHERE table_schema = 'public'");

        while($row=pg_fetch_assoc($result)) {
          echo "<div class=\"cardsbd\">
              <div class=\"card\">
                <div class=\"container\">";
          echo "<div class=\"txtbtn\">";
          echo "<div class=\"txt\"><h3><b>" . $row['table_name'] . "</b></h3></div>";
          echo "<a href=\"lookTable.php?tbname=" . $row['table_name'] . "\"><div class=\"btn\"><button type=\"button\" class=\"button1\">check</button></a></div>";
          echo "</div>";
          echo "</div>
              </div>
            </div>";
          echo "<br>";

        }
         ?>
</div>
</body>
</html>
