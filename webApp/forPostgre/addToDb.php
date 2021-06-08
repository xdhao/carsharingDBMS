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

  $query = "INSERT INTO " . $cur_tb . " (" . $comma . ") values('" . $comma1 . "')";
  $result = pg_query($query);

echo "<form id=\"foobar\" action =\"lookTable.php?tbname=" . $cur_tb . "\" method=\"post\"></form>
<script>
 setTimeout(function () {
  document.getElementById('foobar').submit();
}, 0);
alert('Запись успешно добавлена');
</script>";
}

?>
