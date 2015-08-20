<?php
	session_start();

    include "../checkLoggedIn.php";

	$computerName = $_GET["computerName"];
    $pageTitle = "Deleted {$computerName}";
?>
<!doctype html>
<html>
	<head>
		<?php include "../head.php"; ?>
		<script>timer=setTimeout(function(){ window.location="../index.php";}, 1500)</script>
	</head>
	<body>
		<?php include "../header.php"; ?>
			<?php
				include "mysqlConnect.php";
				mysqli_query($mysqlConnection, "DELETE FROM computer WHERE hostname = '{$computerName}'");
				mysqli_close($mysqlConnection);
			?>
			<div class="portal red">
				<h2>Succsessfuly deleted <?=$computerName?>!</h2>
			</div>
			<?php include "../footer.php"; ?>