<?php

require '../config.php';
mysql_select_db("$database", $con);
  session_start();

  $id = $_REQUEST['id'];

  if (isset($_REQUEST['id'])) {
  
  
mysql_query("DELETE FROM `$database`.`$utable` WHERE `id` = '$id' ");
echo (mysql_affected_rows()) ? "Item deleted." : "No item deleted";   
}  

mysql_close($con);

?>
