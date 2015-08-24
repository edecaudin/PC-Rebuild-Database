<?php
	session_start();

	include "../checkLoggedIn.php";

	include "../classes/Computer.php";
	$computer = new Computer(intval($_POST["computerid"]));

	$pageTitle = "Edited {$computer["hostname"]}";
	
?>
<!doctype html>
<html>
	<head>
		<?php include "../head.php"; ?>
	</head>
	<body>
		<?php include "../header.php"; ?>
			<?php
				$computer["hostname"] = $_POST["computerName"];
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

				header("Location: ../viewComputer.php?computerName={$computer["hostname"]}");

				include "../footer.php";
			?>