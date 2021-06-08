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
  <h1 style="padding-left : 5px">GeoInformation - таблицы:</h1>
        <?php
        //This path should point to Composer's autoloader from where your MongoDB library will be loaded
          require '../vendor/autoload.php';
          // when using default settings
            try {
                  $mongo = new MongoDB\Client('mongodb://localhost:27017');
            } catch (Exception $e) {
                  echo $e->getMessage();
            }
            $db = $mongo->test;
            foreach ($db->listCollections() as $item) {
              echo "<div class=\"cardsbd\">
                  <div class=\"card\">
                    <div class=\"container\">";
              echo "<div class=\"txtbtn\">";
              echo "<div class=\"txt\"><h3><b>" . $item['name'] . "</b></h3></div>";
              echo "<a href=\"table.php?tbname=" . $item['name'] . "\"><div class=\"btn\"><button type=\"button\" class=\"button1\">check</button></a></div>";
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
