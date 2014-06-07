
<?php




if (isset($_POST['surveryusername'])) {
$surveryusername = preg_replace('#[^\w()/.%\-&]#'," ",$_POST['surveryusername']);






echo header("Location: ./emailthanks.php");
?>
