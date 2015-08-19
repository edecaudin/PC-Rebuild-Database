<?php
	include 'connection.php';

	if (isset($_POST["searchterm"])) {
		$result = mysql_query("SELECT * FROM computer WHERE
			hostname LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			os LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			bit LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			employee LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			rebuilder LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			cpu LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			status LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			programs LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			servicetag LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			escode LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%') OR
			model LIKE ('%".mysql_real_escape_string(utf8_decode($_POST["searchterm"]))."%')");
		$row = mysql_fetch_object($result);
		if (!$row) {
			echo "<h2 class='red' id='noResults'>No results found!</div>";
			exit;
		}
		do {
			echo "<div class='tobedone databaseCell'>Hostname: {$row->hostname}</div>
				<div class='databaseCell'>OS: {$row->os}, {$row->bit}</div>
				<div class='databaseCell'>Date of Purchase: {$row->dop}</div>
				<div class='databaseCell'>MAC LAN: {$row->maclan}</div>
				<div class='databaseCell' id='databaseClearCell'>User: {$row->employee}</div>
				<div class='databaseCell'>Model: {$row->model}</div>
				<div class='databaseCell'>Service Tag: {$row->servicetag}</div>
				<div class='databaseCell'>MAC WLAN: {$row->macwifi}</div>";
		} while ($row = mysql_fetch_object($result));
		echo "<h2 id='downloadCSV'><a href='support/getDatabaseSearchCSVAction.php?sort={$_POST['searchterm']}'><span class='blue'>Download</span> a .csv version of the search results</a></h2>";
	}
?>