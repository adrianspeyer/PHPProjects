<?php
require('../admin/authenticate.php');
include '../admin/db_con.php';
mysql_select_db($database, $con);
$loggeduser = $_SESSION['username'];

$rolelevel = mysql_query("SELECT `rolelevel` FROM  `$database`.`$authtable` WHERE `username`='$loggeduser'");
while($rolev = mysql_fetch_array($rolelevel)) {
$permission = $rolev['rolelevel'];
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
</head>
<body >
<h1>These are your hot campaigns <? echo $loggeduser ?>!</h1>

<div style="text-align: right;" id="add another"><a href="../user/add.php">Add Another Campaign</a> | <?php if($permission==0) {echo ' <a href="../admin/changepass.php">Change User</a>';} else {echo 'nope';} ?> 
<?php if($permission==0) {echo '| <a href="../admin/register.php">Add User</a>';} else {echo 'nope';} ?> |
<a href="../admin/logout.php?signature=<?php echo $_SESSION['signature']; ?>">Logout</a></div>

<div id="Main Area">
<p></p>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript">
function toggleDiv(divId) {
   $("#"+divId).toggle();
}
</script>



<script type="text/javascript" language="JavaScript"><!--
function HideContent(d) {
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
document.getElementById(d).style.display = "block";
}
function ReverseDisplay(d) {
if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
else { document.getElementById(d).style.display = "none"; }
}
//--></script>

<?php

$stats = mysql_query("SELECT $table.`campaign_name`,$stable.`campaign_name`,$table.`custvar1`,$table.`custvar2`,$table.`custvar3`,$table.`custvar4`,
$table.`custvar5`,$stable.`custvar`,$stable.`custview`, $stable.`custclicks`  FROM  `$database`.`$table` JOIN `$database`.`$stable`  WHERE ($stable.`custvar` IS NOT NULL)");

while($stat = mysql_fetch_array($stats)) {
$Scamp [] = $stat['campaign_name'];
$Scustvar[] = $stat['custvar'];
$Scustview[] = $stat['custview'];
$Scustclicks[] = $stat['custclicks'];
//print_r ($stat);
}
?>

<?php
$result = mysql_query("SELECT * FROM  `$database`.`$table` WHERE `username`='$loggeduser' ORDER BY `updated_at` DESC");
while($row = mysql_fetch_array($result)){
//print_r ($row);

  echo "<hr></hr>";
 echo" <div style=\"text-align: right;\" class=\"settings\">
<a href=\"javascript:ReverseDisplay('".$row ['campaign_name']."')\"> Show/Hide</a></div>";


  echo "<div id=\"".$row ['campaign_name']."\"><br><b>Camapign Name</b>: ".$row ['campaign_name']." ";
  echo "<b>Campaign Last Updated: </b>".$row['updated_at']."</br></br>";
  echo "<table border=\"1\">
		<tbody>
		<tr>
		<td>Custom Variable</td>
		<td>Banner</td>
		<td>Alt Text</td>
		<td>Title Text</td>
		<td>Link</td>
		<td>Impressions</td>
		<td>Clicks</td>
		<td>Modify</td>
		</tr>"; 
		
  echo "<tr>";
  echo "<td>".$row['custvar1']."</td><td>"."<a href=".$row['custvarimg1'] ." class=\"screenshot\" rel=\"".$row['custvarimg1']."\">".$row['custvarimg1'] ."</a>"."</td><td>". $row['altext1']."</td><td>". $row['titletext1']."</td><td>".$row['link1']."</td>";
		
	//these are the impressions for 1
	echo "<td>";
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar1'], $Scustvar)) {
	$key = array_search($row['custvar1'], $Scustvar);
	echo $Scustview[$key];}
	else {echo '0';}}}
	echo "</td>";

	//these are the clicks for 1
	echo "<td>"; 
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar1'], $Scustvar)) {
	$key = array_search($row['custvar1'], $Scustvar);
    echo $Scustclicks[$key];}
	else {echo '0';}}}
	echo "</td>";
	
	echo "<td valign='top'><a href=edit.php?id={$row['id']}#editnow>Edit</a></td> "; 
	echo "</tr>";
  
   echo "<tr>";
   echo "<td>". $row['custvar2']."</td><td>"."<a href=".$row['custvarimg2'] ." class=\"screenshot\" rel=\"".$row['custvarimg2']."\">".$row['custvarimg2'] ."</a>"."</td><td>". $row['altext2']."</td><td>". $row['titletext2']."</td><td>".$row['link2']."</td>";
	
	//these are the impressions for 2
	echo "<td>";
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar2'], $Scustvar)) {
	$key = array_search($row['custvar2'], $Scustvar);
    echo $Scustview[$key];}
	else {echo '0';}}}
	echo "</td>";

	//these are the clicks for 2
	echo "<td>"; 
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar2'], $Scustvar)) {
	$key = array_search($row['custvar2'], $Scustvar);
    echo $Scustclicks[$key];}
	else {echo '0';}}}
	echo "</td>";
	   
   echo "<td valign='top'><a href=edit.php?id={$row['id']}#editnow>Edit</a></td> "; 
   echo "</tr>";
  echo "<tr>";
	echo "<td>". $row['custvar3']."</td><td>"."<a href=".$row['custvarimg3'] ." class=\"screenshot\" rel=\"".$row['custvarimg3']."\">".$row['custvarimg3'] ."</a>"."</td><td>". $row['altext3']."</td><td>". $row['titletext3']."</td><td>".$row['link3']."</td>";
	
	
	//these are the impressions for 3
	echo "<td>";
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar3'], $Scustvar)) {
	$key = array_search($row['custvar3'], $Scustvar);
    echo $Scustview[$key];}
  	else {echo '0';}}}
	echo "</td>";

	//these are the clicks for 3
	echo "<td>"; 
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar3'], $Scustvar)) {
	$key = array_search($row['custvar3'], $Scustvar);
    echo $Scustclicks[$key];}
  	else {echo '0';}}}
	echo "</td>";
	
	
	
	echo "<td valign='top'><a href=edit.php?id={$row['id']}#editnow>Edit</a></td> "; 
    echo "</tr>";
  
  
    echo "<tr>";
	echo "<td>". $row['custvar4']."</td><td>"."<a href=".$row['custvarimg4'] ." class=\"screenshot\" rel=\"".$row['custvarimg4']."\">".$row['custvarimg4'] ."</a>"."</td><td>". $row['altext4']."</td><td>". $row['titletext4']."</td><td>".$row['link4']."</td>";
	
	//these are the impressions for 4
	echo "<td>";
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar4'], $Scustvar)) {
	$key = array_search($row['custvar4'], $Scustvar);
    echo $Scustview[$key];}
  	else {echo '0';}}}
	echo "</td>";

	//these are the clicks for 4
	echo "<td>"; 
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar4'], $Scustvar)) {
	$key = array_search($row['custvar4'], $Scustvar);
    echo $Scustclicks[$key];}
  	else {echo '0';}}}
	echo "</td>";
	
	
	echo "<td valign='top'><a href=edit.php?id={$row['id']}#editnow>Edit</a></td> "; 
    echo "</tr>";
  
  
    echo "<tr>";
	echo "<td>". $row['custvar5']."</td><td>"."<a href=".$row['custvarimg5'] ." class=\"screenshot\" rel=\"".$row['custvarimg5']."\">".$row['custvarimg5'] ."</a>"."</td><td>". $row['altext5']."</td><td>". $row['titletext5']."</td><td>".$row['link5']."</td>";

		//these are the impressions for 5
	echo "<td>";
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar5'], $Scustvar)) {
	$key = array_search($row['custvar5'], $Scustvar);
    echo $Scustview[$key];}
  	else {echo '0';}}}
	echo "</td>";

	//these are the clicks for 5
	echo "<td>"; 
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array($row['custvar5'], $Scustvar)) {
	$key = array_search($row['custvar5'], $Scustvar);
    echo $Scustclicks[$key];}
  	else {echo '0';}}}
	echo "</td>";
	
	
	echo "<td valign='top'><a href=edit.php?id={$row['id']}#editnow>Edit</a></td> "; 
    echo "</tr>";
	
 echo "</tbody></table> ";
 
  echo "</br>";
  
   
	echo "<h3>Mobile Settings</h3>";
   echo "<table border=\"1\">
		<tbody>
		<tr>
		<td>Mobile Banner</td>
		<td>Mobile Alt Text</td>
		<td>Mobile Title Text</td>
		<td>Mobile Link</td>
		<td>Impressions</td>
		<td>Clicks</td>
		<td>Modify</td>
		</tr>"; 
	echo "<tr>";
	echo "<td>"."<a href=".$row['custvarimgM'] ." class=\"screenshot\" rel=\"".$row['custvarimgM']."\">".$row['custvarimgM'] ."</a>"."</td>";
  	echo "<td>". $row['altextM']."</td>";
  	echo "<td>". $row['titletextM']."</td>";
	echo "<td>". $row['linkM']."</td>";
	
	//these are the impressions for Mobile
	echo "<td>";
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array('Mobile', $Scustvar)) {
	$key = array_search('Mobile', $Scustvar);
    echo $Scustview[$key];}
  	else {echo '0';}}}
	echo "</td>";

	//these are the clicks for Mobile
	echo "<td>"; 
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array('Mobile', $Scustvar)) {
	$key = array_search('Mobile', $Scustvar);
	echo $Scustclicks[$key];}
  	else {echo '0';}}}
	echo "</td>";
	
	echo "<td valign='top'><a href=edit.php?id={$row['id']}#editnow>Edit</a></td> ";
    echo "</tr>";
	echo "</tbody></table></br> ";
	
	
	
	echo "<h3>Default Settings</h3>";
	   echo "<table border=\"1\">
		<tbody>
		<tr>
		<td>Default Banner</td>
		<td>Default Alt Text</td>
		<td>Default Title</td>
		<td>Default Link</td>
		<td>Impressions</td>
		<td>Clicks</td>
		<td>Modify</td>
		</tr>"; 
			echo "<tr>";
		echo "<td>"."<a href=".$row['defaultbanner'] ." class=\"screenshot\" rel=\"".$row['defaultbanner']."\">".$row['defaultbanner'] ."</a>"."</td>";
		echo "<td>". $row['defaultaltext']."</td>";
		echo "<td>". $row['defaulttitletext']."</td>";
		echo "<td>". $row['defaultlink']."</td>";
	
	//these are the impressions for Default
	echo "<td>";
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array('Default', $Scustvar)) {
	$key = array_search('Default', $Scustvar);
	echo $Scustview[$key];}
  	else {echo '0';}}}
	echo "</td>";

	//these are the clicks for Default
	echo "<td>"; 
	if (isset($Scamp) ) {
	if (in_array($row['campaign_name'], $Scamp)) {
	if (in_array('Default', $Scustvar)) {
	$key = array_search('Default', $Scustvar);
	echo $Scustclicks[$key];}
  	else {echo '0';}}}
	echo "</td>";


	echo "<td valign='top'><a href=edit.php?id={$row['id']}#editnow>Edit</a></td> "; 
		echo "</tr>";
		echo "</tbody></table></br> ";
	
		
		echo "</br>Custom Variable Provider: ";  if($row['analyticspack'] == "_pk_cvar"){echo '<b>PIWIK</b> '."<a href=edit.php?id={$row['id']}#editnow> Edit</a>";}else{echo '<b>GOOGLE </b> '."<a href=edit.php?id={$row['id']}> Edit</a>";} 
		echo "</br>";
		echo "</br>Using default cookie notice?: ";  if($row['cookienotice'] == "YES"){echo 'YES '."<a href=edit.php?id={$row['id']}#editnow>  Remove Notice</a>";}else{echo 'NO'."<a href=edit.php?id={$row['id']}> Add Notice</a>";} 
		echo "</br></br><b>".'To use this campaign on your site use an PHP include for filename <a href='.$domain.'user/'.$loggeduser.'/'.$row ['campaign_name'].'.php.txt'.">".$row ['campaign_name'].'.php'."</a></br> </b>";
		echo "</br><b><a href=delete.php?id={$row['id']}&campaign_name={$row['campaign_name']}>Delete This Campaign</a></b></br></div>";
  }

mysql_close($con);

 
?>

</body>

