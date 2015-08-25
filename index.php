<?php
	session_start();

	require("checkLoggedIn.php");
	require_once("classes/Table.php");

	$pageTitle = "Home";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<div class="portal blue">
				<h2>Welcome to the Vendome PC Rebuild Database <?=$_SESSION['username']?>!</h2>
			</div>
			<div class="box">
				<h2><a href="addComputer.php"><span class="green">Add</span> a new computer</a></h2>
				Click on this box to create a new rebuild form or to just enter a new machine into the database.
			</div>
			<div class="box">
				<h2><a href="addOrDeleteItems.php"><span class="green">Add</span> or <span class="red">delete</span> items from the database</a></h2>
				Click here to add or delete applications, printers, updates, configurations, hardware, and operating systems.
			</div>
			<div class="box">
				<h2><span class="blue">View</span> a computer</h2>
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
			<div class="box">
				<h2><a href="viewDatabase.php"><span class="blue">View</span> the database</a></h2>
				View and search the entire computer database, sorted by computer name.
			</div>
			<?php
				include 'footer.php';
			?>