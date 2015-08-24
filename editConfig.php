<?php
	session_start();

	include "checkLoggedIn.php";
	
	$computerName = $_GET["computerName"];	
	$pageTitle = "Editing {$computerName}";
	$headerContent = "<strong id='rightLinks'>
		<a href='viewComputer.php?computerName={$computerName}' class='navLink'>Back</a> to {$computerName} - 
		<a href='javascript:document.forms[\"editConfig\"].submit()' class='navLink, green'>Save</a> Config
	</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include "head.php"; ?>
	</head>
	<body>
		<?php include "header.php"; ?>
			<div class="portal blue">
				<h2>Editing <?=$computerName?></h2>
			</div>
			<?php
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
			<form name="editConfig" action="support/editConfigAction.php" method="post">
				<?php
					echo "<div class='edit_me_3_inst'>Applications:</div>";
					installedStuffLookup($computerName, "programs", "software", "programs");
					echo "<div class='edit_me_3_inst'>Configuration:</div>";
					installedStuffLookup($computerName, "configuration", "config", "config");
					echo "<div class='edit_me_3_inst'>Additional Hardware:</div>";
					installedStuffLookup($computerName, "additionalhardware", "hardware", "addhw");
					echo "<div class='edit_me_3_inst'>Updates:</div>";
					installedStuffLookup($computerName, "update_software", "updates", "updates");
					echo "<div class='edit_me_3_inst'>Printers:</div>";
					installedStuffLookup($computerName, "device", "printers", "printers");
				?>
				<input type="hidden" name="computerName" value="<?=$computerName?>"/>
			</form>
			<?php
				include "footer.php";
			?>