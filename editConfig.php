<?php
	require("actions/checkLoggedInAction.php");
	require_once("mysql/Table.php");

	$computer = new Row(new Table("computer"), $_GET["computerName"]);
	if (!$computer->doesExist()) {
		echo("<script>
			alert(\"{$_GET["computerName"]} does not exist!\");
			history.back();
		</script>");
		exit();
	}

	$pageTitle = "Editing {$computer["computer_name"]}";
	$headerContent = "<strong id=\"rightLinks\">
					<a href=\"viewComputer.php?computerName={$computer["computer_name"]}\">Back</a> to {$computer["computer_name"]} - 
					<a id=\"submitButton\" class=\"green\" href=\"#\" >Save</a> Config
				</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			$(function() {
				$("#submitButton").click(function(event) {
					event.preventDefault();
					$.post("actions/editInfoAction.php", $("#editConfigForm").serialize(), function(data) {
						location.reload();
					});
				});
				$(".configCheckbox").click(function(event) {
					$(this).closest(".tableCell").toggleClass("gray");
				});
			});
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<hgroup class="blue">
				<h3>Editing <?=$computer["computer_name"]?></h3>
			</hgroup>
			<?php
				function installedStuffLookup($tableName) {
					global $computer;
					$table = new Table($tableName);
					$result = $table->runQuery();
					$installedItems = explode(" - ", $computer[$table->getName()."_list"]);
					foreach ($result as $row) {
						$isInstalled = in_array($row[$table->getName()."_name"], $installedItems);
						echo("<div class=\"tableCell".($isInstalled ? " gray" : "")."\">
							<label class=\"configLabel\"><input class=\"configCheckbox\" name=\"{$table->getName()}_list[]\" type=\"checkbox\" value=\"{$row[$table->getName()."_name"]}\"".($isInstalled ? " checked" : "")."/>
							{$row[$table->getName()."_name"]}</label>
						</div>");
					}
				}
			?>
			<form id="editConfigForm">
				<?php
					echo("<div class=\"tableHeader gray\"><h3>Applications</h3></div>");
					installedStuffLookup("application");
					echo("<div class=\"tableHeader gray\"><h3>Configuration</h3></div>");
					installedStuffLookup("config");
					echo("<div class=\"tableHeader gray\"><h3>Additional Hardware</h3></div>");
					installedStuffLookup("hardware");
					echo("<div class=\"tableHeader gray\"><h3>Updates</h3></div>");
					installedStuffLookup("update");
					echo("<div class=\"tableHeader gray\"><h3>Printers:</h3></div>");
					installedStuffLookup("printer");
				?>
				<input type="hidden" name="computer_id" value="<?=$computer["computer_id"]?>"/>
			</form>
			<?php include("templates/footer.php"); ?>
	</body>
</html>