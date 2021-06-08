<?php
include_once 'connect.php';
if (isset($_GET['tbname'])&&isset($_GET['delid'])) {
$cur_tb = $_GET['tbname'];
$did = $_GET['delid'];
$query = "DELETE FROM $cur_tb WHERE id='" . $did . "'";
$res = OCIParse($conn, $query);
oci_execute($res);

echo "<form id=\"foobar\" action =\"checkTable.php?tbname=" . $cur_tb . "\" method=\"post\"></form>
<script>
 setTimeout(function () {
  document.getElementById('foobar').submit();
}, 0);
alert('Запись успешно удалена');
</script>";

}
?>
