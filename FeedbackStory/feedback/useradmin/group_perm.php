<?php

//Group permissions
$grouplist1 = mysql_query("SELECT `groupname`, `export`,`print`,`clear`,`stats`,`userset`,`siteset` FROM  `$database`.`$gtable` WHERE `groupname`= 'Limited'");
while($groupdata1 = mysql_fetch_array($grouplist1)){
$L1[] = $groupdata1['export'];
$L2[] =$groupdata1['print']; 
$L3[] =$groupdata1['clear'];  
$L4[] = $groupdata1['stats']; 
$L5[] =$groupdata1['userset'];  
$L6[] = $groupdata1['siteset'];
}

$grouplist2 = mysql_query("SELECT `groupname`, `export`,`print`,`clear`,`stats`,`userset`,`siteset` FROM  `$database`.`$gtable` WHERE `groupname`= 'Marketing'");
while($groupdata2 = mysql_fetch_array($grouplist2)){
$m1[] = $groupdata2['export'];
$m2[] =$groupdata2['print']; 
$m3[] =$groupdata2['clear'];  
$m4[] = $groupdata2['stats']; 
$m5[] =$groupdata2['userset'];  
$m6[] = $groupdata2['siteset'];
}


$grouplist3 = mysql_query("SELECT `groupname`, `export`,`print`,`clear`,`stats`,`userset`,`siteset` FROM  `$database`.`$gtable` WHERE `groupname`= 'Reporter'");
while($groupdata3 = mysql_fetch_array($grouplist3)){
$r1[] = $groupdata3['export'];
$r2[] =$groupdata3['print']; 
$r3[] =$groupdata3['clear'];  
$r4[] = $groupdata3['stats']; 
$r5[] =$groupdata3['userset'];  
$r6[] = $groupdata3['siteset'];
}

$grouplist4 = mysql_query("SELECT `groupname`, `export`,`print`,`clear`,`stats`,`userset`,`siteset` FROM  `$database`.`$gtable` WHERE `groupname`= 'Admin'");
while($groupdata4 = mysql_fetch_array($grouplist4)){
$ra1[] = $groupdata4['export'];
$ra2[] =$groupdata4['print']; 
$ra3[] =$groupdata4['clear'];  
$ra4[] = $groupdata4['stats']; 
$ra5[] =$groupdata4['userset'];  
$ra6[] = $groupdata4['siteset'];
}


?>