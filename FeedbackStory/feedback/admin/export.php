<?php

error_reporting(0);
	<?php if  ($OKE1[0] ==0){echo 'You do not have permission to access'; exit;} ?>
//database connection
require '../config.php';
require 'login.php';

$select = "SELECT * FROM $database.$table";

$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );

$fields = mysql_num_fields ( $export );

for ( $i = 0; $i < $fields; $i++ )
{
$header .= mysql_field_name( $export , $i ) . "\t";
}

while( $row = mysql_fetch_row( $export ) )
{
// The below allows the excel to have the rigth values    
if ($row[1] =='1') $row[1]  = 'Unhappy';
if ($row[1] =='5') $row[1]  = 'Neutral';
if ($row[1] =='10') $row[1]  = 'Happy';
if ($row[2] =='1') $row[2]  = 'Successful';
if ($row[2] =='2') $row[2]  = 'Not Successful';
//end of word fix.	

	$line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";                        
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=customer_objective_log".date('Ymd').".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";