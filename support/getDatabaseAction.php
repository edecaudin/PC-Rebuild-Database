<?php
	include "classes/Computer.php";

	$computers = Computer::getList();
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
	}
?>