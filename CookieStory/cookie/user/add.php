<?php
require('../admin/authenticate.php');
?>
<html>
<body>
<h1>Cookie Story:Add A Campaign</h1>

Welcome, 
<?php
$loggeduser = $_SESSION['username'];
echo $loggeduser;
?>

<form action="../user/insert.php" method="post">
Campaign Name: <input type="text" name="campaign_name"/><br> <!--check that there are no spaces, add _ for spaces-->
Customer Variable: <input type="text" name="custvar1"/> Image Path: <input size="30" type="text" name="custvarimg1"/>
Alt text: <input type="text" name="altext1"/> Title Tag text: <input type="text" name="titletext1"/> URL Link: <input size="30" type="text" name="link1"/><br>

Customer Variable: <input type="text" name="custvar2"/> Image Path: <input size="30" type="text" name="custvarimg2"/>
Alt text: <input type="text" name="altext2"/> Title Tag text: <input type="text" name="titletext2"/>URL Link: <input size="30" type="text" name="link2"/><br>

Customer Variable: <input type="text" name="custvar3"/> Image Path: <input size="30" type="text" name="custvarimg3"/>
Alt text: <input type="text" name="altext3"/> Title Tag text: <input type="text" name="titletext3"/>URL Link: <input size="30" type="text" name="link3"/><br>

Customer Variable: <input type="text" name="custvar4"/> Image Path: <input size="30" type="text" name="custvarimg4"/>
Alt text: <input type="text" name="altext4"/> Title Tag text: <input type="text" name="titletext4"/>URL Link: <input size="30" type="text" name="link4"/><br>

Customer Variable: <input type="text" name="custvar5"/> Image Path: <input size="30" type="text" name="custvarimg5"/>
Alt text: <input type="text" name="altext5"/> Title Tag text: <input type="text" name="titletext5"/> URL Link: <input size="30" type="text" name="link5"/><br>
<br>

Mobile Banner Image: <input type="hidden" name="custvarM" value="<?php echo "Mobile" ?>"/> <input size="30" type="text" name="custvarimgM"/>
Alt text: <input type="text" name="altextM"/> Title Tag text: <input type="text" name="titletextM"/> Mobile URL Link: <input size="30" type="text" name="linkM"/><br>
<br>

Default Banner Image:  <input size="30"type="text" name="defaultbanner"/>  Default Link: <input size="30" type="text" name="defaultlink"/>
Alt text: <input type="text" name="defaultaltext"/> Title Tag text: <input type="text" name="defaulttitletext"/> 
<br>
<br>
Your Custom Variables Provider? 
			<select name="analyticspack">
            <option value="_pk_cvar"<?php if(!empty($row['analyticspack']) and ($row['analyticspack'] == "_pk_cvar")){ echo(" selected=\"selected\""); } ?>>PIWIK</option>
            <option value="__utmv"<?php if(!empty($row['analyticspack']) and ($row['analyticspack'] == " __utmv")){ echo(" selected=\"selected\""); } ?>>GOOGLE</option>
        </select>
		<br>
<br>

Add Cookie Notice To Banner? 
			<select name="cookienotice">
            <option value="YES"<?php if(!empty($row['cookienotice']) and ($row['cookienotice'] == "YES")){ echo(" selected=\"selected\""); } ?>>ENABLE</option>
            <option value=""<?php if(!empty($row['cookienotice']) and ($row['cookienotice'] == "")){ echo(" selected=\"selected\""); } ?>>DISABLE</option>
        </select>
		<br>


<input type="hidden" name="created_at" value="<?php  date_default_timezone_set('America/New_York'); echo date("Y-m-d H:m:s")?>"/>
<input type="hidden" name="user" value="<?php echo $loggeduser ?>"/>
<p><input type="submit" /></p>
</form>

</body>
</html>
