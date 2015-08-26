<?php
	require("checkLoggedInAction.php");
	require_once("../mysql/Table.php");

	$computer = new Row(new Table("computer"), intval($_POST["computer_id"]));

	function updateConfig($changes, $fieldName) {
		global $computer;
		$computer[$fieldName] = implode(" - ", $changes);
	}

	updateConfig($_POST["application_list"], "application_list");
	updateConfig($_POST["configuration_list"], "configuration_list");
	updateConfig($_POST["hardware_list"], "hardware_list");
	updateConfig($_POST["update_list"], "update_list");
	updateConfig($_POST["printer_list"], "printer_list");

	header("Location: ../viewComputer.php?computerName={$computer["computer_name"]}");
?>