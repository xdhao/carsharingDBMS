<?php
//This path should point to Composer's autoloader from where your MongoDB library will be loaded
  require '../vendor/autoload.php';
  // when using default settings
    try {
          $mongo = new MongoDB\Client('mongodb://localhost:27017');
    } catch (Exception $e) {
          echo $e->getMessage();
    }

if (isset($_GET['tbname'])&&isset($_GET['delid'])) {
  $cur_tb = $_GET['tbname'];
  $cur_id = $_GET['delid'];

  // ДОБАВЛЕНИЕ НОВОЙ ЗАПИСИ В КОЛЛЕКЦИЮ
$collection = $mongo->test->$cur_tb;
$collection->deleteOne(["_id" => new MongoDB\BSON\ObjectId($cur_id)]);
echo "<form id=\"foobar\" action =\"table.php?tbname=" . $cur_tb . "\" method=\"post\"></form>
<script>
 setTimeout(function () {
  document.getElementById('foobar').submit();
}, 0);
alert('Запись успешно удалена');
</script>";
}

?>
