<?php
	require_once("classes/Table.php");
	require_once("classes/Row.php");
	
	function getTableItems($tableName, $selected = null) {
		$table = new Table($tableName);
		$result = $table->runQuery();
		foreach ($result as $row) {
			$item = new Row($table, intval($row[$tableName."_id"]));
			echo "<option".(isset($selected) && $item[$tableName."_name"] === $selected ? " selected" : "").">".$item[$tableName."_name"]."</option>";
		}
	}
?>