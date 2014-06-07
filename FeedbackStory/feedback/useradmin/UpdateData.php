<?php

require '../config.php';
mysql_select_db("$database", $con);

  
  $id = $_REQUEST['id'];
  $value = $_REQUEST['value'] ;
  $column = $_REQUEST['columnName'] ;
  $columnPosition = $_REQUEST['columnPosition'] ;
  $columnId = $_REQUEST['columnId'] ;
  $rowId = $_REQUEST['rowId'] ;
 
  
  if ($_REQUEST['columnName'] != 'password') {
$sql = "UPDATE  $utable SET  `{$_REQUEST['columnName']}` =  '{$_REQUEST['value']}'  WHERE `id` = '{$_REQUEST['id']}'"; 
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  echo "Item Has Been Updated.";
}


  if ($_REQUEST['columnName'] == 'password') {
$sql2 = "UPDATE $utable SET `password` = AES_ENCRYPT(".$_REQUEST['value'].",'$pkey')   WHERE `id` = '{$_REQUEST['id']}'"; 
	if (!mysql_query($sql2,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "Item Has Been Updated.";
}

mysql_close($con);

?>

<script type="text/javascript" charset="utf-8">
 window.location.reload();
</script>

