<?php

require_once("installsql.php");

$sql = "

CREATE DATABASE IF NOT EXISTS $database  DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
CREATE TABLE IF NOT EXISTS $database.$table (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `happy` int(11) NOT NULL DEFAULT '0',
	`success` int(11) NOT NULL DEFAULT '0',
	`objective` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`getbetter` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`page` varchar(255) CHARACTER SET utf8 NOT NULL,
	`loggedip` varchar(255) CHARACTER SET utf8 NOT NULL,
	`updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`, `loggedip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS $database.$iptable (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `loggedip` varchar(255) CHARACTER SET utf8 NOT NULL,
	`country` varchar(255) CHARACTER SET utf8 NOT NULL,
	`updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`, `loggedip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS $database.$impression  (
  `surveyname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `surveyview` int(10) NOT NULL,
   PRIMARY KEY (`surveyname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS $database.$blanks (
	`id` int(10) NOT NULL,
	`value1` int(10) NOT NULL,
	`value2` int(10) NOT NULL,
	`value3` int(10) NOT NULL,
	`value4` int(10) NOT NULL,
	`value5` int(10) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS $database.$utable (
		`id` int(10) NOT NULL AUTO_INCREMENT,
		`fullname` varchar(255) CHARACTER SET utf8 NOT NULL,
		`password` BLOB,
		`email` varchar(255) CHARACTER SET utf8 NOT NULL,
		`groupname` varchar(255) CHARACTER SET utf8 NOT NULL,
		`created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		`updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`, `email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				
CREATE TABLE IF NOT EXISTS $database.$gtable (
 `id` int(10) NOT NULL AUTO_INCREMENT,
  `groupname` VARCHAR(20) NOT NULL,
  `export` INT NOT NULL DEFAULT '0',
  `print` INT NOT NULL DEFAULT '0',
  `clear` INT NOT NULL DEFAULT '0',
  `stats` INT NOT NULL DEFAULT '0',
  `userset` INT NOT NULL DEFAULT '0',
  `siteset` INT NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`, `groupname`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	
CREATE TABLE IF NOT EXISTS $database.$setable (
	`id` int(10) NOT NULL,
	`devmethod` int(10) NOT NULL,
	`popuptext` varchar(500) NOT NULL,
	`randomsurvey` int(10) NOT NULL,
	`delaytime` int(10) NOT NULL,
	`iprestrict` int(10) NOT NULL,
	`feedback` int(10) NOT NULL,
	`samail` varchar(255) NOT NULL,
	`piwikan` int(10) NOT NULL,
	`piwik_site_id` int(10) NOT NULL,
	`piwik_path` varchar(255) NOT NULL,
	`piwik_api` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO $database.$gtable (`groupname`, `export`, `print`, `clear`, `stats`, `userset`, `siteset`) VALUES
('Limited',0,0,0,0,0,0),
('Marketing',0,0,0,0,0,0),
('Reporter',0,0,0,0,0,0),
('Admin',0,0,0,0,0,0),
('SuperAdmin',1,1,1,1,1,1);


INSERT INTO $database.$setable (`id`, `devmethod`, `popuptext`, `randomsurvey`, `delaytime`,`iprestrict`, `feedback`, `samail`, `piwikan`, `piwik_site_id`, `piwik_path`, `piwik_api`) VALUES
(1, 1, 'By providing your feedback, you make our site better. Would you mind taking the time to answer four questions to help us?', 5,5,1, 0, 'email@email.com', 1, 1, 'http://localhost/piwik/', '');
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