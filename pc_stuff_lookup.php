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

function getInstalledItems($hostname, $fieldname) {
	$result = mysql_query("SELECT $fieldname FROM computer WHERE hostname = '{$hostname}'");
	$items = array();
	
	while ($item = mysql_fetch_row($result)) {
		if ($item[0] === "") {
			echo "<tr><td>Nothing to do here!</td></tr>";
		} else {
			$items = explode(" - ",$item[0]);
			for ($i = 0; $i < count($items); $i++) {
				echo "<tr><td><input type='checkbox'/>{$items[$i]}</td></tr>";
			}
		} 
	}
}

/*
This function is used for the edit menu programs and configuration. It compares all available items from the database with the ones which are acutally used on a computer and creates an overview of all items, with installed ones highlighted and checked. By checking an item one can add it, by unchecking one can delete it from the computer configuration. Furthermore, an invisible text field is created which transmits the computer id.
*/
function installedStuffLookup($hostname,$select,$table_where_select,$what_change) {
	include "support/mysqlConnect.php";
	$computerreport = "SELECT $what_change, computerid FROM computer WHERE hostname = '$hostname' ";
	$computerinfos = mysqli_query($mysqlConnection, $computerreport);
	
	$select_all_software = "SELECT $select FROM $table_where_select ORDER BY $select ASC";
	$all_software =mysqli_query($mysqlConnection, $select_all_software);
	
	$one_program = array(); 
	$installed = mysqli_fetch_object($computerinfos);
	$programs = $installed->$what_change;
	$id = $installed->computerid;
	$one_program = explode(" - ",$programs);
	
	$all_available_software = array();	
	while ($get = mysqli_fetch_row($all_software)) {
		$all_available_software[] = $get[0];
	}
		
	$i=0;
	while ($i<count($all_available_software)) {
		$check_that = $all_available_software[$i];
		$isInstalled = in_array($check_that, $one_program, TRUE);
		echo "<div class='edit_me_2".($isInstalled ? "_inst" : "")."'>
			<input type='checkbox' name='{$table_where_select}[]' value='{$all_available_software[$i]}'".($isInstalled ? " checked" : "").">
			$all_available_software[$i]
		</div>";
		$i++;
	}
	echo "<input style='visibility:hidden;' type='text' name='id' value='$id'>";
	mysqli_close($mysqlConnection);
} 

?>