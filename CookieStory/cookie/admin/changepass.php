<?php

require('../admin/authenticate.php');
require('../admin/db_con.php');

 session_start(); 
//pre-define validation parameters

$desired_username = $_SESSION['username'];

$passwordnotempty=TRUE;
$passwordmatch=TRUE;
$passwordvalidate=TRUE;


//rolelevel

$rolechg = mysql_query("SELECT `rolelevel` FROM $authtable WHERE `username`='$desired_username'");
if (!$rolechg) {
    die('Could not query:' . mysql_error());
}
$permission = mysql_result($rolechg, 0);


//Check if user submitted the desired password and username
if ((isset($_POST["desired_password"])) && (isset($_POST["desired_password1"])))  {
	
//Username and Password has been submitted by the user
//Receive and validate the submitted information

//sanitize user inputs

function sanitize($data){
$data=trim($data);
$data=htmlspecialchars($data);
$data=mysql_real_escape_string($data);
return $data;
}


//SESSION FOR CONFIRMATION

$_SESSION['desired_username'] = $_POST['desired_username'];
$_SESSION['desired_password'] = $_POST['desired_password'];
$_SESSION['rolelevel'] = $_POST['rolelevel'];

$permission = $_POST['rolelevel'];

$desired_password=sanitize($_POST["desired_password"]);
$desired_password1=sanitize($_POST["desired_password1"]);


//validate username
if (!($fetch = mysql_fetch_array( mysql_query("SELECT `username`, `rolelevel` FROM $authtable WHERE `username`='$desired_username'")))) {
//no records for this user in the MySQL database
$usernamexists=FALSE;
}
else {
$usernamexists=TRUE;
}


//validate password
if (empty($desired_password)) {
$passwordnotempty=FALSE;
} else {
$passwordnotempty=TRUE;
}

if ((!(ctype_alnum($desired_password))) || ((strlen($desired_password)) < 8)) {
$passwordvalidate=FALSE;
} else {
$passwordvalidate=TRUE;
}

if ($desired_password==$desired_password1) {
$passwordmatch=TRUE;
} else {
$passwordmatch=FALSE;
}

if (($usernamexists==TRUE)
&& ($passwordnotempty==TRUE)
&& ($passwordmatch==TRUE)
&& ($passwordvalidate==TRUE))
 {
//The username, password and recaptcha validation succeeds.

//Hash the password
//This is very important for security reasons because once the password has been compromised,
//The attacker cannot still get the plain text password equivalent without brute force.

function HashPassword($input)
{
//Credits: http://crackstation.net/hashing-security.html
//This is secure hashing the consist of strong hash algorithm sha 256 and using highly random salt
$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)); 
$hash = hash("sha256", $salt . $input); 
$final = $salt . $hash; 
return $final;
}

$hashedpassword= HashPassword($desired_password);

//Insert username and the hashed password to MySQL database
//mysql_query("UPDATE $authtable (`username`, `password`, `rolelevel`) VALUES ('$desired_username', '$hashedpassword','$permission') WHERE `username` = '$desired_username' ") or die(mysql_error());
mysql_query("UPDATE $authtable SET `password` = '$hashedpassword' , `rolelevel` = '$permission' WHERE `username` = '$desired_username' ") or die(mysql_error());


//message
header(sprintf("Location: ../admin/passchangeok.php"));	
exit;
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Change Password</title>
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
<h1>Change Permission/Password Form</h1>
<br />
Change your permission/password in the handy form below.
<br /><br />
<!-- Start of registration form -->
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">



					<label class="grey" for="username">Username: <?php echo $desired_username ?></label>
					<input type="hidden" value="<?php echo $desired_username ?> id="desired_username" name="desired_username"> 	</br>
					</br>
					<label class="grey" for="password">Password:</label>
					<input name="desired_password" type="password" class="<?php if (($passwordnotempty==FALSE) || ($passwordmatch==FALSE) || ($passwordvalidate==FALSE)) echo "invalid"; ?>" id="desired_password" ></br>
					</br>
					<label class="grey" for="password1">Type Password Again</label>
					<input name="desired_password1" type="password" class="<?php if (($passwordnotempty==FALSE) || ($passwordmatch==FALSE) || ($passwordvalidate==FALSE)) echo "invalid"; ?>" id="desired_password1" ></br>
					</br>
					<?php if($permission==0){ ?>
						<label class="grey" for="rolelevel">Permision Level:</label>
						<select name="rolelevel">
						<option value="0" <?php if($permission==0) {echo 'selected="true"';} else {echo '';}?>>Admin</option>
						<option value="1" <?php if($permission==1) {echo 'selected="true"';} else {echo '';}?>>Regular User</option>			
					</select>
					<?php } ?>
					
					</br>
					<input type="submit" name="submit" value="Change" class="bt_register" />
						<div id="tips"><h6>Please note: Password should be alphanumeric and greater than 8 characters.</h6></div>
						</form>			
<!-- Display validation errors -->
<?php if ($passwordnotempty==FALSE) echo '<font color="red">Your password is empty.</font><br />'; ?>
<?php if ($passwordmatch==FALSE) echo '<font color="red">Your password does not match.</font><br />'; ?>
<?php if ($passwordvalidate==FALSE) echo '<font color="red">Your password should be alphanumeric and greater 8 characters.</font><br />'; ?>
<a href="../user/listing.php">Back to Listings</a><br />







</div></div></div></div>
<!-- End of registration form -->
</body>
</html>
	