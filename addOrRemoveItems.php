<?php
	session_start();

	include 'checkLoggedIn.php';
	include 'pc_stuff_lookup.php';

	$pageTitle = "Add or Remove Items";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
		<script>
			function removeItem(item, id) {
				if (confirm("Are you sure you want to delete " + document.getElementById(item).value + "?")) {
					document.forms[id].submit();
				}
			}
		</script>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<div class="portal blue">
				<h2>Add or Remove Items</h2>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> an application</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="table" value="software"/>
					<input type="hidden" name="field" value="programs"/>
					<input type="submit" value="Add Application"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> a printer</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="table" value="printers"/>
					<input type="hidden" name="field" value="device"/>
					<input type="submit" value="Add Printer"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> something to update</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="table" value="updates"/>
					<input type="hidden" name="field" value="update_software"/>
					<input type="submit" value="Add Update"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> a configuration step</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="table" value="config"/>
					<input type="hidden" name="field" value="configuration"/>
					<input type="submit" value="Add Configuration"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> hardware to give to users</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="table" value="hardware"/>
					<input type="hidden" name="field" value="additionalhardware"/>
					<input type="submit" value="Add Hardware"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> an OS</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="table" value="operating_systems"/>
					<input type="hidden" name="field" value="os_select"/>
					<input type="submit" value="Add OS"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> an application</h2>
				<form id="removeApplication" action="support/removeItemAction.php" method="post">
					<select id="selectApplication" name="item">
						<?php  
							getTableItems('programs', 'software');
						?>
					</select>
					<input type="hidden" name="table" value="software"/>
					<input type="hidden" name="field" value="programs"/>
					<input type="button" value="Remove Application" onClick="removeItem('selectApplication', 'removeApplication')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> a printer</h2>
				<form id="removePrinter" action="support/removeItemAction.php" method="post">
					<select id="selectPrinter" name="item">
						<?php  
							getTableItems('device', 'printers');
						?>
					</select>
					<input type="hidden" name="table" value="printers"/>
					<input type="hidden" name="field" value="device"/>
					<input type="button" value="Remove Printer" onClick="removeItem('selectPrinter', 'removePrinter')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> something to update</h2>
				<form id="removeUpdate" action="support/removeItemAction.php" method="post">
					<select id="selectUpdate" name="item">
						<?php  
							getTableItems('update_software', 'updates');
						?>
					</select>
					<input type="hidden" name="table" value="updates"/>
					<input type="hidden" name="field" value="update_software"/>
					<input type="button" value="Remove Update" onClick="removeItem('selectUpdate', 'removeUpdate')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> a configuration step</h2>
				<form id="removeConfiguration" action="support/removeItemAction.php" method="post">
					<select id="selectConfiguration" name="item">
						<?php  
							getTableItems('configuration', 'config');
						?>
					</select>
					<input type="hidden" name="table" value="config"/>
					<input type="hidden" name="field" value="configuration"/>
					<input type="button" value="Remove Configuration" onClick="removeItem('selectConfiguration', 'removeConfiguration')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> hardware to give to users</h2>
				<form id="removeHardware" action="support/removeItemAction.php" method="post">
					<select id="selectHardware" name="item">
						<?php  
							getTableItems('additionalhardware', 'hardware');
						?>
					</select>
					<input type="hidden" name="table" value="hardware"/>
					<input type="hidden" name="field" value="additionalhardware"/>
					<input type="button" value="Remove Hardware" onClick="removeItem('selectHardware', 'removeHardware')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> an OS</h2>
				<form id="removeOS" action="support/removeItemAction.php" method="post">
					<select id="selectOS" name="item">
						<?php  
							getTableItems('os_select', 'operating_systems');
						?>
					</select>
					<input type="hidden" name="table" value="operating_systems"/>
					<input type="hidden" name="field" value="os_select"/>
					<input type="button" value="Remove OS" onClick="removeItem('selectOS', 'removeOS')"/>
				</form>
			</div>
			<?php
				include 'footer.php';
			?>