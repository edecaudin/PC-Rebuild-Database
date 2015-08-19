<?php
	session_start();

	include 'checkLoggedIn.php';
	
	$pageTitle = "New Computer";
	$headerContent = "<span id='rightLinks'><a href='javascript:document.forms[\"newComputer\"].submit()' class='navLink green'>Create</a> Computer</span>";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<div class="portal blue">
				<form id="newComputer" action="support/newComputerAction.php" method="post">
					<h2><label for="computerName">Computer Name: </label><input type="text" name="computerName"></h2>
				</form>
			</div>
		<?php
			include 'footer.php';
		?>