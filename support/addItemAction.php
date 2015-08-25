<?php
	session_start();

	require("../checkLoggedIn.php");

	require_once("../classes/Table.php");

	$item = $_POST["item"];
	$pageTitle = "Added {$_POST["tableName"]} {$item}";
?>
<!doctype html>
<html>
	<head>
		<?php include "../head.php"; ?>
		<script>
			timer=setTimeout(function() {
				window.location="<?=$_POST["tableName"] === "computer" ? "../viewComputer.php?computerName={$item}" : "../addOrRemoveItems.php"?>";
			}, 1250);
		</script>
	</head>
	<body>
		<?php include "../header.php"; ?>
			<?php
				if ($item === "") {
					echo "<script type=\"text/javascript\">
						alert(\"Name is empty!\");
						window.history.back();
					</script>";
					exit;
				}
				$table = new Table($_POST["tableName"]);
				if ($table->doesContain($item)) {
					echo "<script type=\"text/javascript\">
						alert(\"$item already exists!\");
						window.history.back();
					</script>";
					exit;
				}
				$table->addItem($item);
			?>
			<div class="portal green">
				<h2>Succsessfuly added <?=$_POST["tableName"]." ".$item?>!</h2>
			</div>
			<?php
				include "../footer.php";
			?>