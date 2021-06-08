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

  $query = "INSERT INTO " . $cur_tb . " (" . $comma . ") values('" . $comma1 . "')";
  $result = OCIParse($conn, $query);
  oci_execute($result);

echo "<form id=\"foobar\" action =\"checkTable.php?tbname=" . $cur_tb . "\" method=\"post\"></form>
<script>
 setTimeout(function () {
  document.getElementById('foobar').submit();
}, 0);
alert('Запись успешно добавлена');
</script>";
}

?>
