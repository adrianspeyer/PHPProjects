
<?php
require '../config.php';
mysql_select_db("$database", $con);
  session_start();

$groupname = array(
    "1"  => "Limited",
    "2" => "Marketing",
    "3" => "Reporter",
	"4" => "Admin"
);

$g1 = $groupname[1];
$g2 = $groupname[2];
$g3 = $groupname[3];
$g4 = $groupname[4];

//ulimited
if (!empty($_POST[$g1][1])) {$value1 = $_POST[$g1][1];} else {$value1 = '0';};
if (!empty($_POST[$g1][2])) {$value2 = $_POST[$g1][2];} else {$value2 = '0';};
if (!empty($_POST[$g1][3])) {$value3 = $_POST[$g1][3];} else {$value3 = '0';};
if (!empty($_POST[$g1][4])) {$value4 =  $_POST[$g1][4];} else {$value4 = '0';};
if (!empty($_POST[$g1][5])) {$value5 =  $_POST[$g1][5];} else {$value5 = '0';};
if (!empty( $_POST[$g1][6])) {$value6 = $_POST[$g1][6];} else {$value6 = '0';};

//marketing
if (!empty($_POST[$g2][1])) {$value7 = $_POST[$g2][1];} else {$value7 = '0';};
if (!empty($_POST[$g2][2])) {$value8 = $_POST[$g2][2];} else {$value8 = '0';};
if (!empty($_POST[$g2][3])) {$value9 = $_POST[$g2][3];} else {$value9 = '0';};
if (!empty($_POST[$g2][4])) {$value10 =  $_POST[$g2][4];} else {$value10 = '0';};
if (!empty($_POST[$g2][5])) {$value11 =  $_POST[$g2][5];} else {$value11 = '0';};
if (!empty( $_POST[$g2][6])) {$value12 = $_POST[$g2][6];} else {$value12 = '0';};

//reporter
if (!empty($_POST[$g3][1])) {$value13 = $_POST[$g3][1];} else {$value13 = '0';};
if (!empty($_POST[$g3][2])) {$value14 = $_POST[$g3][2];} else {$value14 = '0';};
if (!empty($_POST[$g3][3])) {$value15 = $_POST[$g3][3];} else {$value15 = '0';};
if (!empty($_POST[$g3][4])) {$value16 =  $_POST[$g3][4];} else {$value16 = '0';};
if (!empty($_POST[$g3][5])) {$value17 =  $_POST[$g3][5];} else {$value17 = '0';};
if (!empty( $_POST[$g3][6])) {$value18 = $_POST[$g3][6];} else {$value18 = '0';};

//radmin
if (!empty($_POST[$g4][1])) {$value19 = $_POST[$g4][1];} else {$value19 = '0';};
if (!empty($_POST[$g4][2])) {$value20 = $_POST[$g4][2];} else {$value20 = '0';};
if (!empty($_POST[$g4][3])) {$value21 = $_POST[$g4][3];} else {$value21 = '0';};
if (!empty($_POST[$g4][4])) {$value22 =  $_POST[$g4][4];} else {$value22 = '0';};
if (!empty($_POST[$g4][5])) {$value23 =  $_POST[$g4][5];} else {$value23 = '0';};
if (!empty( $_POST[$g4][6])) {$value24 = $_POST[$g4][6];} else {$value24 = '0';};



$group1 = "UPDATE  $gtable SET 
 `export` =  '{$value1}',   
 `print` =  '{$value2}',   
 `clear` =  '{$value3}',   
 `stats` =  '{$value4}',
  `userset` =  '{$value5}',   
  `siteset` =  '{$value6}'
 WHERE `groupname` = '$g1'"; 
 	if (!mysql_query($group1,$con))
  {
  die('Error: ' . mysql_error());
  }

$group2 = "UPDATE  $gtable SET 
 `export` =  '{$value7}',   
 `print` =  '{$value8}',   
 `clear` =  '{$value9}',   
 `stats` =  '{$value10}',
  `userset` =  '{$value11}',   
  `siteset` =  '{$value12}'
 WHERE `groupname` = '$g2'"; 
 	if (!mysql_query($group2,$con))
  {
  die('Error: ' . mysql_error());
  }

  $group3 = "UPDATE  $gtable SET 
 `export` =  '{$value13}',   
 `print` =  '{$value14}',   
 `clear` =  '{$value15}',   
 `stats` =  '{$value16}',
  `userset` =  '{$value17}',   
  `siteset` =  '{$value18}'
 WHERE `groupname` = '$g3'"; 
 	if (!mysql_query($group3,$con))
  {
  die('Error: ' . mysql_error());
  }

  
 $group4 = "UPDATE  $gtable SET 
 `export` =  '{$value19}',   
 `print` =  '{$value20}',   
 `clear` =  '{$value21}',   
 `stats` =  '{$value22}',
  `userset` =  '{$value23}',   
  `siteset` =  '{$value24}'
 WHERE `groupname` = '$g4'"; 
 	if (!mysql_query($group4,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);

echo header("Location: users.php");

?>