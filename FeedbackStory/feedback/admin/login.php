<?php
require '../config.php';
$registered=TRUE;

// Define 
if (isset($_POST["email"])){
$email=$_POST['email'];
$password=$_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
$email = stripslashes($email);

$email = mysql_real_escape_string($email);
$uc = mysql_query("SELECT email, password FROM $database.$utable WHERE ((email='".$email."') AND (password = AES_ENCRYPT('".$password."','".$pkey."')))");
while($uck = mysql_fetch_array($uc)) {
$count=mysql_num_rows($uc);
//echo $count;
}}

//Check if a user has logged-in

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] == FALSE;
}

if (isset($_POST["email"])){
if (!($fetch = mysql_fetch_array( mysql_query("SELECT `email` FROM $database.$utable WHERE `email`='$email'")))) {
$registered=FALSE;
}}


//Match password decrypt
if (isset($_POST["password"])){
if (!($fetch2 = mysql_fetch_array( mysql_query("SELECT `email`,`password` FROM $database.$utable WHERE  `email`='$email' AND `password` = AES_DECRYPT(`password`,'$pkey') AS unencrypted ")))) {
$registered=FALSE;
}}



if(isset($count) && $count==1){

// create session 
//session_regenerate_id();
$_SESSION['email'] = $_POST['email'];
$_SESSION['logged_in'] = TRUE;


header("location:".$domain."admin/results.php"); 
}
else

if (!$_SESSION['logged_in']): 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Web Visitor Feedback</title>
      <link rel="STYLESHEET" type="text/css" href="../css/login.css" />
	   <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">	  
	   <script type="text/javascript" language="JavaScript">
function are_cookies_enabled()
{
	var cookieEnabled = (navigator.cookieEnabled) ? true : false;

	if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled)
	{ 
		document.cookie="testcookie";
		cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
	}
	return (cookieEnabled);
}
</script>

</head>
<body>

<div id='loginform'>
<center>
<br>


<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
	<fieldset>
	<legend>Feedback Story</legend>
	<p><b>Email Address:</b> <input type="text" name="email" size="20" /></p>
	<p><b>Password:</b> <input type="password" name="password" size="20" /></p>
	<div align="center"><input type="submit" name="submit" value="Login" /></div>
	<input type="hidden" name="submitted" value="TRUE" />
	</fieldset>
</form>


<?php if ($registered==FALSE) echo '<font color="red">Please enter valid username and password.</font>'; ?><br /></p>

<p align="center"><font size="+1" color="red"><strong>
<script type="text/javascript">
if (are_cookies_enabled())
{
    document.write("");
}
else
{
    document.write("You have cookies DISABLED. Please enable to proceed.");
}
</script>
</strong></font></p>

 <a href="resetpass.php">Forgot Password</a>
 </center>
 </div>
</body>
<?php
exit();
endif;
?>

