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
				$computer["computer_name"] = $_POST["computerName"];
				$computer["os"] = $_POST["operatingsystem"];
				$computer["employee"] = $_POST["employee"];
				$computer["exemployee"] = $_POST["exemployee"];
				$computer["rebuilder"] = $_POST["rebuilder"];
				$computer["password"] = $_POST["password"];
				$computer["ram"] = $_POST["ram"];
				$computer["hdd"] = $_POST["hdd"];
				$computer["opt"]  = $_POST["opt"];
				$computer["power"] = $_POST["power"];
				$computer["maclan"] = $_POST["maclan"];
				$computer["macwifi"] = $_POST["macwifi"];
				$computer["oskey"] = $_POST["oskey"];
				$computer["silverpop"] = $_POST["silverpop"];
				$computer["efax"] = $_POST["efax"];
				$computer["broadview"] = $_POST["broadview"];
				$computer["cell"] = $_POST["cell"];
				$computer["notes"] = $_POST["notes"];
				$computer["cpu"] = $_POST["cpu"];
				$computer["model"] = $_POST["model"];
				$computer["servicetag"] = $_POST["servicetag"];
				$computer["escode"] = $_POST["escode"];
				$computer["date"] = $_POST["date"];
				$computer["dop"] = $_POST["dop"];

				header("Location: ../viewComputer.php?computerName={$computer["computer_name"]}");

				include "../footer.php";
			?>