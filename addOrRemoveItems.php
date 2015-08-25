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
					<input type="hidden" name="tableName" value="application"/>
					<input type="submit" value="Add Application"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> a printer</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="tableName" value="printer"/>
					<input type="submit" value="Add Printer"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> something to update</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="tableName" value="update"/>
					<input type="submit" value="Add Update"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> a configuration step</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="tableName" value="config"/>
					<input type="submit" value="Add Configuration"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> hardware to give to users</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="tableName" value="hardware"/>
					<input type="submit" value="Add Hardware"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="green">Add</span> an OS</h2>
				<form action="support/addItemAction.php" method="post">
					<input type="text" name="item"/>
					<input type="hidden" name="tableName" value="operating_system"/>
					<input type="submit" value="Add OS"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> an application</h2>
				<form id="removeApplication" action="support/deleteItemAction.php" method="post">
					<select id="selectApplication" name="item">
						<?php  
							getTableItems("application");
						?>
					</select>
					<input type="hidden" name="tableName" value="application"/>
					<input type="button" value="Remove Application" onClick="removeItem('selectApplication', 'removeApplication')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> a printer</h2>
				<form id="removePrinter" action="support/deleteItemAction.php" method="post">
					<select id="selectPrinter" name="item">
						<?php  
							getTableItems("printer");
						?>
					</select>
					<input type="hidden" name="tableName" value="printer"/>
					<input type="button" value="Remove Printer" onClick="removeItem('selectPrinter', 'removePrinter')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> something to update</h2>
				<form id="removeUpdate" action="support/deleteItemAction.php" method="post">
					<select id="selectUpdate" name="item">
						<?php  
							getTableItems("update");
						?>
					</select>
					<input type="hidden" name="tableName" value="update"/>
					<input type="button" value="Remove Update" onClick="removeItem('selectUpdate', 'removeUpdate')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> a configuration step</h2>
				<form id="removeConfiguration" action="support/deleteItemAction.php" method="post">
					<select id="selectConfiguration" name="item">
						<?php  
							getTableItems("config");
						?>
					</select>
					<input type="hidden" name="tableName" value="config"/>
					<input type="button" value="Remove Configuration" onClick="removeItem('selectConfiguration', 'removeConfiguration')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> hardware to give to users</h2>
				<form id="removeHardware" action="support/deleteItemAction.php" method="post">
					<select id="selectHardware" name="item">
						<?php  
							getTableItems("hardware");
						?>
					</select>
					<input type="hidden" name="tableName" value="hardware"/>
					<input type="button" value="Remove Hardware" onClick="removeItem('selectHardware', 'removeHardware')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Remove</span> an OS</h2>
				<form id="removeOS" action="support/deleteItemAction.php" method="post">
					<select id="selectOS" name="item">
						<?php  
							getTableItems("operating_system");
						?>
					</select>
					<input type="hidden" name="tableName" value="operating_system"/>
					<input type="button" value="Remove OS" onClick="removeItem('selectOS', 'removeOS')"/>
				</form>
			</div>
			<?php
				include 'footer.php';
			?>