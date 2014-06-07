<?php


   $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $keys = parse_url($url); // parse the url
   $path = explode("cam=", $keys['query']); // splitting the path
   $last = end($path); // get the value of the last element 
   session_name($last); 

if(!isset($_SESSION)) 
{ 
session_start(); 
} 
 


$_SESSION['campaign_name'];
$_SESSION['custvar'];
$_SESSION['custimage'];
$_SESSION['custlink'];
$_SESSION['start'] = time(); // taking now logged in time
$_SESSION['expire'] = $_SESSION['start'] + (30 * 60) ; // ending a session in 30 minutes


// updates the counter
include '../admin/db_con.php';
mysql_select_db("$database");

$update = "INSERT INTO`$stable` (campaign_name,custvar,custimage,custlink,custview,custclicks) VALUES  (\"".$_SESSION['campaign_name']."\",\"".$_SESSION['custvar']."\",\"".$_SESSION['custimage']."\",\"".$_SESSION['custlink']."\",0,1)  ON DUPLICATE KEY UPDATE custclicks=custclicks+1;";

if (!mysql_query($update))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);
 header('Location:'.$_SESSION['custlink']);
?>
