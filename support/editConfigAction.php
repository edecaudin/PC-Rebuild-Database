<?php
	session_start();

 	require("../checkLoggedIn.php");

	require_once("../classes/Table.php");
	require_once("../classes/Row.php");
	$computer = new Row(new Table("computer"), intval($_POST["computer_id"]));

	$pageTitle = "Edited {$computer["computer_name"]}";
?>
<!doctype html>
<html>
	<head>
		<?php include "../head.php"; ?>
	</head>
	<body>
		<?php include "../header.php"; ?>
			<?php
				function updateConfig($changes, $fieldName) {
					global $computer;
					$computer[$fieldName] = implode(" - ", $changes);
				}
				updateConfig($_POST["application"], "programs");
				updateConfig($_POST["config"], "config");
				updateConfig($_POST["hardware"], "addhw");
				updateConfig($_POST["update"], "updates");
				updateConfig($_POST["printer"], "printers");

				header("Location: ../viewComputer.php?computerName={$computer["computer_name"]}");

				include "../footer.php";
			?>