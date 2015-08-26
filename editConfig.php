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
					<a href=\"javascript:document.forms['editConfig'].submit()\" class=\"navLink green\">Save</a> Config
				</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<div class="portal blue">
				<h3>Editing <?=$computer["computer_name"]?></h3>
			</div>
			<?php
				function installedStuffLookup($tableName, $fieldName) {
					global $computer;
					$installedItems = explode(" - ", $computer[$fieldName]);

					$table = new Table($tableName);
					$result = $table->runQuery();
					foreach ($result as $row) {
						$isInstalled = in_array($row[$table->getName()."_name"], $installedItems);
						echo("<div class=\"tableCell".($isInstalled ? " gray" : "")."\">
							<input type=\"checkbox\" name=\"{$table->getName()}_list[]\" value=\"{$row[$table->getName()."_name"]}\"".($isInstalled ? " checked" : "")."/>
							{$row[$table->getName()."_name"]}
						</div>");
					}
				}
			?>
			<form id="editConfig" action="actions/editConfigAction.php" method="post">
				<?php
					echo("<div class=\"tableHeader gray\"><h3>Applications</h3></div>");
					installedStuffLookup("application", "application_list");
					echo("<div class=\"tableHeader gray\"><h3>Configuration</h3></div>");
					installedStuffLookup("config", "config_list");
					echo("<div class=\"tableHeader gray\"><h3>Additional Hardware</h3></div>");
					installedStuffLookup("hardware", "hardware_lsit");
					echo("<div class=\"tableHeader gray\"><h3>Updates</h3></div>");
					installedStuffLookup("update", "update_list");
					echo("<div class=\"tableHeader gray\"><h3>Printers:</h3></div>");
					installedStuffLookup("printer", "printer_list");
				?>
				<input type="hidden" name="computer_id" value="<?=$computer["computer_id"]?>"/>
			</form>
			<?php include("templates/footer.php"); ?>
	</body>
</html>