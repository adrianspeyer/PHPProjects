<HEAD>
<style>
  form { display: inline; }
</style>
<HEAD>

<form action='' method='POST' action="#notice"> 
<h1>Modify Your Campaigns</h1>

<?php
require('../admin/authenticate.php');

require '../admin/db_con.php';
mysql_select_db($database, $con);

if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `pw_cookiestory` SET  `custvar1` =  '{$_POST['custvar1']}' ,  `custvarimg1` =  '{$_POST['custvarimg1']}' ,  `custvar2` =  '{$_POST['custvar2']}' ,  `custvarimg2` =  '{$_POST['custvarimg2']}' ,  `custvar3` =  '{$_POST['custvar3']}' ,  `custvarimg3` =  '{$_POST['custvarimg3']}' ,  `custvar4` =  '{$_POST['custvar4']}' ,  `custvarimg4` =  '{$_POST['custvarimg4']}' ,  `custvar5` =  '{$_POST['custvar5']}' ,  `custvarimg5` =  '{$_POST['custvarimg5']}' ,  `altext1` =  '{$_POST['altext1']}' ,  `link1` =  '{$_POST['link1']}' ,  `titletext1` =  '{$_POST['titletext1']}' ,  `altext2` =  '{$_POST['altext2']}' ,  `link2` =  '{$_POST['link2']}' ,  `titletext2` =  '{$_POST['titletext2']}' ,  `altext3` =  '{$_POST['altext3']}' ,  `link3` =  '{$_POST['link3']}' ,  `titletext3` =  '{$_POST['titletext3']}' ,  `altext4` =  '{$_POST['altext4']}' ,  `link4` =  '{$_POST['link4']}' ,  `titletext4` =  '{$_POST['titletext4']}' ,  `altext5` =  '{$_POST['altext5']}' ,  `link5` =  '{$_POST['link5']}' ,  `titletext5` =  '{$_POST['titletext5']}' ,  `defaultbanner` =  '{$_POST['defaultbanner']}' ,  `defaultlink` =  '{$_POST['defaultlink']}' ,  `defaulttitletext` =  '{$_POST['defaulttitletext']}' ,  `defaultaltext` =  '{$_POST['defaultaltext']}' ,    `custvarimgM` =  '{$_POST['custvarimgM']}' ,  `altextM` =  '{$_POST['altextM']}' ,  `titletextM` =  '{$_POST['titletextM']}' ,  `linkM` =  '{$_POST['linkM']}' , `analyticspack` =  '{$_POST['analyticspack']}' , `cookienotice` =  '{$_POST['cookienotice']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
echo "<a id=\"editnow\"></a>";
echo (mysql_affected_rows()) ? "<span style=\"color: rgb(0, 153, 0);\"><b>Record has been updated.</b></span><br />" : "<span style=\"color: rgb(204, 0, 0);\"><b>Nothing changed.</b></span><br />"; 
echo "<form><INPUT TYPE=\"BUTTON\" VALUE=\"Return to Listing\" onclick='window.location.href=\"../user/listing.php\";return false;'></form>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM  `$database`.`$table` WHERE `id` = '$id' ")); 
?>

<p><b>Campaign Name:</b> <?php echo $row['campaign_name'] ?> 
<p>--------------------------</p>
<table>
<tbody>
<tr>
<a id="CustomVariables"></a>
<td>Custom Variable:</td>
<td>Banner:</td>
<td>Alt Text:</td>
<td>Title Text:</td>
<td>Link:</td>
</tr>

