<?php
	$mysqlConfig = parse_ini_file("mysql.ini");
	$mysqlConnection = new mysqli($mysqlConfig["server"], $mysqlConfig["username"], $mysqlConfig["password"], "pc_rebuild");
?>