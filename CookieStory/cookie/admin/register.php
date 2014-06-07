<?php

require('../admin/authenticate.php');

require('../admin/db_con.php');

session_start(); 
//pre-define validation parameters

$usernamenotempty=TRUE;
$usernamevalidate=TRUE;
$usernamenotduplicate=TRUE;
$passwordnotempty=TRUE;
$passwordmatch=TRUE;
$passwordvalidate=TRUE;

//Check if user submitted the desired password and username
if ((isset($_POST["desired_password"])) && (isset($_POST["desired_username"])) && (isset($_POST["desired_password1"])))  {
	
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


$desired_username=sanitize($_POST["desired_username"]);
$desired_password=sanitize($_POST["desired_password"]);
$desired_password1=sanitize($_POST["desired_password1"]);
$rolelevel=($_POST["rolelevel"]);

//validate username

if (empty($desired_username)) {
$usernamenotempty=FALSE;
} else {
$usernamenotempty=TRUE;
}

if ((!(ctype_alnum($desired_username))) || ((strlen($desired_username)) >11)) {
$usernamevalidate=FALSE;
} else {
$usernamevalidate=TRUE;
}

if (!($fetch = mysql_fetch_array( mysql_query("SELECT `username` FROM $authtable WHERE `username`='$desired_username'")))) {
//no records for this user in the MySQL database
$usernamenotduplicate=TRUE;
}
else {
$usernamenotduplicate=FALSE;
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




if (($usernamenotempty==TRUE)
&& ($usernamevalidate==TRUE)
&& ($usernamenotduplicate==TRUE)
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
mysql_query("INSERT INTO $authtable (`username`, `password`, `rolelevel`) VALUES ('$desired_username', '$hashedpassword','$rolelevel')") or die(mysql_error());



//redirect to login page
header(sprintf("Location: %s", $registerpage_url));	
exit;
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Add A User</title>
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
<h1>User Registration Form</h1>
<br />
Add user to your Cookie Story. You will be redirected to a confirmation page after successful registration.
<br /><br />
<!-- Start of registration form -->
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">



					<label class="grey" for="username">Username:</label>
					<input type="text" class="<?php if (($usernamenotempty==FALSE) || ($usernamevalidate==FALSE) || ($usernamenotduplicate==FALSE))  echo "invalid"; ?>" id="desired_username" name="desired_username"></br>
					</br>
					<label class="grey" for="password">Password:</label>
					<input name="desired_password" type="password" class="<?php if (($passwordnotempty==FALSE) || ($passwordmatch==FALSE) || ($passwordvalidate==FALSE)) echo "invalid"; ?>" id="desired_password" ></br>
					</br>
					<label class="grey" for="password1">Type Password Again</label>
					<input name="desired_password1" type="password" class="<?php if (($passwordnotempty==FALSE) || ($passwordmatch==FALSE) || ($passwordvalidate==FALSE)) echo "invalid"; ?>" id="desired_password1" ></br>
					</br>
					<label class="grey" for="rolelevel">Permision Level:</label>
						<select name="rolelevel">
						<option value="0">Admin</option>
						<option value="1" selected="true">Regular User</option>
						</select>
						</br>
						<input type="submit" name="submit" value="Register" class="bt_register" />
						<div id="tips"><h6>Please note: Username should be alphanumeric less than 12 characters.</br>
						Password should be alphanumeric and greater than 8 characters.</h6></div>
						</form>			
<!-- Display validation errors -->
<?php if ($usernamenotempty==FALSE) echo '<font color="red">You have entered an empty username.</font><br />'; ?>
<?php if ($usernamevalidate==FALSE) echo '<font color="red">Your username should be alphanumeric and less than 12 characters.</font><br />'; ?>
<?php if ($usernamenotduplicate==FALSE) echo '<font color="red">Please choose another username, your username is already used.</font><br />'; ?>
<?php if ($passwordnotempty==FALSE) echo '<font color="red">Your password is empty.</font><br />'; ?>
<?php if ($passwordmatch==FALSE) echo '<font color="red">Your password does not match.</font><br />'; ?>
<?php if ($passwordvalidate==FALSE) echo '<font color="red">Your password should be alphanumeric and greater 8 characters.</font><br />'; ?>
<a href="../user/listing.php">Back to Homepage</a><br />

</div></div></div></div>
<!-- End of registration form -->
</body>
</html>