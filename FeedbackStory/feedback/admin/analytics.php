<?php
require '../config.php';
require 'login.php';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Site Analytics</title>
<style type="text/css" title="currentStyle">
			@import "css/data_page.css";
			@import "css/data_table.css";
		</style>
		

<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
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
                <?php if ($OKE4[0] ==1){if ($piwikan=='1') {echo '<li class="current"><a href="'.$domain.'admin/analytics.php">Site Analytics</a></li>';}}?> 
				 <?php if ($OKE6[0] ==1){echo '<li><a href="'.$domain.'/admin/settings.php">Settings</a></li>';}?>
				 <li><a href="<?php echo $domain ?>admin/logout.php" onclick="return confirm('Are You Ready To Logout?');" >Log Out</a></li>
				
              </ul>
          </div>
      </div>

        <div id="wrapper">	
		
		<?php if  ($OKE4[0] ==1) {?>
<iframe src="<?php echo $piwik_path?>/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Dashboard&actionToWidgetize=index&idSite=<?php echo $piwik_site_id?>&period=week&date=yesterday&token_auth=<?php echo $piwik_api ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="2500px" scrolling="no" ></iframe>

<?php } else {?>

  <div id="content">
You do not have access to view Analytics Data. Please talk to the admin of this application.
<?php }?>

</div></div></div></div>