<tr>
<td><p><b>Custom Variable 1:</b><br /><input type='text' name='custvar1' value='<?= stripslashes($row['custvar1']) ?>' /> </td>
<td><p><b>Custom Banner 1:</b><br /><input type='text' name='custvarimg1' value='<?= stripslashes($row['custvarimg1']) ?>' /> </td>
<td><p><b>Alt Text 1:</b><br /><input name='altext1' value='<?= stripslashes($row['altext1']) ?>' /> </td>
<td><p><b>Title Text 1:</b><br /><input name='titletext1' value='<?= stripslashes($row['titletext1']) ?>' /> </td>
<td><p><b>URL 1:</b><br /><input type='text' name='link1' value='<?= stripslashes($row['link1']) ?>' /> </td>
</tr>

<tr>
<td><p><b>Custom Variable 2:</b><br /><input type='text' name='custvar2' value='<?= stripslashes($row['custvar2']) ?>' /> </td>
<td><p><b>Custom Banner 2:</b><br /><input type='text' name='custvarimg2' value='<?= stripslashes($row['custvarimg2']) ?>' /> </td>
<td><p><b>Alt Text 2:</b><br /><input name='altext2' value='<?= stripslashes($row['altext2']) ?>' /> </td>
<td><p><b>Title Text 2:</b><br /><input name='titletext2' value='<?= stripslashes($row['titletext2']) ?>' /> </td>
<td><p><b>URL 2:</b><br /><input type='text' name='link2' value='<?= stripslashes($row['link2']) ?>' /> </td>
</tr>


<tr>
<td><p><b>Custom Variable 3:</b><br /><input type='text' name='custvar3' value='<?= stripslashes($row['custvar3']) ?>' /> </td>
<td><p><b>Custom Banner 3:</b><br /><input type='text' name='custvarimg3' value='<?= stripslashes($row['custvarimg3']) ?>' /> </td>
<td><p><b>Alt Text 3:</b><br /><input name='altext3' value='<?= stripslashes($row['altext3']) ?>' /> </td>
<td><p><b>Title Text 3:</b><br /><input name='titletext3' value='<?= stripslashes($row['titletext3']) ?>' /> </td>
<td><p><b>URL 3:</b><br /><input type='text' name='link3' value='<?= stripslashes($row['link3']) ?>' /> </td>
</tr>


<tr>
<td><p><b>Custom Variable 4:</b><br /><input type='text' name='custvar4' value='<?= stripslashes($row['custvar4']) ?>' /> </td>
<td><p><b>Custom Banner 4:</b><br /><input type='text' name='custvarimg4' value='<?= stripslashes($row['custvarimg4']) ?>' /> </td>
<td><p><b>Alt Text 4:</b><br /><input name='altext4' value='<?= stripslashes($row['altext4']) ?>' /> </td>
<td><p><b>Title Text 4:</b><br /><input name='titletext4' value='<?= stripslashes($row['titletext4']) ?>' /> </td>
<td><p><b>URL 4:</b><br /><input type='text' name='link4' value='<?= stripslashes($row['link4']) ?>' /> </td>
</tr>


<tr>
<td><p><b>Custom Variable 5:</b><br /><input type='text' name='custvar5' value='<?= stripslashes($row['custvar5']) ?>' /> </td>
<td><p><b>Custom Banner 5:</b><br /><input type='text' name='custvarimg5' value='<?= stripslashes($row['custvarimg5']) ?>' /> </td>
<td><p><b>Alt Text 5:</b><br /><input name='altext5' value='<?= stripslashes($row['altext5']) ?>' /> </td>
<td><p><b>Title Text 5:</b><br /><input name='titletext5' value='<?= stripslashes($row['titletext5']) ?>' /> </td>
<td><p><b>URL 5:</b><br /><input type='text' name='link5' value='<?= stripslashes($row['link5']) ?>' /> </td>
</tr>
</tbody>
</table>


