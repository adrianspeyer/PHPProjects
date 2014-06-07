<?php
require '../config.php';
require 'login.php';

mysql_select_db("$database", $con);
//read back values from the database
$setis = mysql_query("SELECT `devmethod`,`popuptext`,`randomsurvey`,`delaytime`, `iprestrict`,`feedback`,`samail`,`piwikan`,`piwik_site_id`,`piwik_path`,`piwik_api` FROM  `$database`.`$setable`");
while($aset = mysql_fetch_array($setis)) {
$sdevmethod = $aset['devmethod'];
$spopuptext = $aset['popuptext'];
$srandomsurvey= $aset['randomsurvey'];
$sdelaytime= $aset['delaytime'];
$siprestrict= $aset['iprestrict'];
$sfeedback= $aset['feedback'];
$ssamail= $aset['samail'];
$spiwikan= $aset['piwikan'];
$spiwik_site_id= $aset['piwik_site_id'];
$spiwik_path= $aset['piwik_path'];
$spiwik_api= $aset['piwik_api'];
} 
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<title>Dashboard - Settings Control Area</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>	
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="../css/ie-sucks.css" />
<![endif]-->



</head>	

<body>
	<div id="container">
    	<div id="header">
        	<h2>Web Visitor Feedback Admin</h2>
    <div id="topmenu">
            	<ul>
				<li ><a href="<?php echo $domain?>/admin/results.php">Dashboard</a></li>
				 <?php if ($OKE5[0] ==1){echo '<li><a href="'.$domain.'/useradmin/users.php">Users</a></li>';}?>
				  <?php if ($OKE4[0] ==1){if ($piwikan=='1') {echo '<li><a href="'.$domain.'admin/analytics.php">Site Analytics</a></li>';}}?> 
					<?php if ($OKE6[0] ==1){echo '<li class="current"><a href="'.$domain.'/admin/settings.php">Settings</a></li>';}?>
					<li><a href="<?php echo $domain ?>admin/logout.php" onclick="return confirm('Are You Ready To Logout?');" >Log Out</a></li>
              </ul>
          </div>
      </div>
        
        <div id="wrapper">      
		<div id="content">
		<div id="box">

		<h3>Survey & Site Settings</h3>
		</div>

<?php 
if(isset($firstinstall) && $firstinstall==1){$firsttime ==1;}
	
if  (($OKE6[0] ==0) && $firsttime ==1) {echo 'You do not have permission to access'; exit;} ?>
<form name ="settings" id="settings" action="write_settings.php" method="post"> 
<div id="settingsbox">
<h3>Survey Settings</h3>
<h4>This area allows you to configure the standard delivery Survey Method included with the script.</h4>
Use Default Survey Delivery Method?
<select name="devmethod">
<option  <?php if ($sdevmethod=='1') {echo 'selected="selected"';}?> value="1">Enable</option>
<option  <?php if ($sdevmethod=='0') {echo 'selected="selected"';}?> value="0">Disable</option>
</select>
</br>
</br>
<label>Text For Pop Up :</label></br> 
<textarea cols="40" rows="5" name="popuptext"><?php if (isset($spopuptext)) {echo $spopuptext;} else {echo '';}?></textarea></br>
</br>
<label for="randomsurvey">Survey shown to every nth visitor: </label><input type="text" size ="2" name="randomsurvey"  value="<?php if (isset($srandomsurvey)) {echo $srandomsurvey;} else {echo '';}?>"/></br>
</br>
<label for="delaytime">Time to wait before survey shown (seconds): </label><input type="text" size ="2" name="delaytime"  value="<?php if (isset($sdelaytime)) {echo $sdelaytime;} else {echo '';}?>"/></br>
</br>



IP Filter To Reduce Repeated Feedback: 
<select name="iprestrict">
<option  <?php if ($siprestrict=='1') {echo 'selected="selected"';}?> value="1">Enable</option>
<option  <?php if ($siprestrict=='0') {echo 'selected="selected"';}?> value="0">Disable</option>
</select>
</br>
</div>

<div id="settingsboxright">
<h3>Feedback Settings</h3>
<h4>Change how people interact with you, and how they communicate after the survey.</h4>
Allow  Additional Survey Feedback?
<select name="feedback">
<option  <?php if ($sfeedback=='1') {echo 'selected="selected"';}?> value="1">Enable</option>
<option  <?php if ($sfeedback=='0') {echo 'selected="selected"';}?> value="0">Disable</option>
</select>
</br>
</br>
<label for="samail">Email To Get Feedback: </label> <input type="text" name="samail" value="<?php if (isset($ssamail)) {echo $ssamail;} else {echo '';}?>"/></br>
</br>

</div>

<div id="settingsboxright">
<h3>Piwik Analytics</h3>
<h4>See your site Piwik data</h4>
Enable Piwik Analytics Tab?
<select name="piwikan">
<option <?php if ($spiwikan=='1') {echo 'selected="selected"';}?> value="1">Enable</option>
<option  <?php if ($spiwikan=='0') {echo 'selected="selected"';}?> value="0">Disable</option>
</select>
</br></br>
<label for="piwik_site_id">Site id: </label> <input type="text" size= "3" name="piwik_site_id" value="<?php if (isset($spiwik_site_id)) {echo $spiwik_site_id;} else {echo '';}?>" /></br>
</br>
<label for="piwik_path">Install Path: </label> <input type="text" name="piwik_path" value="<?php if (isset($spiwik_path)) {echo $spiwik_path;} else {echo '';}?>"/></br>
</br>
<label for="piwik_api">Auth Token: </label> <input type="text" name="piwik_api" value="<?php if (isset($spiwik_api)) {echo $spiwik_api;} else {echo '';}?>"/></br>
</div>
</br>




<div id="submitsettingsbox">
<input type="submit" value="Update Settings" id="settings" onclick = "return showMessage()"/> <!--update withoutleaving-->
</form>
</div>


<script type = "text/javascript">
function showMessage() {
alert ("Settings Updated!");
return true;
}
</script>


		</div>

		<div id="sidebar">
  				<ul>
                	                          
                  <li><h3><a href="<?php echo $domain ?>/useradmin/users.php" class="user">Users</a></h3>
          				<ul>
                            <li><a href="<?php echo $domain ?>/useradmin/users.php#addnew" class="useradd">Add user</a></li>
                            <li><a href="<?php echo $domain ?>/useradmin/users.php#edit" class="useredit">Edit User</a></li>
                        </ul>
                    </li>
				</ul>       
          </div>
		
		
			
				<div id="footer">
				<!--Template inspired by Bloganje-->
				Created by Adrian Speyer.
				</div>

        
</div>
</body>
</html>

