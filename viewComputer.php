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
	$headerContent = "<strong id=\"rightLinks\">
					<a href=\"editInfo.php?computerName={$computer["computer_name"]}\" class=\"navLink green\">Edit</a> Info - 
					<a href=\"editConfig.php?computerName={$computer["computer_name"]}\" class=\"navLink green\">Edit</a> Config - 
					<a href=\"javascript:deleteComputer()\" class=\"navLink red\">Delete</a> {$computer["computer_name"]}
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
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<?php
				function echoRow($label1, $fieldName1, $label2, $fieldName2) {
					global $computer;
					echo("<div class=\"tableRow\">
				<div class=\"tableCell\">{$label1}:</div>
				<div class=\"tableCell\">{$computer[$fieldName1]}</div>
				<div class=\"tableCell\">{$label2}:</div>
				<div class=\"tableCell\">{$computer[$fieldName2]}</div>
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
					$field = $computer[$fieldName];
					if ($fieldName === "notes") {
						echo $field;
					} else if ($field === "") {
						echo("<div class=\"tableRow\">
								Nothing to do here!
							</div>");
					} else {
						$items = explode(" - ", $field);
						foreach ($items as $item) {
							echo("<div class=\"tableRow\">
									<input type=\"checkbox\"/>{$item}
								</div>");
						}
					}
				}
			?>
			<div class="portal blue" id="viewComputer">
				<h3><span id="computerName"><?=$computer["computer_name"]?></span> - Service Tag: <?=$computer["service_tag"]?> - OS: <?=$computer["operating_system"]?></h3>
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
				
				echoSection("Applications", "application_list");
				echoSection("Updates", "update_list");
				echoSection("Configuration Steps", "config_list");
				echoSection("Printers", "printer_list");
				echoSection("Hardware", "hardware_list");
				echoSection("Notes", "notes");
			?>
			<form id="deleteComputer" action="actions/deleteItemAction.php" method="post">
				<input type="hidden" name="item" value="<?=$computer["computer_name"]?>"/>
				<input type="hidden" name="tableName" value="computer"/>
			</form>
			<?php include("templates/footer.php"); ?>
	</body>
</html>