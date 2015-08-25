<?php
	session_start();

    require("../checkLoggedIn.php");

	require_once("../classes/Table.php");

	$computerName = $_GET["computerName"];
    $pageTitle = "Deleted {$computerName}";
?>
<!doctype html>
<html>
	<head>
		<?php include "../head.php"; ?>
		<script>
			timer=setTimeout(function() {
				window.location="../index.php";
			}, 1500);
		</script>
	</head>
	<body>
		<?php include "../header.php"; ?>
			<?php
				$table = new Table("computer");
				$table->deleteItem($computerName);
			?>
			<div class="portal red">
				<h2>Succsessfuly deleted <?=$computerName?>!</h2>
			</div>
			<?php
				include "../footer.php";
			?>