<?php
	session_start();

	include 'checkLoggedIn.php';
	
	$pageTitle = "Add Computer";
	$headerContent = "<strong id='rightLinks'><a href='javascript:document.forms[\"addComputer\"].submit()' class='navLink green'>Add</a> Computer</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<div class="portal blue">
				<form id="addComputer" action="support/addItemAction.php" method="post">
					<h2><label for="item">Computer Name: </label><input type="text" name="item"/></h2>
					<input type="hidden" name="tableName" value="computer"/>
				</form>
			</div>
		<?php
			include 'footer.php';
		?>