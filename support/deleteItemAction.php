<?php
	session_start();

	require("../checkLoggedIn.php");

	require_once("../classes/Table.php");

	$item = $_POST["item"];
	$pageTitle = "Deleted {$_POST["tableName"]} {$_POST["item"]}";
?>
<!doctype html>
<html>
	<head>
		<?php include "../head.php"; ?>
		<script>
			timer=setTimeout(function() {
				window.location="../addOrRemoveItems.php";
			}, 1250);
		</script>
	</head>
	<body>
		<?php include "../header.php"; ?>
			<?php
				$table = new Table($_POST["tableName"]);
				$table->deleteItem($item);
			?>
			<div class="portal red">
				<h2>Succsessfuly deleted <?=$_POST["tableName"]." ".$item?>!</h2>
			</div>
			<?php
				include "../footer.php";
			?>