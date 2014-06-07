<?php
ob_start();
require '../config.php';

if (isset($_POST['submit'])) {
	
	if ($_POST['forgotpassword']=='') {
		echo 'Please Fill in Email.';
	}
	if(get_magic_quotes_gpc()) {
		$forgotpassword = htmlspecialchars(stripslashes($_POST['forgotpassword']));
	} 
	else {
		$forgotpassword = htmlspecialchars($_POST['forgotpassword']);
	}
	//Make sure it's a valid email address, last thing we want is some sort of exploit!
	if (!($_POST['forgotpassword'])) {
  		echo 'Email Not Valid - Must be in format of name@domain.tld';
	}
    // Lets see if the email exists
	 $sql =  mysql_query("SELECT count(*) as `email` FROM  `$database`.`$utable` WHERE `email` = '$forgotpassword'");
	 $emailfound = mysql_fetch_row(($sql)); 
     if ($emailfound[0] =='0') {
      echo 'Email Not Found!';
	  exit;
   }
   
	//Generate a RANDOM MD5 Hash for a password
	$random_password=md5(uniqid(rand()));
	
	//Take the first 8 digits and use them as the password we intend to email the user
	$emailpassword=substr($random_password, 0, 8);
	
	//Encrypt $emailpassword in MD5 format for the database
	$newpassword = md5($emailpassword);
	
        // Make a safe query
       	$sql="UPDATE $database.$utable SET `password` = AES_ENCRYPT('$newpassword','$pkey') WHERE `email` = '$forgotpassword'"; 
					if (!mysql_query($sql,$con))
					{ die('Could not update members: ' . mysql_error());}
					mysql_close($con);
				
//Email out the information
$subject = "Your New Password"; 
$message = "Your new password is as follows:
---------------------------- 
Password: $newpassword
---------------------------- 

This email was automatically generated."; 

                       
          if(!mail($forgotpassword, $subject, $message,  "FROM: Password Reset <$samail>")){ 
             die ("Sending Email Failed, Please Contact Site Admin! ($samail)"); 
          }else{ 
               echo 'New Password Sent!';
         } 
		
	}
	
else {
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Web Visitor Feedback</title>
      <link rel="STYLESHEET" type="text/css" href="../css/login.css" />
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">	     
</head>
<body>



<div id='loginform'>
<center>
      <form name="forgotpasswordform" action="" method="post">
	  <fieldset >
	  <legend>Forgot Password</legend>
        
       Enter your address below and we will email you a new password.
         <p><b>Email Address:</b> <input type="text" value="" name="forgotpassword" id="forgotpassword" /></p>
            <input type="submit" name="submit" value="Submit" class="mainoption" />
       
     </fieldset>
	</form>
	</center>
</div>
      <?
	   ob_flush(); }?>


