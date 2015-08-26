<?php
	require("checkLoggedInAction.php");
  	require_once("../mysql/Table.php");

	$table = new Table("computer");
	if (!isset($_GET["search"])) {
		$computers = $table->runQuery();
	} else {
		$computers = $table->runQuery($_GET["search"], array("computer_name", "operating_system", "employee", "rebuilder", "cpu", "application_list", "service_tag", "express_service_code", "model"));
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
		"Storage",
		"Optical Drive",
		"Battery",
		"Service Tag",
		"Express Service Code",
		"MAC Address LAN",
		"MAC Address WIFI",
		"Rebuild Date",
		"OS License Key",
		"Applications",
		"Updates",
		"Configuration",
		"Printers",
		"Hardware",
		"Notes",
		"Purchase Date",
		"Broadview Number",
		"Cellphone Number"));
	foreach ($computers as $computer) {
		fputcsv($output, $computer);
	}
?>