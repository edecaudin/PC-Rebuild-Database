<?php
/*
This function looks up all computers and sorts it alphabetically.
Diese Funktion sucht alle Computer und sortiert sie alphabetisch.
*/
function pc_lookup() {
			$pcquery = "SELECT hostname FROM computer ORDER BY hostname ASC";
			$pcresult = mysql_query($pcquery);
			$pccount = 1;
			while ($pcget = mysql_fetch_row($pcresult)) {
				echo "<option name='$pccount'>$pcget[0]</option>";
				$pccount++;
				}
	} 

/*
This function looks up stuff from the database and creates options in a select list.
Diese Funktion sucht irgendetwas aus der Datenbank und erstellt options in einer select Liste.
*/
function stuff_lookup($fieldname, $tablename, $selected = null) {
		$stuffquery = "SELECT $fieldname FROM $tablename ORDER BY $fieldname ASC";
		$stuffresult = mysql_query($stuffquery);
		$stuffcount = 1;
		while ($stuffget = mysql_fetch_row($stuffresult)) {
			echo "<option name='$stuffget[0]'".(isset($selected) && $stuffget[0] === $selected ? " selected" : "").">$stuffget[0]</option>";
			$stuffcount++;
		}
}

function getTableItems($fieldname, $tablename, $selected = null) {
	include "support/mysqlConnect.php";

	$result = mysqli_query($mysqlConnection, "SELECT $fieldname FROM $tablename ORDER BY $fieldname ASC");
	$count = 1;
	while ($item = mysqli_fetch_row($result)) {
		echo "<option name='$item'".(isset($selected) && $item[0] === $selected ? " selected" : "").">{$item[0]}</option>";
		$count++;
	}

	mysqli_close($mysqlConnection);
}

function recreate_rebuildform_checked($hostname, $fieldname) {
	$checkedresult = mysql_query("SELECT $fieldname FROM computer WHERE hostname = '{$hostname}'");
	$checkedall = array();
	
	while ($checked = mysql_fetch_row($checkedresult)) {
		if ($checked[0] == '') {
			echo "<tr><td>Nothing to do here!</td></tr>";
		} else {
			$checkedall = explode(" - ",$checked[0]);
			for ($i=0;$i<count($checkedall);$i++) {
				echo "<tr><td><input type='checkbox'/>&nbsp;".$checkedall[$i]."</td></tr>";
			}
		} 
	}
}

/*
This function is used for the edit menu programs and configuration. It compares all available items from the database with the ones which are acutally used on a computer and creates an overview of all items, with installed ones highlighted and checked. By checking an item one can add it, by unchecking one can delete it from the computer configuration. Furthermore, an invisible text field is created which transmits the computer id.
Diese Funktion wird von den Bearbeitenmenüs programs und configuration benutzt. Sie vergleicht alle vorhanden Elemente der Datenbank mit denen die eigentlich auf dem Computer vorhanden sind und erstellt eine Übersicht mit allen Elementen, auf der installierten hervorgehoben und angewählt sind. Durch an- und abwählen einzelner Elemente können diese zum Computer hinzugefügt oder gelöscht werden. Desweiteren wird ein unsichtbares Textfeld erstellt welches die Computer ID überträgt.
*/
function installedStuffLookup($hostname,$select,$table_where_select,$what_change) {
	$computerreport = "SELECT $what_change, computerid FROM computer WHERE hostname = '$hostname' ";
	$computerinfos = mysql_query($computerreport);
	
	$select_all_software = "SELECT $select FROM $table_where_select ORDER BY $select ASC";
	$all_software = mysql_query($select_all_software);
		
	$one_program = array(); 
	while($installed = mysql_fetch_object($computerinfos)) { 
		$programs = $installed->$what_change; $id = $installed->computerid;
	}
	$one_program = explode(" - ",$programs);
	
	$all_available_software = array();	
	while ($get = mysql_fetch_row($all_software)) {
		$all_available_software[] = $get[0];
	}
		
	$i=0;
	while ($i < count($all_available_software)) {
		$check_that = $all_available_software[$i];
		$isInstalled = in_array($check_that, $one_program, TRUE);
		echo "<div class='edit_me_2".($isInstalled ? "_inst" : "")."'>
			<input type='checkbox' name='".$table_where_select."[]' value='{$all_available_software[$i]}'".($isInstalled ? " checked" : "").">
			<label for='".$table_where_select."[]'>{$all_available_software[$i]}</label>
		</div>";
		$i++;
	}
	echo "<input type='hidden' name='id' value='$id'/>";
} 

/*
This function saves all changes made through installedStuffLookup into the datebase.
Diese Funktion speichert alle Änderungen die durch installed installedStuffLookup gemacht wurden in die Datenbank.
*/
function saveChangesFromCheckbox($id,$select,$table_where_select,$with_change,$what_change) {
$how_many_things = count($with_change); 
if ($how_many_things == 1) {
	$one_entry = "UPDATE computer SET $what_change = '$with_change[0]' WHERE computerid = '$id'";
	$make_change = mysql_query($one_entry);
	} else if ($how_many_things > 1) {
			$arrayprograms = array();
					foreach ($with_change as $moreprograms) {
						$arrayprograms[] = htmlspecialchars($moreprograms);
						}
						$change = implode (" - ",$arrayprograms);

			$change = "UPDATE computer SET
			$what_change = '$change'
			WHERE computerid = $id";
			$make_change = mysql_query($change);
			} else {
				$nothing = "UPDATE computer SET $what_change = '$with_change[0]' WHERE computerid = $id";
				$make_change = mysql_query($nothing);
				}
}
?>