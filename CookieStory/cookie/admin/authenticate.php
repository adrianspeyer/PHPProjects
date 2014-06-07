<?php
/*
 * Modified version of  PHP Secure login system -- http://www.php-developer.org
 *
 *
 */

error_reporting(E_ALL ^ E_NOTICE);
 
session_start(); 

//require user configuration and database connection parameters
require('../admin/db_con.php');


if (($_SESSION['logged_in'])==TRUE) {

//valid user has logged-in to the website

//Check for unauthorized use of user sessions
$iprecreate= $_SERVER['REMOTE_ADDR'];
$useragentrecreate=$_SERVER["HTTP_USER_AGENT"];
$signaturerecreate=$_SESSION['signature'];

//Extract original salt from authorized signature

$saltrecreate = substr($signaturerecreate, 0, $length_salt);

//Extract original hash from authorized signature

$originalhash = substr($signaturerecreate, $length_salt, 40);

//Re-create the hash based on the user IP and user agent
//then check if it is authorized or not

$hashrecreate= sha1($saltrecreate.$iprecreate.$useragentrecreate);

if (!($hashrecreate==$originalhash)) {

//Signature submitted by the user does not matched with the
//authorized signature
//This is unauthorized access
//Block it

header(sprintf("Location: %s", $forbidden_url));	
exit;    
}

//Session Lifetime control for inactivity
//Credits: http://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes

if ((isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessiontimeout)))  {

session_destroy();   
session_unset();  

//redirect the user back to login page for re-authentication

$redirectback=$domain.'admin/';
header(sprintf("Location: %s", $redirectback));
}
$_SESSION['LAST_ACTIVITY'] = time(); 

}

//Pre-define validation
$validationresults=TRUE;
$registered=TRUE;


//Trapped brute force attackers and give them more hard work by providing a captcha-protected page

$iptocheck= $_SERVER['REMOTE_ADDR'];
$iptocheck= mysql_real_escape_string($iptocheck);

if ($fetch = mysql_fetch_array( mysql_query("SELECT `loggedip` FROM `$iptable` WHERE `loggedip`='$iptocheck'"))) {

//Already has some IP address records in the database
//Get the total failed login attempts associated with this IP address

$resultx = mysql_query("SELECT `failedattempts` FROM `$iptable` WHERE `loggedip`='$iptocheck'");
$rowx = mysql_fetch_array($resultx);
$loginattempts_total = $rowx['failedattempts'];

If ($loginattempts_total>$maxfailedattempt) {
	
//too many failed attempts allowed, redirect and give 403 forbidden.

header(sprintf("Location: %s", $forbidden_url));	
exit;
}
}

//Check if a user has logged-in

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = FALSE;
}

//Check if the form is submitted

