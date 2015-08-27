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
	<body onLoad="searchFor();">
		<?php include("templates/header.php"); ?>
			<hgroup class="blue">
				<h3>Search the database: <input id="searchField" name="search" type="text"/></h3>
			</hgroup>
			<div id="databaseTable"></div>
			<?php include("templates/footer.php"); ?>
	</body>
</html>