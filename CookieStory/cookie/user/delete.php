<? 

require('../admin/authenticate.php');

require '../admin/db_con.php';
$id = (int) $_GET['id']; 
$campaign_name = $_GET['campaign_name']; 
mysql_query("DELETE FROM `$database`.`$table` WHERE `id` = '$id' ");
echo (mysql_affected_rows()) ? "Campaign variables deleted.<br /> " : "Campaign variables not deleted.<br /> "; 

mysql_query("DELETE FROM `$database`.`$stable` WHERE `campaign_name` = '$campaign_name' ");
echo (mysql_affected_rows()) ? "Campaign stats deleted.<br /> " : "No stats to delete.<br /> "; 

// set path of unlink
$loggeduser = $_SESSION['username'];
$dcamp = $campaign_name;
$dcampfile = $loggeduser."/".$dcamp.'.php.txt';


if(is_writable($dcampfile)) {
  unlink($dcampfile);
  echo "Campaign file deleted.";
} else {
  echo "Campaign file is already deleted.";
}

?> 

</br>
<a href='../user/listing.php'>Back To Listings</a>