<?php
	session_start();

    include 'checkLoggedIn.php';  
    include 'connection.php';
    include 'pc_stuff_lookup.php';
	include 'array_report.php';

	$computerName = $_GET['computerName'];
	$row = mysql_fetch_array(mysql_query("SELECT * FROM computer WHERE hostname = '$computerName' "));
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
			<div class="portal blue" id="viewComputer">
				<h1 id="printComputerName"><?=$computerName?></h1><h2 id="printOS">Service Tag: <?=$row[14]?> - OS: <?=$row[2]." ".$row[3]?></h2>
			</div>
			<table>
				<?php
					$j = 3;
				
					for ($i=4; $i < (count($row)/2); $i++) {
						if ($i<18) {
							echo "<tr>
					<td>".$array_report[$j]."</td>
					<td>".$row[$i]."</td>";
							$j++;$i++;
							echo "
					<td>".$array_report[$j]."</td>
					<td>".$row[$i]."</td>
				</tr>
				";
							$j++;
						} else if ($i == 18) {
							echo "<tr>
					<td>".$array_report[$j]."</td>
					<td>".$row[$i]."</td>
				</tr>
				";
							$i++;
						} else if ($i>=19 && $i<=25) {
							$j=25;
						} else if ($i>25) {
							echo "<tr>
					<td>".$array_report[$j]."</td>
					<td>".$row[$i]."</td>";
							$j++;$i++;
							echo "
					<td>".$array_report[$j]."</td>
					<td>".$row[$i]."</td>
				</tr>
				";
							$j++;
						}
					}
					$notes = $row[25];
				?>
			</table>
			<div id="software">
				<table>
					<tr>
	 					<td class="tobedone" colspan="2">Applications</td>
					</tr>
					<?php
						getInstalledItems($computerName,'programs')
					?>
				</table>
			</div>
			<div id="updates">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Updates to be installed</td>
					</tr>
					<?php
						getInstalledItems($computerName,'updates')
					?>
				</table>
			</div>
			<div id="configuration">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Configuration</td>
					</tr>
					<?php
						getInstalledItems($computerName,'config')
					?>
				</table>
			</div>
			<div id="printer">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Printers</td>
					</tr>
					<?php
						getInstalledItems($computerName,'printers')
					?>
				</table>
			</div>
			<div id="hardware">
				<table>
					<tr>
						<td class="tobedone" colspan="2">Additional Hardware</td>
					</tr>
					<?php
						getInstalledItems($computerName,'addhw')
					?>
				</table>
			</div>
			<div id="notes">
				<table>
					<tr>
						<td class="tobedone">Notes</td><td></td>
					</tr>
					<tr>
    					<td colspan="2"><?php echo $notes; ?></td>
   					</tr>
				</table>
			</div>
			<?php
				mysql_close($connection);
				include 'footer.php';
			?>