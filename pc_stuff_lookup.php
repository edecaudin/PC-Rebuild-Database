<?php
function getTableItems($fieldname, $tablename, $selected = null, $limiterField = null, $limiter = null) {
	include "support/mysqlConnect.php";

	$result = mysqli_query($mysqlConnection, "SELECT $fieldname FROM $tablename ".(isset($limiterField) && isset($limiter) ? "WHERE {$limiterField} = '{$limiter}' " : "")."ORDER BY $fieldname ASC");
	$count = 1;
	while ($item = mysqli_fetch_row($result)) {
		echo "<option".(isset($selected) && $item[0] === $selected ? " selected" : "").">{$item[0]}</option>";
		$count++;
	}

	mysqli_close($mysqlConnection);
}
?>