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

	function installedStuffLookup($title, $tableName) {
		?>					<section>
						<header class="tableRow gray"><h3><?=$title?></h3></header>
<?php
		global $computer;
		$table = new Table($tableName);
		$result = $table->runQuery();
		$installedItems = explode(" - ", $computer[$table->getName()."_list"]);
		$i = 0;
		foreach ($result as $row) {
			if ($i == 0) {
				echo("				<div class=\"tableRow\">");
			}
			$isInstalled = in_array($row[$table->getName()."_name"], $installedItems);
			echo("							<div class=\"tableCell quarterWidth".($isInstalled ? " gray" : "")."\">
								<label class=\"configLabel\"><input class=\"configCheckbox\" name=\"{$table->getName()}_list[]\" type=\"checkbox\" value=\"{$row[$table->getName()."_name"]}\"".($isInstalled ? " checked" : "")."/>
								{$row[$table->getName()."_name"]}</label>
							</div>
");
			if ($i++ == 3) {
				echo("				</div>");
				$i = 0;
			}
		}?>					</section>
<?php
	}

	$pageTitle = "Editing {$computer["computer_name"]}";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			$(function() {
				$(".configCheckbox").click(function(event) {
					$.post(
						"actions/editInfoAction.php",
						$("#editConfigForm").serialize()
					).done(function() {
						$("header.hero").addClass("green");
						html = $("header.hero h3").html();
						$("header.hero h3").html("Sucsessfully edited <?=$computer["computer_name"]?>!");
						setTimeout(function() {
							$("header.hero").removeClass("green");
							$("header.hero h3").html(html);
						}, 1000);
					});
					$(this).closest(".tableCell").toggleClass("gray");
				});
			});
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<span id="customNav">
				<a href="viewComputer.php?computerName=<?=$computer["computer_name"]?>">Back</a> to <?=$computer["computer_name"]?>
			</span>
			<main>
				<header class="hero blue">
					<h3>Editing <?=$computer["computer_name"]?></h3>
				</header>
				<form id="editConfigForm">
					<?php
						installedStuffLookup("Applications", "application");
						installedStuffLookup("Configuration", "config");
						installedStuffLookup("Hardware", "hardware");
						installedStuffLookup("Updates", "update");
						installedStuffLookup("Printers", "printer");
					?>
					<input type="hidden" name="computer_id" value="<?=$computer["computer_id"]?>"/>
				</form>
			</main>
			<?php include("templates/footer.php"); ?>
	</body>
</html>