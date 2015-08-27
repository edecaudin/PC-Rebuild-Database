<?php
	require("checkLoggedInAction.php");
	require_once("../mysql/Table.php");

	$computer = new Row(new Table("computer"), intval($_POST["computer_id"]));

	foreach ($_POST as $fieldName => $field) {
		$computer[$fieldName] = gettype($field) != "array" ? $field : implode(" - ", $field);
	}
?>