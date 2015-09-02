<?php
	require("actions/checkLoggedInAction.php");
	
	$pageTitle = "Database";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			$(function() {
				$("#searchField").keyup(function(event) {
					$("#databaseTable").load("actions/getDatabaseAction.php", $(this).serializeArray());
				});
				$("#searchField").keyup();
			});
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
		<main>
			<header class="hero blue">
				<h3>Search the database: <input id="searchField" name="search" type="text"/></h3>
			</header>
			<section id="databaseTable"></section>
		</main>
		<?php include("templates/footer.php"); ?>
	</body>
</html>