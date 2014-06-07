<?php 
require '../config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Satisfaction Survey Thank You</title>
<link rel="stylesheet" type="text/css" href="<?php echo $domain ?>fpoll/css/survey.css" />
<script type="text/javascript">
function validateForm()
{
var x=document.forms["emactact"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }
}
</script>
</head>

<body>
<center>
	<div id="titleWrap">
    	<h1>Thanks for sharing!</h1>
    </div>


 <div id="thanksWrap">
<img style="width: 97px; height: 100px;" alt="happy thanks for sharing" title="happy thanks for sharing"
src="<?php echo $domain ?>/images/tango-face-smile-th.png">
</br>
<p>Your opinion has been shared with. Thank you for taking the time!</p>
</div>
<br>
<br>
<?php if ($feedback == '1'){?>
<div id="headerWrap">
<form name="emactact" action="emailform.php" onsubmit="return validateForm();" method="post">
<h2>Be contacted about your feedback.</h2>
<h3>Fill in the info below if you want us to contact you about your feedback.</h3>
<b>Name:</b><input type="text" name="surveryusername">
<b>Email Address:</b><input type="text" name="email"></br>
</br>
<b>If necessary, you can add a special note:</b></br>
<textarea cols="50" rows="2" name="specialnote"></textarea>

<input type="hidden" name="loggedip" value="<?php echo $_SERVER['REMOTE_ADDR']?>"/>
<center><p><input type="image" src="images/submit2sm.png" height="70" width="70" border="0" alt="Submit Form"></p></center>
</form>
<h6>We only use your email to contact you. It is not stored or used for any other purpose</h6>
</div> 
<?php }?>
	<br>
</center>	
</body>
</html>