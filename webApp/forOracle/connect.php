<?php
global $conn;
$conn = oci_connect('SYS', '1234', 'mynewdb', null, OCI_SYSDBA);

?>
