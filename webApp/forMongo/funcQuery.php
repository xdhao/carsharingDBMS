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
<?php
 require '../vendor/autoload.php';
        try {
              $mongo = new MongoDB\Client('mongodb://localhost:27017');
        } catch (Exception $e) {
              echo $e->getMessage();
        }
$cur_tb = $_GET['tbname'];
$collection = $mongo->test->$cur_tb;
$tbQuery = array(
  'lat' => array(
    '$gt' => (integer) $_POST['minlat'],
    '$lt' => (integer) $_POST['maxlat']
  ),
  'lng' => array(
    '$gt' => (integer) $_POST['minlng'],
    '$lt' => (integer) $_POST['maxlng']
  ),
);
          $cursor = $collection->find($tbQuery);
		  $array = iterator_to_array($cursor);
          $limit = 0;
          //название полей документа
          echo "<div class=\"tablica\"><table class=\"table\">
                <thead><tr>";
          foreach ($array as $k => $v) {
            foreach ($v as $a => $b) {
              if ($limit<1) {
                echo "<th>" . $a . "</th>";
              }
            }
            $limit=1;
          }
          echo "</tr>";
          echo "</thead>";

          //значения полей документа
          foreach ($array as $k => $v) {
            echo "<tr>";
            foreach ($v as $a => $b) {
              echo "<td>" . $b . "</td>";
            }
            echo "</tr>";
          }

?>
    </table>
  </div>
  </body>
</html>
