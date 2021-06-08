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
    <?php $cur_tb = $_GET['tbname'];
    echo "<form action=\"funcQuery.php?tbname=" . $cur_tb . "\" method=\"post\">"; ?>
     <h5>LAT</h5>
     <p>Min LAT: <input type="text" name="minlat"></p>
     <p>Max LAT: <input type="text" name="maxlat"></p>
     <h5>LNG</h5>
     <p>Min LNG: <input type="text" name="minlng"></p>
     <p>Max LNG: <input type="text" name="maxlng"></p>
     <p><input type="submit" value="Отправить"></p>
    </form>
  </body>
</html>
