<?php

	require_once 'init.php';

	$con->exec("SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";");
	$con->exec("SET time_zone = \"+00:00\";");

	$con->exec("CREATE TABLE pdbms_data (data_id int(11) NOT NULL, identity varchar(10) NOT NULL, temp decimal(10,2) NOT NULL, humi decimal(10,2) NOT NULL, light decimal(10,2) NOT NULL, weight decimal(10,2) NOT NULL, datetime int(11) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

	$con->exec("CREATE TABLE pdbms_picture (identity varchar(10) NOT NULL, base64pic longtext NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

	$con->exec("ALTER TABLE `pdbms_data` ADD PRIMARY KEY (`data_id`);");

	$con->exec("ALTER TABLE `pdbms_data` MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");