<?php
	session_start();

    include '../checkLoggedIn.php';
    include '../pc_stuff_lookup.php';
	include '../array_report.php';

	$computerName = $_POST['computerName'];
	$pageTitle = "Created {$computerName}";
?>
<!doctype html>
<html>
	<head>
		<?php include '../head.php'; ?>
		<script>timer=setTimeout(function(){ window.location="../viewComputer.php?computerName=<?=$computerName?>";}, 1500)</script>
	</head>
	<body>
		<?php include '../header.php'; ?>
			<?php
				include "mysqlConnect.php";
				$hostresult = mysqli_query($mysqlConnection, "SELECT hostname FROM computer");
				if ($computerName == "") {
					echo "<script type='text/javascript'>
						alert('Computer name is empty!');
						window.history.back();
					</script>";
					exit;
				}
				while ($hostget = mysqli_fetch_row($hostresult)) {
					if ($hostget[0] == $computerName) {
						echo "<script type='text/javascript'>
							alert('$computerName already exists!');
							window.history.back();
						</script>";
						exit;
					}
				}
				mysqli_query($mysqlConnection, "INSERT INTO computer (Hostname) VALUES ('$computerName')");
				mysqli_close($mysqlConnection);
			?>
			<div class="portal green">
				<h2>Succsessfuly created <?=$computerName?>!</h2>
			</div>
			<?php include '../footer.php'; ?>