<?php
	require("checkLoggedInAction.php");
  	require_once("../mysql/Table.php");


	$computers = new Table("computer");
	if ($_POST["search"] === "") {
		$computers = $computers->runQuery();
		echo("<h3 id=\"downloadCSV\"><a href=\"actions/getDatabaseCSVAction.php\"><span class=\"blue\">Download</span> a .csv version of the full database</a></h3>");
	} else {
		$computers = $computers->runQuery($search = $_POST["search"]);
		if (!$computers) {
			echo("<h3 class=\"red\" id=\"noResults\">No results found!</div>");
			exit();
		}
		echo("<h3 id=\"downloadCSV\"><a href=\"actions/getDatabaseCSVAction.php?search={$_POST["search"]}\"><span class=\"blue\">Download</span> a .csv version of the search results</a></h3>");
	}

	foreach ($computers as $computer) {
		echo("<div class=\"tableHeader gray\"><h3>Hostname: <a href=\"viewComputer.php?computerName={$computer["computer_name"]}\">{$computer["computer_name"]}</a></h3></div>
			<div class=\"tableRow\">
				<div class=\"tableCell\">Service Tag: {$computer["service_tag"]}</div>
				<div class=\"tableCell\">OS: {$computer["operating_system"]}</div>
				<div class=\"tableCell\">Date of Build: {$computer["rebuild_date"]}</div>
				<div class=\"tableCell\">MAC LAN: {$computer["mac_lan"]}</div>
			</div>
			<div class=\"tableRow\">
				<div class=\"tableCell\">User: {$computer["employee"]}</div>
				<div class=\"tableCell\">Model: {$computer["model"]}</div>
				<div class=\"tableCell\">Date of Purchase: {$computer["purchase_date"]}</div>
				<div class=\"tableCell\">MAC WLAN: {$computer["mac_wifi"]}</div>
			</div>
			");
	}
?>