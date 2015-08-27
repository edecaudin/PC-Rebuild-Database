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
		<main>
			<div class="hero blue">
				<h3>Welcome to the Vendome PC Rebuild Database <?=$_SESSION["username"]?>!</h3>
			</div>
			<h3><a href="addComputer.php"><span class="green">Add</span> a new computer</a></h3>
			Click on this box to create a new rebuild form or to just enter a new machine into the database.
			<h3><a href="addOrDeleteItems.php"><span class="green">Add</span> or <span class="red">delete</span> items from the database</a></h3>
			Click here to add or delete applications, printers, updates, configurations, hardware, and operating systems.
			<h3><span class="blue">View</span> a computer</h3>
			<form action="viewComputer.php" method="get">
				Edit and create a printable report of any computer:
				<select name="computerName">
					<?php
						$table = new Table("computer");
						$table->echoRowsAsOptions($table->runQuery());
						echo "\n";
					?>
				</select> 
				<input type="submit" value="Get Report"/>
			</form>
			<h3><a href="viewDatabase.php"><span class="blue">View</span> the database</a></h3>
			View and search the entire computer database, sorted by computer name.
		</main>
		<?php include("templates/footer.php"); ?>
	</body>
</html>