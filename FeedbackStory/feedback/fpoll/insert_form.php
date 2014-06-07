<?php
ob_start();
require '../config.php';
mysql_select_db("$database", $con);
  
/* Comment if you want to restrict by once IP*/
//check if IP already voted

if ($iprestrict == '1'){
$ipcheck = mysql_query("SELECT `loggedip`, `updated_at` FROM  `$database`.`$table` WHERE `updated_at` > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
while($row = mysql_fetch_array($ipcheck)){
$ipexist = $row['loggedip'];
$cip =  $_POST['loggedip'];
if ($ipexist = $cip)
{
echo header("Location: ./repeatthanks.php");
exit;
}}}



if (isset($_POST['getbetter'])) {
$getbetter = preg_replace('#[^\w()/.%\-&]#'," ",$_POST['getbetter']);
$objective = preg_replace('#[^\w()/.%\-&]#'," ",$_POST['objective']);


$sql="INSERT INTO $table (id,happy,success,objective,getbetter,page,loggedip,updated_at)
VALUES
	(NULL,'$_POST[happy]', 
    '$_POST[success]','$objective', 
	'$getbetter','$_POST[page]',
	'$_POST[loggedip]',NULL)";


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "";
}



	
#  if the user submitted a country
if (isset($_POST['loggedip'])) 
{
   $sql2 = "INSERT INTO $iptable (id,country,loggedip,updated_at)
VALUES
	(NULL,'$_POST[country]', 
	'$_POST[loggedip]',NULL)";
	if (!mysql_query($sql2,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "";
}


$_SESSION['objective']= $_POST['objective'];
$_SESSION['getbetter'] = $_POST['getbetter'];
$_SESSION['loggedip'] = $_POST['loggedip'];


mysql_close($con);

echo header("Location: thanks.php");
exit;
ob_flush();
?>