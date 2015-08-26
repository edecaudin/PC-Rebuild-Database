<?php
	require("actions/checkLoggedInAction.php");
	require_once("mysql/Table.php");

	$computer = new Row(new Table("computer"), $_GET["computerName"]);
	if (!$computer->doesExist()) {
		echo("<script type=\"text/javascript\">
			alert(\"{$_GET["computerName"]} does not exist!\");
			window.history.back();
		</script>");
		exit();
	}

	$pageTitle = $computer["computer_name"];
	$headerContent = "<strong class=\"viewMode\" id=\"rightLinks\">
					<a href=\"javascript:toggleEdit(true)\" class=\"navLink green\">Edit</a> Info -
					<a href=\"editConfig.php?computerName={$computer["computer_name"]}\" class=\"navLink green\">Edit</a> Config -
					<a href=\"javascript:deleteComputer()\" class=\"navLink red\">Delete</a> {$computer["computer_name"]}
				</strong>
				<strong class=\"editMode\" id=\"rightLinks\">
					<a href=\"javascript:toggleEdit(false)\" class=\"navLink\">Back</a> to {$computer["computer_name"]} - 
					<a href=\"javascript:document.forms['editInfo'].submit()\" class=\"navLink green\">Save</a> Info
				</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			function deleteComputer() {
				if (confirm("Are you sure you want to delete <?=$computer["computer_name"]?>?")) {
					document.forms["deleteComputer"].submit();
				}
			}
			function toggleEdit(editMode) {
				for (element of document.getElementsByClassName("viewMode")) {
					element.style = editMode ? "display: none" : "display: inline";
				}
				for (element of document.getElementsByClassName("editMode")) {
					element.style = editMode ? "display: inline" : "display: none";
				}
				document.forms['editInfo'].reset();
			}
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<?php
				function echoRow($label1, $fieldName1, $attr1, $label2, $fieldName2, $attr2) {
					global $computer;
					echo("<div class=\"tableRow\">");
					for ($i = 0; $i < 2; $i++) {
						$label = $i == 0 ? $label1 : $label2;
						$fieldName = $i == 0 ? $fieldName1 : $fieldName2;
						$attr = $i == 0 ? $attr1 : $attr2;
						echo("
					<div class=\"tableCell\">{$label}:</div>
					<div class=\"tableCell\">
						<span class=\"viewMode\">{$computer[$fieldName]}</span>
						");
						if ($fieldName === "rebuilder") {
							echo("<select class=\"editMode\" name=\"{$fieldName}\">");
							$table = new Table("rebuilder");
							$table->echoRowsAsOptions($table->runQuery(), $computer["rebuilder"]);
							echo("</select>");
						} else {
							echo("<input".(is_null($attr) ? "" : " ".$attr)." class=\"editMode\" type=\"text\" name=\"{$fieldName}\" value=\"{$computer[$fieldName]}\"/>");
						}
						echo("
				</div>");
					}
					echo("
			</div>
			");
				}
				function echoSection($title, $fieldName) {
					global $computer;
					echo("<div class=\"tableSection\">
				<div class=\"tableHeader gray\"><h3>{$title}</h3></div>
				");
				echoInstalledItems($fieldName);
				echo("			</div>
			");
				}
				function echoInstalledItems($fieldName) {
					global $computer;
					if ($computer[$fieldName] === "") {
						echo("<div class=\"tableRow\">
								Nothing to do here!
							</div>");
					} else {
						$items = explode(" - ", $computer[$fieldName]);
						foreach ($items as $item) {
							echo("<div class=\"tableRow\">
									<input type=\"checkbox\"/>{$item}
								</div>");
						}
					}
				}
			?>
			<form id="editInfo" action="actions/editInfoAction.php" method="post">
				<div class="portal blue" id="viewComputer">
					<h3>
						<span class="viewMode" id="computerName"><?=$computer["computer_name"]?></span>
						<span class="editMode" id="computerName">Editing:</span>
						<input class="editMode" type="text" name="computer_name" value="<?=$computer["computer_name"]?>" maxlength="15"/> -
						Service Tag: <span class="viewMode"><?=$computer["service_tag"]?></span>
						<input class="editMode" type="text" name="service_tag" value="<?=$computer["service_tag"]?>"/> -
						OS: <span class="viewMode"><?=$computer["operating_system"]?></span>
						<select class="editMode" name="operating_system">
							<?php
								$table = new Table("operating_system");
								$table->echoRowsAsOptions($table->runQuery(), $computer["operating_system"]);
							?>
						</select>
					</h3>
				</div>
				<?php
					echoRow("Employee", "employee", null, "Ex-Employee", "ex_employee", null);
					echoRow("Rebuilder", "rebuilder", null, "Password", "password", null);
					echoRow("Model", "model", null, "CPU", "cpu", null);
					echoRow("RAM", "ram", null, "Storage", "storage", null);
					echoRow("Optical Drive", "optical_drive", null, "Battery", "battery", null);
					echoRow("OS License Key", "license_key", "maxlength=\"29\"", "Express Service Code", "express_service_code", null);
					echoRow("MAC Address (LAN)", "mac_lan", "maxlength=\"17\"", "MAC Address (WLAN)", "mac_wifi", "maxlength=\"17\"");
					echoRow("Rebuild Date", "rebuild_date", "type=\"date\"", "Purcase Date", "purchase_date", "type=\"date\"");
					echoRow("Cell Phone Number", "cell_number", null, "Broadview Number", "broadview_number", null);
				?>
				<div class="tableRow">
					<div class="tableCell">Notes:</div>
					<div class="tableSection">
						<span class="viewMode"><?=$computer["notes"]?></span>
						<textarea class="editMode" name="notes" id="notesTextArea"><?=$computer["notes"]?></textarea>
					</div>
				</div>
				<input type="hidden" name="computer_id" value="<?=$computer["computer_id"]?>"/>
			</form>
			<?php
				echoSection("Applications", "application_list");
				echoSection("Updates", "update_list");
				echoSection("Configuration Steps", "config_list");
				echoSection("Printers", "printer_list");
				echoSection("Hardware", "hardware_list");
			?>
			<form id="deleteComputer" action="actions/deleteItemAction.php" method="post">
				<input type="hidden" name="item" value="<?=$computer["computer_name"]?>"/>
				<input type="hidden" name="tableName" value="computer"/>
			</form>
			<?php include("templates/footer.php"); ?>
	</body>
</html>