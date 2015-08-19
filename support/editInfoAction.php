<?php
	session_start();

	include '../checkLoggedIn.php';
	include '../connection.php';
	include '../pc_stuff_lookup.php';
	include '../array_report.php';

	$computerName = str_replace(' ','',$_POST['computerName']) ;
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
				mysql_query("UPDATE computer SET
				hostname = '{$computerName}',
				os = '{$_POST['operatingsystem']}',
				bit = '{$_POST['bit']}',
				employee = '{$_POST['employee']}',
				exemployee = '{$_POST['exemployee']}',
				rebuilder = '{$_POST['rebuilder']}',
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
				status = '{$_POST['status']}',
				cpu = '{$_POST['cpu']}',
				model = '{$_POST['model']}',
				servicetag = '{$_POST['servicetag']}',
				escode = '{$_POST['escode']}',
				date = '{$_POST['date']}',
				dop = '{$_POST['dop']}'
				WHERE computerid = {$_POST['id']}");
				mysql_close($connection);

				header("Location: ../viewComputer.php?computerName={$computerName}");

				include '../footer.php';
			?>