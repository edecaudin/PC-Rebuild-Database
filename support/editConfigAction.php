<?php
	session_start();

    include "../checkLoggedIn.php";
	
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
				function updateConfig($changes, $field, $computerName) {
					if (!isset($changes)) {
						$changes = array();
						$changes[0] = "";
					}
					include "mysqlConnect.php";
					mysqli_query($mysqlConnection, "UPDATE computer SET $field = '".mysql_real_escape_string(implode(" - ", $changes))."' WHERE hostname = '$computerName'");
					mysqli_close($mysqlConnection);
				}
				updateConfig($_POST["software"], "programs", $computerName);
				updateConfig($_POST["config"], "config", $computerName);
				updateConfig($_POST["hardware"], "addhw", $computerName);
				updateConfig($_POST["updates"], "updates", $computerName);
				updateConfig($_POST["printers"], "printers", $computerName);

				header("Location: ../viewComputer.php?computerName={$computerName}");
				
				include "../footer.php";
			?>