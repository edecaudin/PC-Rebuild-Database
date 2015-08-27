<?php
	require("checkLoggedInAction.php");
	require_once("../mysql/Table.php");

	$item = $_POST["item"];
	$table = new Table($_POST["tableName"]);
	if ($table->doesContain($item)) {
		echo(json_encode(array("message" => "{$item} already exists!")));
	} else {
		$table->addItem($item);
		echo(json_encode(array("message" => "Successfully added \"{$item}\"!")));
	}
?>