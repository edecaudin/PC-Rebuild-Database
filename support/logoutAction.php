<?php
    session_start();
    session_destroy();
    
    $pageTitle = "Logged Out";
?>
<!doctype html>
<html>
	<head>
		<?php include '../head.php' ?>
		<script>
			timer=setTimeout(function() {
				window.location="../login.php";
			}, 1500);
		</script>
	</head>
	<body>
		<?php include '../header.php' ?>
			<div class="portal blue">
				<h2>Logging out...</h2>
			</div>
		<?php include '../footer.php'; ?>