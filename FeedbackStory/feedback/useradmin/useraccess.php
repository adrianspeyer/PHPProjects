<?php
//database connection
//require '../db_con.php';

if(!isset($_SESSION)) 
{ 
session_start(); 
}

mysql_select_db("$database", $con);

if (isset($_SESSION['logged_in'])) {
if ($_SESSION['logged_in'] == TRUE){

$loginuser = $_SESSION['email'];
//all groups


$useraccess = mysql_query("SELECT `email`, `groupname` FROM  `$database`.`$utable` WHERE `email` = '$loginuser'");
while($uaccess = mysql_fetch_array($useraccess)){
$GName[] = $uaccess['groupname'];
}

if (isset($GName[0])) {
$permissions = mysql_query("SELECT `groupname`, `export`,`print`,`clear`,`stats`,`userset`,`siteset` FROM  `$database`.`$gtable` WHERE `groupname`= '$GName[0]'");
while($access = mysql_fetch_array($permissions)){
$OKE1[] = $access['export'];
$OKE2[] =$access['print']; 
$OKE3[] =$access['clear'];  
$OKE4[] = $access['stats']; 
$OKE5[] =$access['userset'];  
$OKE6[] = $access['siteset'];
}
}
}
}


//example implemenation
//if  ($OKE6[0] =1) {echo 'access granted';} else {echo 'Nope, no access';}

?>
