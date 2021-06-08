<?php
include_once 'connect.php';

if (isset($_GET['tbname'])) {
  $cur_tb = $_GET['tbname'];

  $result = pg_query($conn,"SELECT column_name from information_schema.columns where information_schema.columns.table_name='" . $cur_tb . "'");
  while($row=pg_fetch_assoc($result)) {
    if ($row['column_name']!="id") {
      $names[] = $row['column_name'];
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
   $query = "UPDATE " . $cur_tb . " SET (" . $comma . ") = ('" . $comma1 . "') WHERE id=" . $_GET['edid'] . "";
 }

  $result = pg_query($query);

echo "<form id=\"foobar\" action =\"lookTable.php?tbname=" . $cur_tb . "\" method=\"post\"></form>
<script>
 setTimeout(function () {
  document.getElementById('foobar').submit();
}, 0);
alert('Запись успешно обновлена');
</script>";
}

?>
