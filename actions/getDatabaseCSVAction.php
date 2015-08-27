<?php
	require("checkLoggedInAction.php");
  	require_once("../mysql/Table.php");

	$table = new Table("computer");
	if (!isset($_GET["search"])) {
		$computers = $table->runQuery();
	} else {
		$computers = $table->runQuery($_GET["search"]);
	}

	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=PC-Rebuild-Database-".(isset($_GET["search"]) ? "[".str_replace(" ", "", $_GET["search"])."]-" : "").date("m-d-Y").".csv");

	$output = fopen("php://output", "w");
	fputcsv($output, $table->getColumnNames());
	foreach ($computers as $computer) {
		fputcsv($output, $computer);
	}
?>