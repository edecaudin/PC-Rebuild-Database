<?php
	if (file_exists("mysql/mysql.ini")) {
  		$mysqlConfig = parse_ini_file("mysql/mysql.ini");
	} else {
		$mysqlConfig = parse_ini_file("../mysql/mysql.ini");
	}
	$mysqlConnection = new mysqli($mysqlConfig["server"], $mysqlConfig["username"], $mysqlConfig["password"], "pc_rebuild");
?>