<?php

require_once("installsql.php");

$sql = "
CREATE DATABASE IF NOT EXISTS $database  DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
CREATE TABLE IF NOT EXISTS $database.$table (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `username` varchar(13) CHARACTER SET utf8 NOT NULL,
   `campaign_name` varchar(255) NOT NULL,
    `custvar1` varchar(255) NOT NULL,
	`custvarimg1` varchar(255) NOT NULL,
	`custvar2` varchar(255) NOT NULL,
	`custvarimg2` varchar(255) NOT NULL,
	`custvar3` varchar(255) NOT NULL,
	`custvarimg3` varchar(255) NOT NULL,
	`custvar4` varchar(255) NOT NULL,
	`custvarimg4` varchar(255) NOT NULL,
	`custvar5` varchar(255) NOT NULL,
	`custvarimg5` varchar(255) NOT NULL,
	`altext1` varchar(255) NOT NULL,
	`link1` varchar(255) NOT NULL,
	`titletext1` varchar(255) NOT NULL,
	`altext2` varchar(255) NOT NULL,
	`link2` varchar(255) NOT NULL,
	`titletext2` varchar(255) NOT NULL,
	`altext3` varchar(255) NOT NULL,
	`link3` varchar(255) NOT NULL,
	`titletext3` varchar(255) NOT NULL,
	`altext4` varchar(255) NOT NULL,
	`link4` varchar(255) NOT NULL,
	`titletext4` varchar(255) NOT NULL,
	`altext5` varchar(255) NOT NULL,
	`link5` varchar(255) NOT NULL,
	`titletext5` varchar(255) NOT NULL,
	`defaultbanner` varchar(255) NOT NULL,
	`defaultlink` varchar(255) NOT NULL,
	`defaulttitletext` varchar(255) NOT NULL,
	`defaultaltext` varchar(255) NOT NULL,
	`custvarM` varchar(255) NOT NULL,
	`custvarimgM` varchar(255) NOT NULL,
	`altextM` varchar(255) NOT NULL,
	`titletextM` varchar(255) NOT NULL,
	`linkM` varchar(255) NOT NULL,
	`analyticspack`  varchar(15) NOT NULL,
	`cookienotice`  varchar(255) NOT NULL,
	`updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`id`, `username`, `campaign_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS $database.$stable (
  `campaign_name` varchar(255) NOT NULL,
  `custvar` varchar(255) NOT NULL,
  `custimage` varchar(100) NOT NULL,
  `custlink` varchar(255) NOT NULL,
  `custview` int(10) NOT NULL,
  `custclicks` int(10) NOT NULL,
  PRIMARY KEY (`campaign_name`, `custvar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS $database.$authtable (
  `username` varchar(13) CHARACTER SET utf8 NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 NOT NULL,
  `rolelevel` varchar(55) CHARACTER SET utf8 NOT NULL,
  `loginattempt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS $database.$iptable (
  `loggedip` varchar(15) CHARACTER SET utf8 NOT NULL,
  `failedattempts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";

$sqlfp = fopen('install'.'.sql', "w");
fwrite($sqlfp, $sql);
fclose($sqlfp);

//Connect
mysql_select_db($database, $con);

// Execute query
mysql_query($sql);
mysql_close($con);

echo header("Location: ../install/setup4.php");

?>