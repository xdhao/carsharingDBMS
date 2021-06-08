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
    //This path should point to Composer's autoloader from where your MongoDB library will be loaded
      require '../vendor/autoload.php';
      // when using default settings
        try {
              $mongo = new MongoDB\Client('mongodb://localhost:27017');
        } catch (Exception $e) {
              echo $e->getMessage();
        }
        if (isset($_GET['tbname'])) {
          $cur_tb = $_GET['tbname'];

          //выбираем коллекцию
          $collection = $mongo->test->$cur_tb;
          echo "<div class=\"Tbname_andbtn\"><h3>" . $cur_tb . " Add <a href=\"table.php?tbname=" . $cur_tb . "\"><button type=\"button\" class=\"left_arrow\"> Back</button></a></h3></div>";
          echo "<div class=\"cardsbd\">
              <div class=\"card\">
                <div class=\"container\">";
          $cursor = $collection->find();
          $array = iterator_to_array($cursor);
          $limit = 0;
          echo "<form action=\"dbAddDoc.php?tbname=". $cur_tb ."\" method=\"post\">";
          foreach ($array as $k => $v) {
            foreach ($v as $a => $b) {
              if ($limit<1) {
                if ($a!="_id") {
                  echo "<p>". $a .": <input type=\"text\" name=\"". $a ."\" /></p>";
                }
              }
            }
            $limit=1;
          }
          echo "<p><button type=\"submit\" class=\"save\"> Save</button></p>
               </form>";
          echo "</div></div></div>";

        }
    ?>
  </body>
</html>
