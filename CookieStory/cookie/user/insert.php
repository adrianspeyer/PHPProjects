
<?php
require('../admin/authenticate.php');
?>

<?php

session_name('insert_data');
if (!$_SESSION) session_start();
?>
<?php

$_POST['campaign_name'] = str_replace(' ', '_', $_POST['campaign_name']);

if(!empty($_POST['campaign_name'])) {
require '../admin/db_con.php';
mysql_select_db("$database", $con);

////////////////////
//EXISTING ID CHECK
$result = mysql_query("SELECT `id`,`campaign_name` FROM  `$database`.`$table` WHERE ('$_POST[campaign_name]'= `campaign_name` )");
while($row = mysql_fetch_array($result)){
$idexist = $row['id'];
$camp = $row['campaign_name'];
$pcamp = $_POST["campaign_name"];

$idcheck = $idexist.$camp;
if ($idcheck == $idexist.$pcamp){
$id = $idexist;}
else
$id  = 'NULL';
}

if(!isset($camp)) 
{ $id  = 'NULL';} 

////////////////


$sql="REPLACE INTO $table (id,username,campaign_name,custvar1,custvarimg1,custvar2,custvarimg2,custvar3,custvarimg3,custvar4,custvarimg4,custvar5,custvarimg5,
altext1,link1,titletext1,altext2,link2,titletext2,altext3,link3,titletext3,altext4,link4,titletext4,altext5,link5,titletext5,custvarM,custvarimgM,altextM,titletextM,linkM,
defaultbanner,defaultlink,defaulttitletext,defaultaltext,analyticspack,cookienotice,updated_at,created_at)
VALUES
	($id,'$_POST[user]','$_POST[campaign_name]', 
    '$_POST[custvar1]','$_POST[custvarimg1]', 
	'$_POST[custvar2]','$_POST[custvarimg2]',
	'$_POST[custvar3]','$_POST[custvarimg3]',
	'$_POST[custvar4]','$_POST[custvarimg4]',
	'$_POST[custvar5]','$_POST[custvarimg5]',
	'$_POST[altext1]','$_POST[link1]', '$_POST[titletext1]', 
	'$_POST[altext2]','$_POST[link2]', '$_POST[titletext2]', 
	'$_POST[altext3]','$_POST[link3]', '$_POST[titletext3]', 
	'$_POST[altext4]','$_POST[link4]', '$_POST[titletext4]', 
	'$_POST[altext5]','$_POST[link5]', '$_POST[titletext5]', 
	'$_POST[custvarM]','$_POST[custvarimgM]','$_POST[altextM]',
	'$_POST[titletextM]','$_POST[linkM]',
	'$_POST[defaultbanner]','$_POST[defaultlink]', 
	'$_POST[defaulttitletext]','$_POST[defaultaltext]','$_POST[analyticspack]',
    '$_POST[cookienotice]',NULL,'$_POST[created_at]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "";
}
mysql_close($con);
?>
<?php

$string = '
<?php 

session_name("'. $_POST["campaign_name"].'");

if(!isset($_SESSION)) 
{ 
session_start(); 
} 

