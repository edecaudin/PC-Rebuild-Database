<?php
	session_start();

	require("checkLoggedIn.php");
	require_once("classes/Table.php");

	$pageTitle = "Add or Delete Items";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
		<script>
			function deleteItem(item, id) {
				if (confirm("Are you sure you want to delete " + document.getElementById(item).value + "?")) {
					document.forms[id].submit();
				}
			}
		</script>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<div class="portal blue">
				<h2>Add or Delete Items</h2>
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
				<h2><span class="red">Delete</span> an application</h2>
				<form id="deleteApplication" action="support/deleteItemAction.php" method="post">
					<select id="selectApplication" name="item">
						<?php  
							$table = new Table("application");
							$table->echoRowsAsOptions($table->runQuery());
						?>
					</select>
					<input type="hidden" name="tableName" value="application"/>
					<input type="button" value="Delete Application" onClick="deleteItem('selectApplication', 'deleteApplication')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Delete</span> a printer</h2>
				<form id="deletePrinter" action="support/deleteItemAction.php" method="post">
					<select id="selectPrinter" name="item">
						<?php  
							$table = new Table("printer");
							$table->echoRowsAsOptions($table->runQuery());
						?>
					</select>
					<input type="hidden" name="tableName" value="printer"/>
					<input type="button" value="Delete Printer" onClick="deleteItem('selectPrinter', 'deletePrinter')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Delete</span> something to update</h2>
				<form id="deleteUpdate" action="support/deleteItemAction.php" method="post">
					<select id="selectUpdate" name="item">
						<?php  
							$table = new Table("update");
							$table->echoRowsAsOptions($table->runQuery());
						?>
					</select>
					<input type="hidden" name="tableName" value="update"/>
					<input type="button" value="Delete Update" onClick="deleteItem('selectUpdate', 'deleteUpdate')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Delete</span> a configuration step</h2>
				<form id="deleteConfiguration" action="support/deleteItemAction.php" method="post">
					<select id="selectConfiguration" name="item">
						<?php  
							$table = new Table("config");
							$table->echoRowsAsOptions($table->runQuery());
						?>
					</select>
					<input type="hidden" name="tableName" value="config"/>
					<input type="button" value="Delete Configuration" onClick="deleteItem('selectConfiguration', 'deleteConfiguration')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Delete</span> hardware to give to users</h2>
				<form id="deleteHardware" action="support/deleteItemAction.php" method="post">
					<select id="selectHardware" name="item">
						<?php  
							$table = new Table("hardware");
							$table->echoRowsAsOptions($table->runQuery());
						?>
					</select>
					<input type="hidden" name="tableName" value="hardware"/>
					<input type="button" value="Delete Hardware" onClick="deleteItem('selectHardware', 'deleteHardware')"/>
				</form>
			</div>
			<div class="box">
				<h2><span class="red">Delete</span> an OS</h2>
				<form id="deleteOS" action="support/deleteItemAction.php" method="post">
					<select id="selectOS" name="item">
						<?php  
							$table = new Table("operating_system");
							$table->echoRowsAsOptions($table->runQuery());
						?>
					</select>
					<input type="hidden" name="tableName" value="operating_system"/>
					<input type="button" value="Delete OS" onClick="deleteItem('selectOS', 'deleteOS')"/>
				</form>
			</div>
			<?php
				include 'footer.php';
			?>