<?php
session_start();
require('config.php');
function sanitize($data){
$data=trim($data);
$data=htmlspecialchars($data);
return $data;
}
unset($_SESSION['username']);
$signature= sanitize($_GET['signature']);
if ($signature === $_SESSION['signature']) {
//authenticated user request
$_SESSION['logged_in'] = False;
session_destroy();   
session_unset();     
echo 'You have successfully logged out! Thank you.<br /><br />';
echo header("Location: ../admin/index.php"); 
?>

<?php
} else {
//unauthorized logout
header(sprintf("Location: %s", $forbidden_url));	
exit;  
}
?>