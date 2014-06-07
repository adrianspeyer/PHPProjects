<?php

include("installsql.php");
$sql_dump = 'install.sql';



$link = @mysql_connect($dbhost, $dbuname, $dbpass);
				if($link){					
					                       
                        	// The following code creates the tables.
                        	$sql = explode(";",file_get_contents('install.sql'));
                        	foreach($sql as $query)
                        	mysql_query($query);	
							
                   
                            $completed = true;                            
                        
					}
	
 mysql_close($con);
echo header("Location: ../install/setup5.php"); 
?>	