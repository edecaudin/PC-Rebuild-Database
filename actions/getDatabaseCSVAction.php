<?php
	require("checkLoggedInAction.php");
  	require_once("../mysql/Table.php");

	$table = new Table("computer");
	if (!isset($_GET["search"])) {
		$computers = $table->runQuery();
	} else {
		$computers = $table->runQuery($_GET["search"], array("computer_name", "os", "employee", "rebuilder", "cpu", "programs", "servicetag", "escode", "model"));
	}

	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=PC-Rebuild-Database-".(isset($_GET["search"]) ? "[".str_replace(" ", "", $_GET["search"])."]-" : "").date("m-d-Y").".csv");

	$output = fopen("php://output", "w");
	fputcsv($output, array(
		"Computer ID",
		"Hostname",
		"Operating System",
		"Employee",
		"Ex-Employee",
		"Rebuilder",
		"Password",
		"Model",
		"CPU",
		"RAM",
		"Hard Drive",
		"Optical Drive",
		"Power Supply",
		"Service Tag",
		"Express Service Code",
		"MAC Address LAN",
		"MAC Address WIFI",
		"Date of Build",
		"OS License Key",
		"Installed Software",
		"Updates",
		"Configuration",
		"Printers",
		"Additional Hardware",
		"Notes",
		"Date of Purchase",
		"Branch",
		"Silverpop",
		"Efax",
		"Broadview Number",
		"Cellphone Number"));
	foreach ($computers as $computer) {
		fputcsv($output, $computer);
	}
?>