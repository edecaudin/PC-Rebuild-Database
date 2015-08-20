<?php
	$mysqlConfig = parse_ini_file("mysql.ini");
	$mysqlConnection = mysqli_connect($mysqlConfig["server"], $mysqlConfig["username"], $mysqlConfig["password"], "pc_rebuild");
?>