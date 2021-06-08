<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/main.css">
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
          <li><a href="main.php">Главная</a></li>
        </ul>
  </div>
<div>
  <h1 style="padding-left : 5px">Базы данных</h1>
  <div class="cardsbd">
    <div class="card">
      <div class="container">
        <h3><b><a href="forOracle/alltables.php">ClientsAndOrders(Oracle)</a></b></h3>
      </div>
    </div>
    <br>
    <!--  -->
    <div class="card">
      <div class="container">
        <h3><b><a href="forPostgre/tables.php">Cars(Postgre)</a></b></h3>
      </div>
    </div>
    <br>
    <!--  -->
    <div class="card">
      <div class="container">
        <h3><b><a href="forMongo/bd.php">GeoInformation(MonogDB)</a></b></h3>
      </div>
    </div>
  </div>
</div>
</body>
</html>
