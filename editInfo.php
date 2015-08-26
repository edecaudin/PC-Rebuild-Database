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

	$pageTitle = "Editing {$computer["computer_name"]}";
	$headerContent = "<strong id=\"rightLinks\">
					<a href=\"viewComputer.php?computerName={$computer["computer_name"]}\" class=\"navLink\">Back</a> to {$computer["computer_name"]} - 
					<a href=\"javascript:document.forms['editInfo'].submit()\" class=\"navLink green\">Save</a> Info
				</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<?php
				function echoRow($label1, $fieldName1, $label2, $fieldName2) {
					global $computer;
					echo("<div class=\"tableRow\">
					<div class=\"tableCell\">{$label1}:</div>
					<div class=\"tableCell\">");
					if ($fieldName1 === "rebuilder") {
						echo("<select name=\"{$fieldName1}\">");
						$table = new Table("rebuilder");
						$table->echoRowsAsOptions($table->runQuery(), $computer["rebuilder"]);
						echo("</select>");
					} else {
						echo("<input type=\"text\" name=\"{$fieldName1}\" value=\"{$computer[$fieldName1]}\"/>");
					}
					echo("</div>
					<div class=\"tableCell\">{$label2}:</div>
					<div class=\"tableCell\"><input type=\"text\" name=\"{$fieldName2}\" value=\"{$computer[$fieldName2]}\"/></div>
				</div>
				");
				}
			?>
			<form id="editInfo" action="actions/editInfoAction.php" method="post">
				<div class="portal blue" id="viewComputer">
					<h3><span id="computerName">Editing <input type="text" name="computer_name" value="<?=$computer["computer_name"]?>" maxlength="15"/></span>
					Service Tag: <input type="text" name="service_tag" value="<?=$computer["service_tag"]?>"/> -
						<select name="operating_system">
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
					echoRow("MAC Address (LAN)", "mac_lan", "MAC Address (WLAN)", "mac_wlan");
					echoRow("Rebuild Date", "rebuild_date", "Purcase Date", "purchase_date");
					echoRow("Cell Phone Number", "cell_number", "Broadview Number", "broadview_number");
				?>
				<div class="tableRow">
					<div class="tableCell">Notes:</div>
					<div class="tableSection"><textarea name="notes" id="notesTextArea"><?=$computer["notes"]?></textarea></div>
				</div>
				<input type="hidden" name="computer_id" value="<?=$computer["computer_id"]?>"/>
			</form>
			<?php include("templates/footer.php"); ?>
	</body>
</html>