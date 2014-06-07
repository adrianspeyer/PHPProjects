<?php
ob_start(); 
require '../db_con.php';
require 'login.php';
mysql_select_db("$database", $con);
//print_r ($_POST);

if (isset($_POST['devmethod'])) {

$devmethod = $_POST['devmethod'];
$popuptext= $_POST['popuptext'];
$randomsurvey= $_POST['randomsurvey'];
$delaytime= $_POST['delaytime'];
$iprestrict= $_POST['iprestrict'];
$feedback= $_POST['feedback'];
$samail= $_POST['samail'];
$piwikan= $_POST['piwikan'];
$piwik_site_id= $_POST['piwik_site_id'];
$piwik_path= $_POST['piwik_path'];
$piwik_api=  $_POST['piwik_api'];

	

	
$sql = "UPDATE  `$setable` SET 
  `devmethod`=  '$devmethod',   
 `popuptext`=   '$popuptext',
 `randomsurvey`= '$randomsurvey',
 `delaytime`= '$delaytime',
 `iprestrict` =   '$iprestrict',
  `feedback` =   '$feedback',
  `samail` =   '$samail',
  `piwikan` =  '$piwikan',
   `piwik_site_id`=  '$piwik_site_id',
  `piwik_path`=  '$piwik_path',
  `piwik_api`=   '$piwik_api'
  WHERE `id` = '1'
  "; 


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "";
}
  

mysql_close($con);
?>


<?php

$string = '<?php
if(!isset($_SESSION)) { session_start(); }
error_reporting(0);
include \'db_con.php\';
include \'useradmin/group_perm.php\';


if (isset($_SESSION[\'logged_in\'])){
if ($_SESSION[\'logged_in\'] == TRUE) { include \'useradmin/useraccess.php\';}}

//These are the standard settings for most of the site.
//Please modify in the settings console not directly in this file.

$sitename = "Web Visitor Feedback";
$devmethod = \''. $_POST["devmethod"]. '\';
$popuptext= \''. $_POST["popuptext"]. '\';
$randomsurvey= \''. $_POST["randomsurvey"]. '\';
$delaytime= \''. $_POST["delaytime"]. '\';
$iprestrict= \''. $_POST["iprestrict"]. '\';
$feedback= \''. $_POST["feedback"]. '\';
$samail= \''. $_POST["samail"]. '\';
$piwikan= \''. $_POST["piwikan"]. '\';
$piwik_site_id= \''. $_POST["piwik_site_id"]. '\';
$piwik_path= \''. $_POST["piwik_path"]. '\';
$piwik_api=  \''. $_POST["piwik_api"]. '\';
?>';

$fp = fopen('../config.php', "w");
fwrite($fp, $string);
fclose($fp);

echo header("Location: settings.php");
exit;
ob_flush(); 
?>
