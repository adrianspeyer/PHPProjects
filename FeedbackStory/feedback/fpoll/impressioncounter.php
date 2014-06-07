<?php

require '../config.php';

if(!isset($_SESSION)) 
{ 
session_start(); 
} 
 
mysql_select_db("$database");
$update = "INSERT INTO `$impression` (surveyname, surveyview) VALUES  ('survey_landing',1)  ON DUPLICATE KEY UPDATE surveyview = surveyview+1;";

if (!mysql_query($update))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);

?>
