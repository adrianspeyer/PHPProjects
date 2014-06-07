<?php
ob_start();
session_start(); 
require('../db_con.php');
error_reporting(E_ALL ^ E_NOTICE);
mysql_select_db("$database", $con);
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




//redirect to delete all
if (isset($_POST['password'])) 
{
header("Location: ../install/setup6.php");	
exit;
ob_flush(); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Create Super User</title>
      <link rel="STYLESHEET" type="text/css" href="../css/login.css" />
	   <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">	  
</head>
<body>

<div id='loginform'>
<center>
<br>


<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
	<fieldset>
	<legend>Create Super User Feedback Story</legend>
	<input type="hidden" name="fullname" value="Super Admin"/>
	<p><b>Email Address:</b> <input type="text" name="email" size="20" /></p>
	<p><b>Password:</b> <input type="password" name="password" size="20" /></p>
	<div align="center"><input type="submit" name="submit" value="Create" /></div>
	<input type="hidden" name="groupname" value="SuperAdmin"/>
	<input type="hidden" name="created_at" id="created_at"  value="<?php echo $fdate; ?>" />
	<input type="hidden" name="submitted" value="TRUE" />
	</fieldset>
</form>



 </center>
 </div>
</body>