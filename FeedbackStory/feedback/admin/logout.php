<?php
ob_start();
require '../config.php';
unset($_SESSION['email']);
if ($_SESSION['logged_in'] == TRUE) {
$_SESSION['logged_in'] == FALSE;
session_destroy();   
session_unset();     
echo 'You have successfully logged out! Thank you.<br /><br />';
echo header("Location: login.php"); 
}
ob_flush();
?>