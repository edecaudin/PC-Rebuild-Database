<?php
	session_start();

    include "checkLoggedIn.php";
	include "pc_stuff_lookup.php";

	include "classes/Computer.php";
	$computer = new Computer($_GET["computerName"]);
	
	if (!$computer->doesExist) {
		echo "<script type=\"text/javascript\">
			alert(\"{$_GET["computerName"]} does not exist!\");
			window.history.back();
		</script>";
		exit;
	}
	
	$pageTitle = $computer["hostname"];
	$headerContent = "<strong id=\"rightLinks\">
		<a href=\"editInfo.php?computerName={$computer["hostname"]}\" class=\"navLink green\">Edit</a> Info - 
		<a href=\"editConfig.php?computerName={$computer["hostname"]}\" class=\"navLink green\">Edit</a> Config - 
		<a href=\"javascript:deleteComputer()\" class=\"navLink red\">Delete</a> {$computer["hostname"]}
	</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include "head.php"; ?>
		<link rel="stylesheet"" href="../../rebuild/resources/print.css">
		<script>
			function deleteComputer() {
				if (confirm("Are you sure you want to delete <?=$computer["hostname"]?>?")) {
					window.location.assign("support/deleteComputerAction.php?computerName=<?=$computer["hostname"]?>");
				}
			}
		</script>
	</head>
	<body>
		<?php include "header.php"; ?>
			<?php
				function getInstalledItems($fieldname) {
					global $computer;
					$field = $computer[$fieldname];
					if ($field === "") {
						echo "<tr>
								<td>Nothing to do here!</td>
							</tr>";
					} else {
						$items = explode(" - ", $field);
						foreach ($items as $item) {
							echo "<tr>
									<td>
										<input type=\"checkbox\"/>{$item}
									</td>
								</tr>";
						}
					}
				}
			?>
			<div class="portal blue" id="viewComputer">
				<h1 id="printComputerName"><?=$computer["hostname"]?></h1><h2 id="printOS">Service Tag: <?=$computer["servicetag"]?> - OS: <?=$computer["os"]?></h2>
			</div>
			<table>
				<tr>
					<td>Employee:</td>
					<td><?=$computer["employee"]?></td>
					<td>Ex-Employee:</td>
					<td><?=$computer["exemployee"]?></td>
				</tr>
				<tr>
					<td>Rebuilder:</td>
					<td><?=$computer["rebuilder"]?></td>
					<td>Password:</td>
					<td><?=$computer["password"]?></td>
				</tr>
				<tr>
					<td>Model:</td>
					<td><?=$computer["model"]?></td>
					<td>CPU:</td>
					<td><?=$computer["cpu"]?></td>
				</tr>
				<tr>
					<td>RAM:</td>
					<td><?=$computer["ram"]?></td>
					<td>HDD:</td>
					<td><?=$computer["hdd"]?></td>
				</tr>
				<tr>
					<td>Optical Drive:</td>
					<td><?=$computer["opt"]?></td>
					<td>Battery:</td>
					<td><?=$computer["power"]?></td>
				</tr>
				<tr>
					<td>OS License Key:</td>
					<td><?=$computer["oskey"]?></td>
					<td>Express Service Code:</td>
					<td><?=$computer["escode"]?></td>
				</tr>
				<tr>
					<td>MAC-Address LAN:</td>
					<td><?=$computer["maclan"]?></td>
					<td>MAC-Address WAN:</td>
					<td><?=$computer["macwifi"]?></td>
				</tr>
				<tr>
					<td>Date of Build:</td>
					<td><?=$computer["date"]?></td>
					<td>Date of Purchase:</td>
					<td><?=$computer["dop"]?></td>
				</tr>
				<tr>
					<td>Cell Phone Number:</td>
					<td><?=$computer["cell"]?></td>
					<td>Broadview Number:</td>
					<td><?=$computer["broadview"]?></td>
				</tr>
				<tr>
					<td>Silverpop Account:</td>
					<td><?=$computer["silverpop"]?></td>
					<td>EFax Account:</td>
					<td><?=$computer["efax"]?></td>
				</tr>
			</table>
			<div id="software">
				<table>
					<tr>
	 					<td class="tobedone" colspan="2">Applications</td>
					</tr>
					<?php
						getInstalledItems("programs");
					?>
				</table>
			</div>
			<div id="updates">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Updates to be installed</td>
					</tr>
					<?php
						getInstalledItems("updates");
					?>
				</table>
			</div>
			<div id="configuration">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Configuration</td>
					</tr>
					<?php
						getInstalledItems("config");
					?>
				</table>
			</div>
			<div id="printer">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Printers</td>
					</tr>
					<?php
						getInstalledItems("printers");
					?>
				</table>
			</div>
			<div id="hardware">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Additional Hardware</td>
					</tr>
					<?php
						getInstalledItems("addhw");
					?>
				</table>
			</div>
			<div id="notes">
				<table>
					<tr>
						<td class="tobedone">Notes</td><td></td>
					</tr>
					<tr>
    					<td colspan="2"><?=$computer["notes"]?></td>
   					</tr>
				</table>
			</div>
			<?php
				include "footer.php";
			?>