if ((isset($_POST["pass"])) && (isset($_POST["user"])) && ($_SESSION['LAST_ACTIVITY']==FALSE)) {

//Username and password has been submitted by the user
//Receive and sanitize the submitted information


function sanitize($data){
$data=trim($data);
$data=htmlspecialchars($data);
$data=mysql_real_escape_string($data);
return $data;
}

$user=sanitize($_POST["user"]);
$pass= sanitize($_POST["pass"]);

//validate username
if (!($fetch = mysql_fetch_array( mysql_query("SELECT `username` FROM `$authtable` WHERE `username`='$user'")))) {

//no records of username in database
//user is not yet registered

$registered=FALSE;
}

if ($registered==TRUE) {

//Grab login attempts from MySQL database for a corresponding username
$result1 = mysql_query("SELECT `loginattempt` FROM `$authtable` WHERE `username`='$user'");
$row = mysql_fetch_array($result1);
$loginattempts_username = $row['loginattempt'];

}

if(($loginattempts_username>2) || ($registered==FALSE) || ($loginattempts_total>2)) {

//Require those user with login attempts failed records to 
//submit captcha and validate recaptcha


}

//Get correct hashed password based on given username stored in MySQL database

if ($registered==TRUE) {
	
//username is registered in database, now get the hashed password

$result = mysql_query("SELECT `password` FROM `$authtable` WHERE `username`='$user'");
$row = mysql_fetch_array($result);
$correctpassword = $row['password'];
$salt = substr($correctpassword, 0, 64);
$correcthash = substr($correctpassword, 64, 64);
$userhash = hash("sha256", $salt . $pass);
}
if ((!($userhash == $correcthash)) || ($registered==FALSE)) {

//user login validation fails

$validationresults=FALSE;

//log login failed attempts to database

if ($registered==TRUE) {
$loginattempts_username= $loginattempts_username + 1;
$loginattempts_username=intval($loginattempts_username);

//update login attempt records

mysql_query("UPDATE `$authtable` SET `loginattempt` = '$loginattempts_username' WHERE `username` = '$user'");

//Possible brute force attacker is targeting registered usernames
//check if has some IP address records

if (!($fetch = mysql_fetch_array( mysql_query("SELECT `loggedip` FROM `$iptable` WHERE `loggedip`='$iptocheck'")))) {
	
//no records
//insert failed attempts

$loginattempts_total=1;
$loginattempts_total=intval($loginattempts_total);
mysql_query("INSERT INTO `$iptable` (`loggedip`, `failedattempts`) VALUES ('$iptocheck', '$loginattempts_total')");	
} else {
	
//has some records, increment attempts

$loginattempts_total= $loginattempts_total + 1;
mysql_query("UPDATE $iptable` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");
}
}

//Possible brute force attacker is targeting randomly

if ($registered==FALSE) {
if (!($fetch = mysql_fetch_array( mysql_query("SELECT `loggedip` FROM `$iptable` WHERE `loggedip`='$iptocheck'")))) {
	
//no records
//insert failed attempts

$loginattempts_total=1;
$loginattempts_total=intval($loginattempts_total);
mysql_query("INSERT INTO `$iptable` (`loggedip`, `failedattempts`) VALUES ('$iptocheck', '$loginattempts_total')");	
} else {
	
//has some records, increment attempts

$loginattempts_total= $loginattempts_total + 1;
mysql_query("UPDATE `$iptable` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");
}
}
} else {
	
//user successfully authenticates with the provided username and password

//Reset login attempts for a specific username to 0 as well as the ip address

$loginattempts_username=0;
$loginattempts_total=0;
$loginattempts_username=intval($loginattempts_username);
$loginattempts_total=intval($loginattempts_total);
mysql_query("UPDATE `$authtable` SET `loginattempt` = '$loginattempts_username' WHERE `username` = '$user'");
mysql_query("UPDATE `$iptable` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");

//Generate unique signature of the user based on IP address
//and the browser then append it to session
//This will be used to authenticate the user session 
//To make sure it belongs to an authorized user and not to anyone else.
//generate random salt
function genRandomString() {
//credits: http://bit.ly/a9rDYd
    $length = 50;
    $characters = "0123456789abcdef";      
    for ($p = 0; $p < $length ; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    
    return $string;
}
$random=genRandomString();
$salt_ip= substr($random, 0, $length_salt);

//hash the ip address, user-agent and the salt
$useragent=$_SERVER["HTTP_USER_AGENT"];
$hash_user= sha1($salt_ip.$iptocheck.$useragent);

//concatenate the salt and the hash to form a signature
$signature= $salt_ip.$hash_user;

//Regenerate session id prior to setting any session variable
//to mitigate session fixation attacks

session_regenerate_id();

//Finally store user unique signature in the session
//and set logged_in to TRUE as well as start activity time

$_SESSION['signature'] = $signature;
$_SESSION['logged_in'] = TRUE;
$_SESSION['LAST_ACTIVITY'] = time(); 
$_SESSION['username'] = $_POST['user'];
//setcookie('member',$_POST["user"],time()+3600);
}
} 

if (!$_SESSION['logged_in']): 

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../admin/login_panel/css/admin.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../admin/login_panel/css/slide.css" media="screen" />
</head>
<body >
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
	<div class="login">
				<!-- Login Form -->
				<form class="clearfix" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
				<h1>Cookie Story Login</h1>
					</br>
					<label class="grey" for="username">Username:</label>
					<input type="text" class="<?php if ($validationresults==FALSE) echo "invalid"; ?>" id="user" name="user"></br>
					</br>
					<label class="grey" for="password">Password:</label>
					<input name="pass" type="password" class="<?php if ($validationresults==FALSE) echo "invalid"; ?>" id="pass" >
	           <?php if (($loginattempts_username > 2) || ($registered==FALSE) || ($loginattempts_total>2)) { ?>
			<?php } ?>
			<p>
			<?php if ($validationresults==FALSE) echo '<font color="red">Please enter valid username and password.</font>'; ?><br /></p>
			</br>
			<div class="clear"></div>
			<input type="submit" value="Login" class="bt_login" />         
</br>	
</br>			

		</div>
</form>

</div></div></div>
</body>
</html>
<?php
exit();
endif;
?>
