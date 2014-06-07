<?php
if (!isset($_SESSION)) {
  session_start();
  session_name('survey_form_story');
}
require '../config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Satisfaction Survey</title>
<link rel="stylesheet" type="text/css" href="css/survey.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


<script type="text/javascript">
var submitFormOkay = false;
$(window).on('beforeunload', function(){
 if (!submitFormOkay) {
  $.ajax({
        url: "empty_form.php",
        type: "POST",
		async: false,
		data: $("#form").serialize()
		
    });

  return 'Are you sure you want to leave?';
 } 
});

</script>

<script type="text/javascript">
function validateForm()
{
var x=document.forms["satisfaction"]["objective"].value;
var y=document.forms["satisfaction"]["getbetter"].value;
//var Z=document.forms["satisfaction"]["country"].value;
if ((x==null || x=="") || (y==null || y==""))
  {
  alert("Some fields are empty. We need them all for accuracy.");
  return false;
  }
}
</script>
</head>

<body>
	<div id="titleWrap">
    	<h1>Satisfaction Survey</h1>
    </div>

	<div id="contentWrap">
  
       	  <div id="pollWrap">

	  
<form name="satisfaction" id="form" action="insert_form.php" onsubmit="return validateForm();" method="post">
<center>
<p><b>How would you rate your experience today?</b></p>
<br>
<table style="text-align: center; width: 10%;" border="0" cellpadding="2"
cellspacing="2">
<tbody>
<tr>
<td style="vertical-align: top;"><img
style="width: 97px; height: 100px;" alt="sad" title="sas"
src="images/tango-face-sad-th.png"></td>
<td style="vertical-align: top;"><img
style="width: 97px; height: 100px;" alt="neutral" title="neutral"
src="images/tango-face-plain-th.png"></td>
<td style="vertical-align: top;"><img
style="width: 97px; height: 100px;" alt="smile" title="smile"
src="images/tango-face-smile-th.png"></td>
</tr>
<tr>
<td style="vertical-align: top;"><input name="happy" value="1"
type="radio"></td>
<td style="vertical-align: top;"><input name="happy" value="5"
type="radio"></td>
<td style="vertical-align: top;"><input name="happy" value="10"
type="radio"></td>
</tr>
</tbody>
</table>
</center>
<br>
<hr>

<p><b>Did you acheive the goal of your visit today?</b></p>
<input type="radio" name="success" value="1" /> Yes
<input type="radio" name="success" value="2" /> No
<hr>

<p><b>What was the objective of your visit today?</b></p>
<textarea cols="50" rows="2" name="objective"></textarea>
<hr>
<p><b>If we could do one thing better, what could we do?</b></p>
<textarea cols="50" rows="4" name="getbetter"></textarea>
<hr>
<input type="hidden" name="page" value="<?php  if(isset($_SERVER['HTTP_REFERER'])){echo $_SERVER['HTTP_REFERER'];} else {echo $_SERVER['REQUEST_URI'];}?>"/>
<input type="hidden" name="loggedip" value="<?php echo $_SERVER['REMOTE_ADDR']?>"/>


<!--This is to get user country info-->
<?php 
//comment out if you use MAXMIND Database
echo '<p><b>To help best categorize your feedback,</br>
 please let us know your country:</b></p>';
include 'country-menu.php'; 
?>


<?php
/*
//GEOIP for maxmind
include("/geo/geoip.inc");
$gi = geoip_open("./geo/GeoIP.dat",GEOIP_STANDARD);
$ip = $_SERVER['REMOTE_ADDR'];
$country=  geoip_country_name_by_addr($gi, $ip) . "\n";
echo '<input type="hidden" name="country" value="'.$country.'"/>';
geoip_close($gi);
//END GEOIP Maxmind
*/
?>

<center><p><input type="image" SRC="images/submit.png" height="67" width="71" border="0" name="submit" alt="Submit Form" onclick="submitFormOkay = true;"></p></center>

</form>
			</div> 
<?php echo "<img  width=0 height=0 src=\"$domain/fpoll/impressioncounter.php\" onload=\"trackimpression()\">"; ?>

    </div>
	<br>
		<div id="headerWrap">
    	<strong>Thanks for taking the time to make us better!</strong>.
    </div>
</body>
</html>

