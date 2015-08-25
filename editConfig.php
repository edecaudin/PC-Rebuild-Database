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
					<a href=\"javascript:document.forms['editConfig'].submit()\" class=\"navLink, green\">Save</a> Config
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
				<h2>Editing <?=$computer["computer_name"]?></h2>
			</div>
			<?php
				function installedStuffLookup($tableName, $fieldName) {
					global $computer;
					$installedItems = explode(" - ", $computer[$fieldName]);

					$table = new Table($tableName);
					$result = $table->runQuery();
					foreach ($result as $row) {
						$isInstalled = in_array($row[$table->getName()."_name"], $installedItems);
						echo("<div class=\"configCell".($isInstalled ? " gray" : "")."\">
							<input type=\"checkbox\" name=\"{$table->getName()}[]\" value=\"{$row[$table->getName()."_name"]}\"".($isInstalled ? " checked" : "")."/>
							{$row[$table->getName()."_name"]}
						</div>");
					}
				}
			?>
			<form id="editConfig" action="actions/editConfigAction.php" method="post">
				<?php
					echo("<div class=\"configHeader gray\"><h2>Applications</h2></div>");
					installedStuffLookup("application", "programs");
					echo("<div class=\"configHeader gray\"><h2>Configuration</h2></div>");
					installedStuffLookup("config", "config");
					echo("<div class=\"configHeader gray\"><h2>Additional Hardware</h2></div>");
					installedStuffLookup("hardware", "addhw");
					echo("<div class=\"configHeader gray\"><h2>Updates</h2></div>");
					installedStuffLookup("update", "updates");
					echo("<div class=\"configHeader gray\"><h2>Printers:</h2></div>");
					installedStuffLookup("printer", "printers");
				?>
				<input type="hidden" name="computer_id" value="<?=$computer["computer_id"]?>"/>
			</form>
			<?php include("templates/footer.php"); ?>
	</body>
</html>