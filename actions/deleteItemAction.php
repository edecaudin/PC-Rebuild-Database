<?php
	require("checkLoggedInAction.php");
	require_once("../mysql/Table.php");

	$item = $_POST["item"];
	$table = new Table($_POST["tableName"]);
	$table->deleteItem($item);
	
	echo(json_encode(array("message" => "Successfully deleted \"{$item}\"!")));
?>