<html>
<head>
</head>
<body>

<h1>Cookie Story </h1>
<p>This wizard will start you on your way. Input your database information</p>

<form action="setup2.php" method="post" name="install" id="install">
DB Host: <input type="text" name="dbhost" value="localhost" /> <br> 
DB Username: <input size="30" type="text" name="dbuname" value="root" /><br> 
DB Password: <input type="text" name="dbpass"/> <br> 
Database: <input type="text" name="dbname"/> <br> 
DB Prefix:<input type="text" name="prefix" value="pw_" /> </p>
<?php
$domain =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$cdomain =  strrev(strstr(strrev($domain),"/"));
$idomain = strstr( $cdomain, 'install', TRUE );
?>
URL Path to Install <input type="text" size="45" name="domain" value="<?php echo $idomain ?>" /> </p>
<p><input type="submit" name="Submit" value="install">  </p>
</form>

</body>
</html>



