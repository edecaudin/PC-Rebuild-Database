<?php
	session_start();

    include "../checkLoggedIn.php";
	include "../array_report.php";
	
	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=PC-Rebuild-Database-".date("m-d-Y").".csv");

	$output = fopen("php://output", "w");
	fputcsv($output, $array_report);

	include "mysqlConnect.php";
	$csv_rows = mysqli_query($mysqlConnection, "SELECT $all_except_id FROM computer ORDER BY hostname ASC");
	while ($csv_row = mysqli_fetch_assoc($csv_rows)) {
		fputcsv($output, $csv_row);
	}
	mysqli_close($mysqlConnection);
?>