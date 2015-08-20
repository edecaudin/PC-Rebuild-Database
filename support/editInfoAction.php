<?php
	session_start();

	include '../checkLoggedIn.php';
	include '../array_report.php';

	$computerName = str_replace(' ','', $_POST['computerName']) ;
	$pageTitle = "Edited {$computerName}";
	
?>
<!doctype html>
<html>
	<head>
		<?php include '../head.php'; ?>
	</head>
	<body>
		<?php include '../header.php'; ?>
			<?php
				include "mysqlConnect.php";
				mysqli_query($mysqlConnection, "UPDATE computer SET
				hostname = '{$computerName}',
				os = '{$_POST['operatingsystem']}',
				employee = '{$_POST['employee']}',
				exemployee = '{$_POST['exemployee']}',
				rebuilder = '{$_POST['rebuilder']}',
				password = '{$_POST['password']}',
				ram = '{$_POST['ram']}',
				hdd = '{$_POST['hdd']}',
				opt  = '{$_POST['opt']}',
				power = '{$_POST['power']}',
				maclan = '{$_POST['maclan']}',
				macwifi = '{$_POST['macwifi']}',
				oskey = '{$_POST['oskey']}',
				silverpop = '{$_POST['silverpop']}',
				efax = '{$_POST['efax']}',
				broadview = '{$_POST['broadview']}',
				cell = '{$_POST['cell']}',
				notes = '{$_POST['notes']}',
				cpu = '{$_POST['cpu']}',
				model = '{$_POST['model']}',
				servicetag = '{$_POST['servicetag']}',
				escode = '{$_POST['escode']}',
				date = '{$_POST['date']}',
				dop = '{$_POST['dop']}'
				WHERE computerid = {$_POST['computerid']}");
				mysqli_close($mysqlConnection);

				header("Location: ../viewComputer.php?computerName={$computerName}");

				include '../footer.php';
			?>