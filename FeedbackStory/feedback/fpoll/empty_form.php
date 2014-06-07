<?php
require '../config.php';

$data = $_POST; 

//var_dump($data);

 if(!empty($data['happy']))
 { $value1 = '0'; } else { $value1 = '1';}
 
  if(!empty($data['success']))
 { $value2 = '0'; } else { $value2 = '1';}
 
 if(!empty($data['objective']))
 { $value3 = '0'; } else { $value3 = '1';}

 if(!empty($data['getbetter']))
 { $value4 = '0'; } else { $value4 = '1';}
 
 if(!empty($data['country']))
 { $value5 = '0'; } else { $value5 = '1';}



mysql_select_db("$database");
$update = "INSERT INTO $blanks (id,value1, value2,value3,value4,value5) 

VALUES  (
'1',
'$value1',
'$value2',
'$value3',
'$value4',
'$value5'
)

ON DUPLICATE KEY
UPDATE 
`value1`= `value1`+".$value1.",
`value2`= `value2`+".$value2.",
`value3`= `value3`+".$value3.",
`value4`= `value4`+".$value4.",
`value5`= `value5`+".$value5.";";

if (!mysql_query($update))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);
?>