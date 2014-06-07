<!DOCTYPE HTML>
<?php
require('../admin/authenticate.php');
session_start(); 
?>
<html>
<head>
<title>User Confirmation</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../admin/login_panel/css/admin.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../admin/login_panel/css/slide.css" media="screen" />
</head>
<body >
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
	<div class="register">
<h1>User registration Confirmation</h1>
<br />

					<label class="grey" for="username">Username:<div class="vallab"><?php echo $_SESSION['desired_username']; ?></div></label>
					</br>
					<label class="grey" for="password">Password:<div class="vallab"><?php echo $_SESSION['desired_password'];?></div></label>
					</br>
					<label class="grey" for="rolelevel">Rolelevel:<div class="vallab">	<?php	if ($_SESSION['rolelevel']==TRUE) {echo 'Regular User';} else {echo 'Admin';}?></div></label></br>
					</br>		
<a href="../user/listing.php">Login</a><br />

</div></div></div>
<!-- End of registration form -->
<?php session_unset();     ?>
</body>
</html>