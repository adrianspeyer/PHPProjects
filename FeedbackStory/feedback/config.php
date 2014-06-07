<?php 
if(!isset($_SESSION)) { session_start(); }
error_reporting(0);
//This is the temp config
include 'db_con.php';
include 'useradmin/group_perm.php';
$firstinstall = '1';
?>