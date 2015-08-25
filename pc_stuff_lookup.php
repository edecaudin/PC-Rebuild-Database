<?php
	require_once("classes/Table.php");
	require_once("classes/Row.php");
	
	function getTableItems($tableName, $selected = null) {
		$table = new Table($tableName);
		$result = $table->runQuery();
		foreach ($result as $row) {
			$item = new Row($table, intval($row[$table->getName()."_id"]));
			echo "<option".(isset($selected) && $item[$table->getName()."_name"] === $selected ? " selected" : "").">".$item[$table->getName()."_name"]."</option>";
		}
	}
?>