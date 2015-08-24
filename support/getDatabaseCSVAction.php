<?php
	session_start();

    include "../checkLoggedIn.php";

	if (file_exists("classes/Computer.php")) {
  		include("classes/Computer.php");
	}

	if (file_exists("../classes/Computer.php")) {
  		include("../classes/Computer.php");
	}

	if (!isset($_GET["search"])) {
		$computers = Computer::getList();
	} else {
		$computers = Computer::getList($search = mysql_real_escape_string($_GET["search"]), array("hostname", "os", "employee", "rebuilder", "cpu", "programs", "servicetag", "escode", "model"));
	}

	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=PC-Rebuild-Database-".(isset($_GET["search"]) ? "[".str_replace(" ", "", $_GET["search"])."]-" : "").date("m-d-Y").".csv");

	$output = fopen("php://output", "w");

	$columns = array("Computer ID", "Hostname","Operating System","Bit","Employee",
					"Ex-Employee","Rebuilder","Password","Model","CPU","RAM","Hard Drive",
					"Optical Drive","Power Supply","Service Tag","Express Service Code","MAC Address LAN",
					"MAC Address WIFI","Date of Build","OS License Key","Installed Software","Updates",
					"Configuration","Printers","Additional Hardware","Notes", "Date of Purchase", "Branch", "Silverpop", "Efax",
					"Broadview Number", "Cellphone Number", "Status");

	fputcsv($output, $columns);
	foreach ($computers as $computer) {
		fputcsv($output, $computer);
	}
?>