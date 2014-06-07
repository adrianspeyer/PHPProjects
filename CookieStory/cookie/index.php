<?php

$domain =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$cdomain =  strrev(strstr(strrev($domain),"/"));
$dir = 'install';
if(file_exists($dir) && is_dir($dir))
 echo 'You need to run install first. If you have, please delete the install directory before proceeding.<p><a href="'.$cdomain.'install/setup.php">Install Now</a></p>';
else
 echo header("Location: ../user/listing.php"); 
  ?>