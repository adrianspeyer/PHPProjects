<?php

if (isset($_POST["Submit"])) {
$connect= '<?php
$dbhost = "'. $_POST["dbhost"]. '";
$dbuname = "'. $_POST["dbuname"]. '";
$dbpass = "'. $_POST["dbpass"]. '";
$database  = "'. $_POST["dbname"]. '";
$prefix = "'. $_POST["prefix"]. '";

$table  = $prefix."results";
$iptable  =$prefix."ipcountry";
$impression  =$prefix."impression";
$blanks =$prefix."emptyfields";
$utable =$prefix."user";
$gtable =$prefix."group";
$setable =$prefix."settings";

$pkey = "'. $_POST["pkey"]. '"; 

$tz =  "'. $_POST["tz"]. '";

$domain= "'. $_POST["domain"]. '";
$adminemail = "nospampleze@gmail.com"; 
 
$con = mysql_connect($dbhost,$dbuname,$dbpass)
 or die("Unable to connect to MySQL");
 
//no modificationn needed on the below////
$dd = date(\'Y-m-d g:i:s\');
$date = new DateTime($dd, new DateTimeZone($tz));
$fdate = date("Y-m-d g:i:s", $date->format(\'U\')); 
?>
';


$adminfolder = '../';
$configure =  'db_con.php';

$configfile = $adminfolder."/".$configure;

$fp = fopen($configfile, "w");
fwrite($fp, $connect);
fclose($fp);
}

///////////////////
if (isset($_POST["dbhost"])) {
$sqlconnect= '<?php 
$dbhost = "'. $_POST["dbhost"]. '";
$dbuname = "'. $_POST["dbuname"]. '";
$dbpass = "'. $_POST["dbpass"]. '";
$database  = "'. $_POST["dbname"]. '";
$prefix = "'. $_POST["prefix"]. '";

$table  = $prefix."results";
$iptable  =$prefix."ipcountry";
$impression  =$prefix."impression";
$blanks =$prefix."emptyfields";
$utable =$prefix."user";
$gtable =$prefix."group";
$setable =$prefix."settings";
 
$domain= "'. $_POST["domain"]. '";

$con = mysql_connect($dbhost,$dbuname,$dbpass)
 or die("Unable to connect to MySQL");

?>';


$sqfp = fopen('installsql'.'.php', "w");
fwrite($sqfp, $sqlconnect);
fclose($sqfp);
}


echo header("Location: ../install/setup3.php");

?>
