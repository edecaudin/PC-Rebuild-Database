<?php
	require("checkLoggedInAction.php");
	require_once("../mysql/Table.php");

	$item = $_POST["item"];
	$pageTitle = "Deleted {$_POST["tableName"]} {$_POST["item"]}";
?>
<!doctype html>
<html>
	<head>
		<?php include("../templates/head.php"); ?>
		<script>
			timer=setTimeout(function() {
				window.location="<?=$_POST["tableName"] === "computer" ? "../index.php" : "../addOrDeleteItems.php"?>";
			}, 1250);
		</script>
	</head>
	<body>
		<?php include("../templates/header.php"); ?>
			<?php
				$table = new Table($_POST["tableName"]);
				$table->deleteItem($item);
			?>
			<div class="portal red">
				<h2>Succsessfuly deleted <?=$_POST["tableName"]." ".$item?>!</h2>
			</div>
			<?php include("../templates/footer.php"); ?>
	</body>
</html>