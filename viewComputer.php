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
			}
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<?php
				function echoRow($label1, $fieldName1, $label2, $fieldName2) {
					global $computer;
					echo("<div class=\"tableRow\">
				<div class=\"tableCell\">{$label1}:</div>
				<div class=\"tableCell\">
					<span class=\"viewMode\">{$computer[$fieldName1]}</span>
					");
					if ($fieldName1 === "rebuilder") {
						echo("<select class=\"editMode\" name=\"{$fieldName1}\">");
						$table = new Table("rebuilder");
						$table->echoRowsAsOptions($table->runQuery(), $computer["rebuilder"]);
						echo("</select>");
					} else {
						echo("<input class=\"editMode\" type=\"text\" name=\"{$fieldName1}\" value=\"{$computer[$fieldName1]}\"/>");
					}
					echo("
				</div>
				<div class=\"tableCell\">{$label2}:</div>
				<div class=\"tableCell\">
					<span class=\"viewMode\">{$computer[$fieldName2]}</span>
					<input class=\"editMode\" type=\"text\" name=\"{$fieldName2}\" value=\"{$computer[$fieldName2]}\"/>
				</div>
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
					echoRow("Employee", "employee", "Ex-Employee", "ex_employee");
					echoRow("Rebuilder", "rebuilder", "Password", "password");
					echoRow("Model", "model", "CPU", "cpu");
					echoRow("RAM", "ram", "Storage", "storage");
					echoRow("Optical Drive", "optical_drive", "Battery", "battery");
					echoRow("OS License Key", "license_key", "Express Service Code", "express_service_code");
					echoRow("MAC Address (LAN)", "mac_lan", "MAC Address (WLAN)", "mac_wifi");
					echoRow("Rebuild Date", "rebuild_date", "Purcase Date", "purchase_date");
					echoRow("Cell Phone Number", "cell_number", "Broadview Number", "broadview_number");
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