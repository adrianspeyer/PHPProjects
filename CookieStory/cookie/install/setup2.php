<?php

if (isset($_POST["Submit"])) {
$connect= '<?php 
$dbhost = "'. $_POST["dbhost"]. '";
$dbuname = "'. $_POST["dbuname"]. '";
$dbpass = "'. $_POST["dbpass"]. '";
$database  = "'. $_POST["dbname"]. '";
$prefix = "'. $_POST["prefix"]. '";

$table  = $prefix."cookiestory";
$stable  = $prefix."cookiestats";
$authtable = $prefix."authentication";
$iptable = $prefix."ipcheck";
 
$domain= "'. $_POST["domain"]. '";

//Define length of salt,minimum=10, maximum=35
$length_salt=35;

//Define the maximum number of failed attempts to ban brute force attackers
//minimum is 5
$maxfailedattempt=5;

//Define session timeout in seconds
//minimum 60 (for one minute)
$sessiontimeout=300;

$con = mysql_connect($dbhost,$dbuname,$dbpass)
 or die("Unable to connect to MySQL");
  
$selected = mysql_select_db($database,$con)
or die("Could not select $database");  
 
$registerpage_url= $domain.\'admin/addeduser.php\'; 
$loginpage_url= $domain.\'user/listing.php\';
$forbidden_url= $domain.\'403forbidden.php\';

?>';



$adminfolder = '../admin';
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

$table  = $prefix."cookiestory";
$stable  = $prefix."cookiestats";
$authtable = $prefix."authentication";
$iptable = $prefix."ipcheck";
 
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
