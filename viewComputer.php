<?php
	session_start();

    include 'checkLoggedIn.php';
	include "pc_stuff_lookup.php";
	include 'array_report.php';

	$computerName = $_GET['computerName'];
	$pageTitle = $computerName;
	$headerContent = "<span id='rightLinks'>
		<a href='editInfo.php?computerName={$computerName}' class='navLink, green'>Edit</a> Info - 
		<a href='editConfig.php?computerName={$computerName}' class='navLink, green'>Edit</a> Config - 
		<a href='javascript:deleteComputer()' class='navLink, red'>Delete</a> {$computerName}
	</span>";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
		<link rel='stylesheet' href='../../rebuild/resources/print.css'>
		<script>
			function deleteComputer() {
				if (confirm("Are you sure you want to delete <?=$computerName?>?")) {
					window.location.assign("support/deleteComputerAction.php?computerName=<?=$computerName?>");
				}
			}
		</script>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<?php
				include "support/mysqlConnect.php";
				$list = mysqli_fetch_object(mysqli_query($mysqlConnection, "SELECT * FROM computer WHERE hostname = '{$computerName}' "));
				mysqli_close($mysqlConnection);
				
				function getInstalledItems($hostname, $fieldname) {
					include "support/mysqlConnect.php";
					$result = mysqli_query($mysqlConnection, "SELECT $fieldname FROM computer WHERE hostname = '{$hostname}'");
					$item = mysqli_fetch_row($result);
					if ($item[0] === "") {
						echo "<tr>
								<td>Nothing to do here!</td>
							</tr>";
					} else {
						$items = explode(" - ", $item[0]);
						for ($i = 0; $i < count($items); $i++) {
							echo "<tr>
									<td>
										<input type='checkbox'/>{$items[$i]}
									</td>
								</tr>";
						}
					}
					mysqli_close($mysqlConnection);
				}
			?>
			<div class="portal blue" id="viewComputer">
				<h1 id="printComputerName"><?=$computerName?></h1><h2 id="printOS">Service Tag: <?=$list->servicetag?> - OS: <?=$list->os?></h2>
			</div>
			<table>
				<tr>
					<td>Employee:</td>
					<td><?=$list->employee?></td>
					<td>Ex-Employee:</td>
					<td><?=$list->exemployee?></td>
				</tr>
				<tr>
					<td>Rebuilder:</td>
					<td><?=$list->rebuilder?></td>
					<td>Password:</td>
					<td><?=$list->password?></td>
				</tr>
				<tr>
					<td>Model:</td>
					<td><?=$list->model?></td>
					<td>CPU:</td>
					<td><?=$list->cpu?></td>
				</tr>
				<tr>
					<td>RAM:</td>
					<td><?=$list->ram?></td>
					<td>HDD:</td>
					<td><?=$list->hdd?></td>
				</tr>
				<tr>
					<td>Optical Drive:</td>
					<td><?=$list->opt?></td>
					<td>Battery:</td>
					<td><?=$list->power?></td>
				</tr>
				<tr>
					<td>Service Tag:</td>
					<td><?=$list->servicetag?></td>
					<td>Express Service Code:</td>
					<td><?=$list->escode?></td>
				</tr>
				<tr>
					<td>MAC-Address LAN:</td>
					<td><?=$list->maclan?></td>
					<td>MAC-Address WAN:</td>
					<td><?=$list->macwifi?></td>
				</tr>
				<tr>
					<td>Date of Build:</td>
					<td><?=$list->date?></td>
					<td>Date of Purchase:</td>
					<td><?=$list->dop?></td>
				</tr>
				<tr>
					<td>Cell Phone Number:</td>
					<td><?=$list->cell?></td>
					<td>Broadview Number:</td>
					<td><?=$list->broadview?></td>
				</tr>
				<tr>
					<td>Silverpop Account:</td>
					<td><?=$list->silverpop?></td>
					<td>EFax Account:</td>
					<td><?=$list->efax?></td>
				</tr>
			</table>
			<div id="software">
				<table>
					<tr>
	 					<td class="tobedone" colspan="2">Applications</td>
					</tr>
					<?php
						getInstalledItems($computerName, 'programs')
					?>
				</table>
			</div>
			<div id="updates">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Updates to be installed</td>
					</tr>
					<?php
						getInstalledItems($computerName, 'updates')
					?>
				</table>
			</div>
			<div id="configuration">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Configuration</td>
					</tr>
					<?php
						getInstalledItems($computerName, 'config')
					?>
				</table>
			</div>
			<div id="printer">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Printers</td>
					</tr>
					<?php
						getInstalledItems($computerName, 'printers')
					?>
				</table>
			</div>
			<div id="hardware">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Additional Hardware</td>
					</tr>
					<?php
						getInstalledItems($computerName, 'addhw')
					?>
				</table>
			</div>
			<div id="notes">
				<table>
					<tr>
						<td class="tobedone">Notes</td><td></td>
					</tr>
					<tr>
    					<td colspan="2"><?=$list->notes;?></td>
   					</tr>
				</table>
			</div>
			<?php
				include 'footer.php';
			?>