<?php
	session_start();

    include "../checkLoggedIn.php";
    include "../pc_stuff_lookup.php";
	
	$computerName = $_POST["computerName"];
	$pageTitle = "Edited {$computerName}";
?>
<!doctype html>
<html>
	<head>
		<?php include "../head.php"; ?>
	</head>
	<body>
		<?php include "../header.php"; ?>
			<?php
				updateConfig($_POST["software"], "programs", $computerName);
				updateConfig($_POST["config"], "config", $computerName);
				updateConfig($_POST["hardware"], "addhw", $computerName);
				updateConfig($_POST["updates"], "updates", $computerName);
				updateConfig($_POST["printers"], "printers", $computerName);

				header("Location: ../viewComputer.php?computerName={$computerName}");

				include "../footer.php";
			?>