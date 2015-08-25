<?php
  	require_once("../classes/Table.php");
	require_once("../classes/Row.php");

	if ($_POST["search"] === "") {
		$computers = new Table("computer");
		$computers = $computers->runQuery();
		echo("<h2 id=\"downloadCSV\"><a href=\"support/getDatabaseCSVAction.php\"><span class=\"blue\">Download</span> a .csv version of the full database</a></h2>");
	} else {
		$computers = new Table("computer");
		$computers = $computers->runQuery($search = $_POST["search"], array("computer_name", "os", "employee", "rebuilder", "cpu", "programs", "servicetag", "escode", "model"));
		if (!$computers) {
			echo "<h2 class=\"red\" id=\"noResults\">No results found!</div>";
			exit;
		}
		echo "<h2 id=\"downloadCSV\"><a href=\"support/getDatabaseCSVAction.php?search={$_POST["search"]}\"><span class=\"blue\">Download</span> a .csv version of the search results</a></h2>";
	}

	foreach ($computers as $computer) {
		echo "<div class=\"databaseCell\" id=\"databaseHeaderCell\">Hostname: <a href=\"viewComputer.php?computerName={$computer["computer_name"]}\" class=\"navLink\">{$computer["computer_name"]}</a></div>
				<div class=\"databaseCell\">OS: {$computer["os"]}</div>
				<div class=\"databaseCell\">Date of Purchase: {$computer["dop"]}</div>
				<div class=\"databaseCell\">MAC LAN: {$computer["maclan"]}</div>
				<div class=\"databaseCell\" id=\"databaseClearCell\">User: {$computer["employee"]}</div>
				<div class=\"databaseCell\">Model: {$computer["model"]}</div>
				<div class=\"databaseCell\">Service Tag: {$computer["servicetag"]}</div>
				<div class=\"databaseCell\">MAC WLAN: {$computer["macwifi"]}</div>
				";
	}
?>