// Check if mobile thanks to http://www.justindocanto.com/scripts/detect-a-user-on-a-mobile-browser-or-device
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
// Use the function
if(isMobile())
{
$date = date("d-m-y");
$ucook = "_CS_mobile_".$date;
setcookie($ucook,\'Mobile\');
$cookie = $ucook;
$mobileuser = \'1\';
}
else
{
$cookie = \''. $_POST["analyticspack"]. '\';
$mobileuser = \'0\';
}

$campaign_name = \''. $_POST["campaign_name"]. '\';

$custvar1 = \''.$_POST["custvar1"]. '\';
$custvarimg1 = \''.$_POST["custvarimg1"]. '\';
$altext1 = \''.$_POST["altext1"]. '\';
$link1 = \''.$_POST["link1"]. '\';
$titletext1 = \''.$_POST["titletext1"]. '\';

$custvar2 = \''.$_POST["custvar2"]. '\';
$custvarimg2 = \''.$_POST["custvarimg2"]. '\';
$altext2 = \''.$_POST["altext2"]. '\';
$link2 = \''.$_POST["link2"]. '\';
$titletext2 = \''.$_POST["titletext2"]. '\';

$custvar3 = \''.$_POST["custvar3"]. '\';
$custvarimg3  = \''.$_POST["custvarimg3"]. '\';
$altext3 = \''.$_POST["altext3"]. '\';
$link3  = \''.$_POST["link3"]. '\';
$titletext3 = \''.$_POST["titletext3"]. '\';

$custvar4 = \''.$_POST["custvar4"]. '\';
$custvarimg4 = \''.$_POST["custvarimg4"]. '\';
$altext4 = \''.$_POST["altext4"]. '\';
$link4 = \''.$_POST["link4"]. '\';
$titletext4 = \''.$_POST["titletext4"]. '\';

$custvar5  = \''.$_POST["custvar5"]. '\';
$custvarimg5 = \''.$_POST["custvarimg5"]. '\';
$altext5  = \''.$_POST["altext5"]. '\';
$link5 = \''.$_POST["link5"]. '\';
$titletext5 = \''.$_POST["titletext5"]. '\';

$custvarM = \''.$_POST["custvarM"]. '\';
$custvarimgM = \''.$_POST["custvarimgM"]. '\';
$altextM = \''.$_POST["altextM"]. '\';
$titletextM = \''.$_POST["titletextM"]. '\';
$linkM = \''.$_POST["linkM"]. '\';

$defaultbanner = \''.$_POST["defaultbanner"]. '\';
$defaultlink = \''.$_POST["defaultlink"]. '\';
$defaulttitletext = \''.$_POST["defaulttitletext"]. '\';
$defaultaltext = \''.$_POST["defaultaltext"]. '\';

$cookienotice = \''.$_POST["cookienotice"]. '\';


//checking cookie
foreach( $_COOKIE as $key => $value ){
   if (strpos($key,$cookie) !== false)  {
    if (!empty($custvar1)) {
   if (strpos($value,$custvar1) !== false)  {
  echo "<a href=\"#\"><img style=\"border: 0px solid ;\" title=\"".$titletext1."\" alt=\"".$altext1."\"
src=".$custvarimg1." onclick=\"parent.location=\''.$domain.'/stats/clickcounter.php?cam=".$campaign_name."\'\"></a><br>";
echo "<img  width=0 height=0 src=\"'.$domain.'/stats/impressioncounter.php?cam=".$campaign_name."\" onload=\"trackimpression()\">"; 
$activekey=\'1\';
  break;
  }}
   if (!empty($custvar2)) {
if (strpos($value,$custvar2) !== false)  {
  echo "<a href=\"#\"><img style=\"border: 0px solid ;\" title=\"".$titletext2."\" alt=\"".$altext2."\"
src=".$custvarimg2." onclick=\"parent.location=\''.$domain.'/stats/clickcounter.php?cam=".$campaign_name."\'\"></a><br>";
echo "<img  width=0 height=0 src=\"'.$domain.'/stats/impressioncounter.php?cam=".$campaign_name."\" onload=\"trackimpression()\">"; 
$activekey=\'2\';
  break;
}}
   if (!empty($custvar3)) {
if (strpos($value,$custvar3) !== false)  {
  echo "<a href=\"#\"><img style=\"border: 0px solid ;\" title=\"".$titletext3."\" alt=\"".$altext3."\"
src=".$custvarimg3." onclick=\"parent.location=\''.$domain.'/stats/clickcounter.php?cam=".$campaign_name."\'\"></a><br>";
echo "<img  width=0 height=0 src=\"'.$domain.'/stats/impressioncounter.php?cam=".$campaign_name."\" onload=\"trackimpression()\">"; 
$activekey=\'3\';
  break;
}}
   if (!empty($custvar4)) {
if (strpos($value,$custvar4) !== false)  {
  echo "<a href=\"#\"><img style=\"border: 0px solid ;\" title=\"".$titletext4."\" alt=\"".$altext4."\"
src=".$custvarimg4." onclick=\"parent.location=\''.$domain.'/stats/clickcounter.php?cam=".$campaign_name."\'\"></a><br>";
echo "<img  width=0 height=0 src=\"'.$domain.'/stats/impressioncounter.php?cam=".$campaign_name."\" onload=\"trackimpression()\">"; 
$activekey=\'4\';
  break;
}}
   if (!empty($custvar5)) {
if (strpos($value,$custvar5) !== false)  {
   echo "<a href=\"#\"><img style=\"border: 0px solid ;\" title=\"".$titletext5."\" alt=\"".$altext5."\"
src=".$custvarimg5." onclick=\"parent.location=\''.$domain.'/stats/clickcounter.php?cam=".$campaign_name."\'\"></a><br>";
echo "<img  width=0 height=0 src=\"'.$domain.'/stats/impressioncounter.php?cam=".$campaign_name."\" onload=\"trackimpression()\">"; 
$activekey=\'5\';
  break;
}}

if (isset($ucook)) {
   if (!empty($custvarM)) {
   echo "<a href=\"#\"><img style=\"border: 0px solid ;\" title=\"".$titletextM."\" alt=\"".$altextM."\"
src=".$custvarimgM." onclick=\"parent.location=\''.$domain.'/stats/clickcounter.php?cam=".$campaign_name."\'\"></a><br>";
echo "<img  width=0 height=0 src=\"'.$domain.'/stats/impressioncounter.php?cam=".$campaign_name."\" onload=\"trackimpression()\">"; 
$activekey=\'M\';
  break;
}}

else
if (!isset($ucook)) {
echo "<a href=\"#\"><img style=\"border: 0px solid ;\" title=\"".$defaulttitletext."\" alt=\"".$defaultaltext."\"
src=".$defaultbanner." onclick=\"parent.location=\''.$domain.'/stats/clickcounter.php?cam=".$campaign_name."\'\"></a><br>";
echo "<img  width=0 height=0 src=\"'.$domain.'/stats/impressioncounter.php?cam=".$campaign_name."\" onload=\"trackimpression()\">"; 
}}}


//if empty session
if(empty($_SESSION)) {
 if (empty($activekey)) {
 echo "<a href=\"#\"><img style=\"border: 0px solid ;\" title=\"".$defaulttitletext."\" alt=\"".$defaultaltext."\"
src=".$defaultbanner." onclick=\"parent.location=\''.$domain.'/stats/clickcounter.php\'\"></a><br>";
echo "<img  width=0 height=0 src=\"'.$domain.'/stats/impressioncounter.php?cam=".$campaign_name."\" onload=\"trackimpression()\">"; 
}}



 if (!empty($activekey)) {
$customsession =  ${\'custvar\' . $activekey};
$customimgsession =  ${\'custvarimg\' . $activekey};
$linksession = ${\'link\' . $activekey};
}
else
{
$customsession =  \'Default\';
$customimgsession =  $defaultbanner;
$linksession = $defaultlink;
}

$_SESSION[\'campaign_name\'] = $campaign_name;
$_SESSION[\'custvar\']   =  $customsession;
$_SESSION[\'custimage\']     = $customimgsession;
$_SESSION[\'custlink\']     = $linksession;
$_SESSION[\'start\'] = time(); // taking now logged in time
$_SESSION[\'expire\'] = $_SESSION[\'start\'] + (30 * 60) ; // ending a session in 30 minutes from the starting time

 if (!empty($activekey)) {
  if (!empty($cookienotice)) {
 echo "
 <script type=\"text/javascript\" src=\"'.$domain.'/js/script.cookiealert.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"'.$domain.'/css/style.cookiealert.css\"/>
 <img src=\"'.$domain.'/images/info_icon_sm.png\" alt=\"Info about Cookie Policy\" title=\"Info about Cookie Policy\"  onclick=\"setVisibility(\'cookieinfobox\', \'inline\');\";>
<div id=\"cookieinfobox\" style=\"position: relative;\" >
We use cookies to serve you better. <a href=\"http://www.statstory.com/cookie-story.php\">Learn more</a>
<a href=# onclick=\"setVisibility(\'cookieinfobox\', \'none\');\";><span style=\"padding: 2px; border:0px ;text-align:center;font-size:8pt;cursor:hand; background: red; color:white;\">x</span></a></div></div>";
}}

?>';


$loggeduser = $_SESSION['username'];
$camp = $_POST["campaign_name"];
$campfile = $loggeduser."/".$camp.'.php.txt';
 
if(!file_exists($loggeduser)) 
{ 
mkdir($loggeduser); 
$fp = fopen($campfile, "w");
fwrite($fp, $string);
fclose($fp);

} 
else 
{ 
$fp = fopen($campfile, "w");
fwrite($fp, $string);
fclose($fp);
}
 


echo header("Location: ../user/listing.php");

?>
