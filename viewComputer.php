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
		<link rel="stylesheet" href="resources/print.css">
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
				function getInstalledItems($fieldname) {
					global $computer;
					$field = $computer[$fieldname];
					if ($field === "") {
						echo("<div class=\"viewRow\">
								Nothing to do here!
							</div>");
					} else {
						$items = explode(" - ", $field);
						foreach ($items as $item) {
							echo("<div class=\"viewRow\">
									<input type=\"checkbox\"/>{$item}
								</div>");
						}
					}
				}
			?>
			<div class="portal blue" id="viewComputer">
				<h1 id="printComputerName"><?=$computer["computer_name"]?></h1>
				<h2 id="printOS">Service Tag: <?=$computer["servicetag"]?> - OS: <?=$computer["os"]?></h2>
			</div>
			<div class="viewRow">
				<div class="viewCell">Employee:</div>
				<div class="viewCell"><?=$computer["employee"]?></div>
				<div class="viewCell">Ex-Employee:</div>
				<div class="viewCell"><?=$computer["exemployee"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">Rebuilder:</div>
				<div class="viewCell"><?=$computer["rebuilder"]?></div>
				<div class="viewCell">Password:</div>
				<div class="viewCell"><?=$computer["password"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">Model:</div>
				<div class="viewCell"><?=$computer["model"]?></div>
				<div class="viewCell">CPU:</div>
				<div class="viewCell"><?=$computer["cpu"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">RAM:</div>
				<div class="viewCell"><?=$computer["ram"]?></div>
				<div class="viewCell">HDD:</div>
				<div class="viewCell"><?=$computer["hdd"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">Optical Drive:</div>
				<div class="viewCell"><?=$computer["opt"]?></div>
				<div class="viewCell">Battery:</div>
				<div class="viewCell"><?=$computer["power"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">OS License Key:</div>
				<div class="viewCell"><?=$computer["oskey"]?></div>
				<div class="viewCell">Express Service Code:</div>
				<div class="viewCell"><?=$computer["escode"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">MAC Address (LAN):</div>
				<div class="viewCell"><?=$computer["maclan"]?></div>
				<div class="viewCell">MAC Address (WLAN):</div>
				<div class="viewCell"><?=$computer["macwifi"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">Date of Build:</div>
				<div class="viewCell"><?=$computer["date"]?></div>
				<div class="viewCell">Date of Purchase:</div>
				<div class="viewCell"><?=$computer["dop"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">Cell Phone Number:</div>
				<div class="viewCell"><?=$computer["cell"]?></div>
				<div class="viewCell">Broadview Number:</div>
				<div class="viewCell"><?=$computer["broadview"]?></div>
			</div>
			<div class="viewRow">
				<div class="viewCell">Silverpop Account:</div>
				<div class="viewCell"><?=$computer["silverpop"]?></div>
				<div class="viewCell">EFax Account:</div>
				<div class="viewCell"><?=$computer["efax"]?></div>
			</div>
			<div class="viewSection">
				<div class="viewRow gray">Applications</div>
				<?php
					getInstalledItems("programs");
				?>
			</div>
			<div class="viewSection">
				<div class="viewRow gray">Updates to be installed</div>
				<?php
					getInstalledItems("updates");
				?>
			</div>
			<div class="viewSection">
				<div class="viewRow gray">Configuration</div>
				<?php
					getInstalledItems("config");
				?>
			</div>
			<div class="viewSection">
				<div class="viewRow gray">Printers</div>
				<?php
					getInstalledItems("printers");
				?>
			</div>
			<div class="viewSection">
				<div class="viewRow gray">Additional Hardware</div>
				<?php
					getInstalledItems("addhw");
				?>
			</div>
			<div class="viewSection">
				<div class="viewRow gray">Notes</div>
				<div class="viewRow"><?=$computer["notes"]?></div>
			</div>
			<form id="deleteComputer" action="actions/deleteItemAction.php" method="post">
				<input type="hidden" name="item" value="<?=$computer["computer_name"]?>"/>
				<input type="hidden" name="tableName" value="computer"/>
			</form>
			<?php include("templates/footer.php"); ?>
	</body>
</html>