<?php
	require("actions/checkLoggedInAction.php");
	require_once("mysql/Table.php");

	$pageTitle = "Add or Delete Items";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			function deleteItem(item, id) {
				if (confirm("Are you sure you want to delete " + document.getElementById(item).value + "?")) {
					document.forms[id].submit();
				}
			}
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<div class="portal blue">
				<h3>Add or Delete Items</h3>
			</div>
			<div class="tableSection">
				<div class="box">
					<h3><span class="green">Add</span> an application</h3>
					<form action="actions/addItemAction.php" method="post">
						<input type="text" name="item"/>
						<input type="hidden" name="tableName" value="application"/>
						<input type="submit" value="Add Application"/>
					</form>
				</div>
				<div class="box">
					<h3><span class="green">Add</span> a printer</h3>
					<form action="actions/addItemAction.php" method="post">
						<input type="text" name="item"/>
						<input type="hidden" name="tableName" value="printer"/>
						<input type="submit" value="Add Printer"/>
					</form>
				</div>
				<div class="box">
					<h3><span class="green">Add</span> something to update</h3>
					<form action="actions/addItemAction.php" method="post">
						<input type="text" name="item"/>
						<input type="hidden" name="tableName" value="update"/>
						<input type="submit" value="Add Update"/>
					</form>
				</div>
				<div class="box">
					<h3><span class="green">Add</span> a configuration step</h3>
					<form action="actions/addItemAction.php" method="post">
						<input type="text" name="item"/>
						<input type="hidden" name="tableName" value="config"/>
						<input type="submit" value="Add Configuration"/>
					</form>
				</div>
				<div class="box">
					<h3><span class="green">Add</span> hardware to give to users</h3>
					<form action="actions/addItemAction.php" method="post">
						<input type="text" name="item"/>
						<input type="hidden" name="tableName" value="hardware"/>
						<input type="submit" value="Add Hardware"/>
					</form>
				</div>
				<div class="box">
					<h3><span class="green">Add</span> an OS</h3>
					<form action="actions/addItemAction.php" method="post">
						<input type="text" name="item"/>
						<input type="hidden" name="tableName" value="operating_system"/>
						<input type="submit" value="Add OS"/>
					</form>
				</div>
			</div>
			<div class="tableSection">
				<div class="box">
					<h3><span class="red">Delete</span> an application</h3>
					<form id="deleteApplication" action="actions/deleteItemAction.php" method="post">
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
					<h3><span class="red">Delete</span> a printer</h3>
					<form id="deletePrinter" action="actions/deleteItemAction.php" method="post">
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
					<h3><span class="red">Delete</span> something to update</h3>
					<form id="deleteUpdate" action="actions/deleteItemAction.php" method="post">
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
					<h3><span class="red">Delete</span> a configuration step</h3>
					<form id="deleteConfiguration" action="actions/deleteItemAction.php" method="post">
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
					<h3><span class="red">Delete</span> hardware to give to users</h3>
					<form id="deleteHardware" action="actions/deleteItemAction.php" method="post">
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
					<h3><span class="red">Delete</span> an OS</h3>
					<form id="deleteOS" action="actions/deleteItemAction.php" method="post">
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
			</div>
			<?php include("templates/footer.php"); ?>
	</body>
</html>