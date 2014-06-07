
<?php
require '../config.php';
mysql_select_db("$database", $con);
  session_start();
    
	
#  if the user submitted a fullname
if (isset($_POST['fullname'])) 
{
   $sql = "INSERT IGNORE INTO $utable (id,fullname,email,groupname,created_at,updated_at)
VALUES
	(NULL,'$_POST[fullname]', '$_POST[email]', '$_POST[groupname]',
	'$_POST[created_at]',NULL)";
	
	
	if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "";
}


$sql2 = "UPDATE $utable SET `password` = AES_ENCRYPT('$_POST[password]','$pkey')   WHERE `email` = '$_POST[email]'"; 
	if (!mysql_query($sql2,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "";


mysql_close($con);



?>

