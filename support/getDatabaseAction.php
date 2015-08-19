<?php 
	$listresult = mysql_query("SELECT hostname, os, bit, employee, servicetag, maclan, oskey, model, dop, macwifi FROM computer ORDER BY hostname ASC");
	while ($list = mysql_fetch_object($listresult)) {
		echo "<div class='tobedone databaseCell'>Hostname: {$list->hostname}</div>
				<div class='databaseCell'>OS: {$list->os}, {$list->bit}</div>
				<div class='databaseCell'>Date of Purchase: {$list->dop}</div>
				<div class='databaseCell'>MAC LAN: {$list->maclan}</div>
				<div class='databaseCell' id='databaseClearCell'>User: {$list->employee}</div>
				<div class='databaseCell'>Model: {$list->model}</div>
				<div class='databaseCell'>Service Tag: {$list->servicetag}</div>
				<div class='databaseCell'>MAC WLAN: {$list->macwifi}</div>";
	} 
?>