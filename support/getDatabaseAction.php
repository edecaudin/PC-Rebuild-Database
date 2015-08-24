<?php
	if (file_exists("classes/Computer.php")) {
  		include("classes/Computer.php");
	}
	
	if (file_exists("../classes/Computer.php")) {
  		include("../classes/Computer.php");
	}

	if (!isset($_POST["search"])) {
		$computers = Computer::getList();
	} else {
		$computers = Computer::getList($search = mysql_real_escape_string($_POST["search"]), array("hostname", "os", "employee", "rebuilder", "cpu", "programs", "servicetag", "escode", "model"));
		if (!$computers) {
			echo "<h2 class='red' id='noResults'>No results found!</div>";
			exit;
		}
		echo "<h2 id='downloadCSV'><a href='support/getDatabaseSearchCSVAction.php?search={$_POST['search']}'><span class='blue'>Download</span> a .csv version of the search results</a></h2>";
	}

	foreach ($computers as $computer) {
		echo "<div class='databaseCell' id='databaseHeaderCell'>Hostname: <a href='viewComputer.php?computerName={$computer["hostname"]}' class='navLink'>{$computer["hostname"]}</a></div>
				<div class='databaseCell'>OS: {$computer["os"]}, {$computer["bit"]}</div>
				<div class='databaseCell'>Date of Purchase: {$computer["dop"]}</div>
				<div class='databaseCell'>MAC LAN: {$computer["maclan"]}</div>
				<div class='databaseCell' id='databaseClearCell'>User: {$computer["employee"]}</div>
				<div class='databaseCell'>Model: {$computer["model"]}</div>
				<div class='databaseCell'>Service Tag: {$computer["servicetag"]}</div>
				<div class='databaseCell'>MAC WLAN: {$computer["macwifi"]}</div>
				";