<?php
require '../config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All Records Deleted</title>
<style type="text/css" title="currentStyle">
			@import "../css/demo_page.css";
			@import "../css/demo_table.css";
		</style>
		


<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/theme1.css" />
<link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
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
					<?php if ($OKE6[0] ==1){echo '<li><a href="'.$domain.'/admin/settings.php">Settings</a></li>';}?>
              </ul>
          </div>
      </div>
        <div id="top-panel">
            <div id="panel">
                <ul>			
					<?php if  ($OKE2[0] ==1) {echo '<li><a href="javascript:window.print()" class="print"> Print Report</a></li>';} else {echo '';}?>
					<?php if  ($OKE1[0] ==1) {echo '<li><a href="'.$domain.'/admin/export.php" class="report">Export Visitor Log</a></li>';} else {echo '';}?>
					<?php if  ($OKE3[0] ==1) {echo ' <li><a href="'.$domain.'/admin/delete.php"  class="delete_report"  onclick="return confirm(\'Are You Ready To Delete All Records?\');">Clear All Records</a></li>';} else {echo '';}?>
                </ul>
            </div>
      </div>
        <div id="wrapper">
            <div id="deletecontent">
<?php if  ($OKE3[0] ==0){echo 'You do not have permission'; exit;} ?>



<?php

//database connection

mysql_select_db("$database", $con);


mysql_query("DELETE FROM `$database`.`$table` WHERE `id` IS NOT NULL ");
echo (mysql_affected_rows()) ? "Your are ready to start fresh.<br /> " : "Sorry nothing was deleted.<br /> "; 

mysql_query("DELETE FROM `$database`.`$iptable` WHERE `id` IS NOT NULL ");
echo (mysql_affected_rows()) ? "All country data deleted.<br />" : " ";

mysql_query("DELETE FROM `$database`.`$impression` WHERE `surveyname` IS NOT NULL ");
echo (mysql_affected_rows()) ? "All impressions deleted.<br />" : " ";

mysql_query("DELETE FROM `$database`.`$blanks` WHERE `id` IS NOT NULL ");
echo (mysql_affected_rows()) ? " " : " ";


echo '<img style="width: 97px; height: 100px;" alt="plain" title="plain"
src="'.$domain.'/images/tango-face-plain-th.png"></br>All your records are gone. Time to get more data so we can have fun again.';
?>

</br>
</br>

<a href='results.php'>Back To Reports</a>

</div></div></div></div>