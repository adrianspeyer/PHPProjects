<?php
ob_start();
//this deletes individual items from table
require '../config.php';
require 'login.php';

mysql_select_db("$database", $con);
$id = (int) $_GET['id']; 

//get ip and update time of id
$conresult = mysql_query("SELECT `id`, `loggedip`, `updated_at` FROM  `$database`.`$table` WHERE `id` = '$id'" );
$condel = mysql_fetch_assoc($conresult); 
$delip = $condel['loggedip'];
$delutime = $condel['updated_at'];

//match ip and update time of id and create new country id
$frip = mysql_query("SELECT `id`, `loggedip`, `updated_at` FROM  `$database`.`$iptable` WHERE `loggedip` = '$delip' AND `updated_at` = '$delutime' " );
$riper = mysql_fetch_assoc($frip); 
$rip = $riper['loggedip'];
$utime = $riper['updated_at'];
$cid = $riper['id'];

//delete item from log table
mysql_query("DELETE FROM `$database`.`$table` WHERE `id` = '$id' ");
echo (mysql_affected_rows()) ? "Item deleted.<br /> " : "Item not deleted.<br /> "; 

//delete country data
mysql_query("DELETE FROM `$database`.`$iptable` WHERE `id` = '$cid' ");
echo (mysql_affected_rows()) ? "Country IP Data deleted.<br /> " : "Country IP Data not deleted.<br /> "; 

echo header("Location: results.php");
ob_flush();
?>