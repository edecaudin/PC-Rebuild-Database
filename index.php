<?php
	require("actions/checkLoggedInAction.php");
	require_once("mysql/Table.php");

	$pageTitle = "Home";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<hgroup class="blue">
				<h3>Welcome to the Vendome PC Rebuild Database <?=$_SESSION["username"]?>!</h3>
			</hgroup>
			<div class="tableRow">
				<h3><a href="addComputer.php"><span class="green">Add</span> a new computer</a></h3>
				Click on this box to create a new rebuild form or to just enter a new machine into the database.
			</div>
			<div class="tableRow">
				<h3><a href="addOrDeleteItems.php"><span class="green">Add</span> or <span class="red">delete</span> items from the database</a></h3>
				Click here to add or delete applications, printers, updates, configurations, hardware, and operating systems.
			</div>
			<div class="tableRow">
				<h3><span class="blue">View</span> a computer</h3>
				<form action="viewComputer.php" method="get">
					Edit and create a printable report of any computer:
					<select name="computerName">
						<?php
							$table = new Table("computer");
							$table->echoRowsAsOptions($table->runQuery());
						?>
					</select> 
					<input type="submit" value="Get Report"/>
				</form>
			</div>
			<div class="tableRow">
				<h3><a href="viewDatabase.php"><span class="blue">View</span> the database</a></h3>
				View and search the entire computer database, sorted by computer name.
			</div>
			<?php include("templates/footer.php"); ?>
	</body>
</html>