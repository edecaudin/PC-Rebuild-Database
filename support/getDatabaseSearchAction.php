<?php
	include "mysqlConnect.php";
	if (isset($_POST["searchterm"])) {
		$result = mysqli_query($mysqlConnection, "SELECT * FROM computer WHERE
			hostname LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			os LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			bit LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			employee LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			rebuilder LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			cpu LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			status LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			programs LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			servicetag LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			escode LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%') OR
			model LIKE ('%".mysql_real_escape_string($_POST["searchterm"])."%')");
		$list = mysqli_fetch_object($result);
		if (!$list) {
			echo "<h2 class='red' id='noResults'>No results found!</div>";
			exit;
		}
		echo "<h2 id='downloadCSV'><a href='support/getDatabaseSearchCSVAction.php?sort={$_POST['searchterm']}'><span class='blue'>Download</span> a .csv version of the search results</a></h2>";
		do {
			echo "<div class='databaseCell' id='databaseHeaderCell'>Hostname: <a href='viewComputer.php?computerName={$list->hostname}' class='navLink'>{$list->hostname}</a></div>
<div class='databaseCell'>OS: {$list->os}, {$list->bit}</div>
<div class='databaseCell'>Date of Purchase: {$list->dop}</div>
<div class='databaseCell'>MAC LAN: {$list->maclan}</div>
<div class='databaseCell' id='databaseClearCell'>User: {$list->employee}</div>
<div class='databaseCell'>Model: {$list->model}</div>
<div class='databaseCell'>Service Tag: {$list->servicetag}</div>
<div class='databaseCell'>MAC WLAN: {$list->macwifi}</div>";
		} while ($list = mysqli_fetch_object($result));
	}
	mysqli_close($mysqlConnection);
?>