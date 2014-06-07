<?php
include("geoip.inc");
$gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);
$ip = $_SERVER['REMOTE_ADDR'];
$country=  geoip_country_name_by_addr($gi, $ip) . "\n";
echo $country;
geoip_close($gi);
?>


