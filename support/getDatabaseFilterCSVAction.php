<?php
	session_start();

    include "../checkLoggedIn.php";
	include '../connection.php';
	include "../array_report.php";

	$query = $_GET["sort"];

	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=PC-Rebuild-Database-[".str_replace(" ", "", $query)."]-".date("m-d-Y").".csv");

	$output = fopen("php://output", "w");
	fputcsv($output, $array_report);

	$csv_rows = mysql_query("SELECT $all_except_id FROM computer
		WHERE os LIKE '{$query}%'
		OR rebuilder LIKE '{$query}'
		OR hostname LIKE '{$query}%'
		OR status LIKE '{$query}'
		ORDER BY hostname ASC");
	while ($csv_row = mysql_fetch_assoc($csv_rows)) {
		fputcsv($output, $csv_row);
	}
?>