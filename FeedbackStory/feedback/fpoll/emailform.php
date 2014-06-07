<?php
ob_start();
require '../config.php';
if (isset($_POST['surveryusername'])) {
$surveryusername = preg_replace('#[^\w()/.%\-&]#'," ",$_POST['surveryusername']);
$specialnote = preg_replace('#[^\w()/.%\-&]#'," ",$_POST['specialnote']);
}

if(!empty($specialnote)) 
{
$ifspecialnote = 'I have also included this special note, for your consideration: '.$specialnote;
}
else
{
$ifspecialnote = '';
}

$to = $samail; 
 $subject = "Request for Survey Follow Up"; 
 $email = $_SESSION['email'] ; 
 $message = "Hi, I'm ".$surveryusername."
 I want to hear back from you about my feedback. 
 ".$ifspecialnote."
 User Objective:".$_SESSION['objective']."
 How To Get Better:".$_SESSION['getbetter']."
 Logged IP: ".$_SESSION['loggedip']."";

 

 $headers = "From: $email"; 
 $sent = mail($to, $subject, $message, $headers) ; 
 if($sent) 
 {print "Your mail was sent successfully"; }
 else 
 {print "We encountered an error sending your mail"; }
echo header("Location: emailthanks.php");
ob_flush();
?>
