<?php
ob_start();
include '../config.php';
echo header("Location: ".$domain."/admin/login.php");
ob_flush(); 
exit;
?>