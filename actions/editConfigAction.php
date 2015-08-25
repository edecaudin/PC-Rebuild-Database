<?php
	require("checkLoggedInAction.php");
	require_once("../mysql/Table.php");

	$computer = new Row(new Table("computer"), intval($_POST["computer_id"]));

	function updateConfig($changes, $fieldName) {
		global $computer;
		$computer[$fieldName] = implode(" - ", $changes);
	}

	updateConfig($_POST["application"], "programs");
	updateConfig($_POST["config"], "config");
	updateConfig($_POST["hardware"], "addhw");
	updateConfig($_POST["update"], "updates");
	updateConfig($_POST["printer"], "printers");

	header("Location: ../viewComputer.php?computerName={$computer["computer_name"]}");
?>