</br>
<table>
<tbody>
<tr>
<a id="MobileSettings"><h3>Mobile Settings</h3></a>
<td><p><b>Mobile Banner:</b><br /><input type='text' name='custvarimgM' value='<?= stripslashes($row['custvarimgM']) ?>' /> </td>
<td><p><b>Mobile Alt Text:</b><br /><input type='text' name='altextM' value='<?= stripslashes($row['altextM']) ?>' /> </td>
<td><p><b>Mobile Title text:</b><br /><input type='text' name='titletextM' value='<?= stripslashes($row['titletextM']) ?>' /> </td>
<td><p><b>Mobile Url :</b><br /><input type='text' name='linkM' value='<?= stripslashes($row['linkM']) ?>' /> </td>
</tr>
</tbody>
</table> 

<table>
<tbody>
<tr>
<a id="DefaultSettings"><h3>Default Settings</h3></a>
<tr>
<td><p><b>Default Banner:</b><br /><input type='text' name='defaultbanner' value='<?= stripslashes($row['defaultbanner']) ?>' /> </td>
<td><p><b>Default Alt Text:</b><br /><input type='text' name='defaultaltext' value='<?= stripslashes($row['defaultaltext']) ?>' /> </td>
<td><p><b>Default Title Text:</b><br /><input type='text' name='defaulttitletext' value='<?= stripslashes($row['defaulttitletext']) ?>' /> </td>
<td><p><b>Default URL:</b><br /><input type='text' name='defaultlink' value='<?= stripslashes($row['defaultlink']) ?>' /> </td>
</tr>

</tbody>
</table> 
 <p>----------------------------------</p>
 <a id="AnalyticsPack"></a>
 <h3>Analytics Package</h3>
 
        <select name="analyticspack">
            <option value="_pk_cvar"<?= stripslashes($row['analyticspack'])?><?php if ($row['analyticspack'] == "_pk_cvar"){ echo(" selected=\"selected\""); } ?>>PIWIK</option>
            <option value="__utmv"<?= stripslashes($row['analyticspack'])?><?php if ($row['analyticspack'] == "__utmv"){ echo(" selected=\"selected\""); } ?>>GOOGLE</option>
        </select>
		

 <p>----------------------------------</p>
 <a id="EditCookieNotice"></a>
 <h3>Cookie Notice Settings</h3>
 
        <select name="cookienotice">
            <option value="YES"<?= stripslashes($row['cookienotice'])?><?php if ($row['cookienotice'] == "YES"){ echo(" selected=\"selected\""); } ?>>ENABLE</option>
            <option value=""<?= stripslashes($row['cookienotice'])?><?php if ($row['cookienotice'] == ""){ echo(" selected=\"selected\""); } ?>>DISABLE</option>
        </select>


 <p><b>WARNING YOU SHOULD MAKE SURE YOU INCLUDE A NOTICE TO USERS IF YOU DISABLE</b></p>
 

<input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /></form>


<form><INPUT TYPE="BUTTON" VALUE="Go Back" onclick='window.location.href="../user/listing.php";return false;'></form>


<?php } ?> 

  <?php

if(!empty($_POST['custvar1'])) {
  
$string = '
<?php 

session_name("'. $row['campaign_name'].'");

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
$cookie = \''.$_POST["analyticspack"]. '\';
$mobileuser = \'0\';
}

$campaign_name = \''. $row['campaign_name']. '\';

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

$custvarM = \'Mobile\';
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
 <img src=\''.$domain.'/images/info_icon_sm.png\' alt=\"Info about Cookie Policy\" title=\"Info about Cookie Policy\"  onclick=\"setVisibility(\'cookieinfobox\', \'inline\');\";>
<div id=\"cookieinfobox\" style=\"position: relative;\" >
We use cookies to serve you better. <a href=\"http://www.statstory.com/cookie-story.php\">Learn more</a>
<a href=# onclick=\"setVisibility(\'cookieinfobox\', \'none\');\";><span style=\"padding: 2px; border:0px ;text-align:center;font-size:8pt;cursor:hand; background: red; color:white;\">x</span></a></div></div>";
}}

?>';

$loggeduser = $_SESSION['username'];
$camp = $row['campaign_name'];
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

}



?>


