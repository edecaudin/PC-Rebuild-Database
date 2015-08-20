<?php 
	include "mysqlConnect.php";

	$listresult = mysqli_query($mysqlConnection, "SELECT hostname, os, bit, employee, servicetag, maclan, oskey, model, dop, macwifi FROM computer ORDER BY hostname ASC");
	while ($list = mysqli_fetch_object($listresult)) {
		echo "<div class='databaseCell' id='databaseHeaderCell'>Hostname: <a href='viewComputer.php?computerName={$list->hostname}' class='navLink'>{$list->hostname}</a></div>
				<div class='databaseCell'>OS: {$list->os}, {$list->bit}</div>
				<div class='databaseCell'>Date of Purchase: {$list->dop}</div>
				<div class='databaseCell'>MAC LAN: {$list->maclan}</div>
				<div class='databaseCell' id='databaseClearCell'>User: {$list->employee}</div>
				<div class='databaseCell'>Model: {$list->model}</div>
				<div class='databaseCell'>Service Tag: {$list->servicetag}</div>
				<div class='databaseCell'>MAC WLAN: {$list->macwifi}</div>";
	}

	mysqli_close($mysqlConnection);
?>