<?php
include_once 'connect.php';

if (isset($_GET['tbname'])) {
  $cur_tb = $_GET['tbname'];

  // выполнение запроса
  $sql = "SELECT * FROM " . $cur_tb . "";
  $res = OCIParse($conn, $sql);
  oci_execute($res);


  for ($i = 1; $i-1 < oci_num_fields($res); $i++) {
    if (oci_field_name($res,$i)!="ID") {
      $names[] = oci_field_name($res,$i);
    }
  }

  $comma = implode(",", $names);
  $comma1 = implode("','", $_POST);

  //если 1 поле
  if (count($names)==1) {
    $query = "UPDATE " . $cur_tb . " SET " . $comma . " = '" . $comma1 . "' WHERE id=" . $_GET['edid'] . "";
  }

 //если полей больше 1
 if (count($names)>1) {
   $query = "UPDATE " . $cur_tb . " SET (" . $comma . ") = (SELECT '" . $comma1 . "' FROM dual) WHERE id=" . $_GET['edid'] . "";
 }

 $result = OCIParse($conn, $query);
 oci_execute($result);

echo "<form id=\"foobar\" action =\"checkTable.php?tbname=" . $cur_tb . "\" method=\"post\"></form>
<script>
 setTimeout(function () {
  document.getElementById('foobar').submit();
}, 0);
alert('Запись успешно обновлена');
</script>";
 }

?>
