<?php
	$mysqlConfig = parse_ini_file("mysql.ini");
	$connection = mysql_connect($mysqlConfig["server"], $mysqlConfig["username"], $mysqlConfig["password"]);
	mysql_select_db("pc_rebuild");
	error_reporting(E_ALL ^ E_NOTICE);
?>