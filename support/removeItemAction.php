<?php
	session_start();

	include '../checkLoggedIn.php';
	include '../connection.php';

	$pageTitle = "Removed {$_POST['item']}";
	
?>
<!doctype html>
<html>
	<head>
		<?php include '../head.php'; ?>
		<script>timer=setTimeout(function(){ window.location="../addOrRemoveItems.php";}, 1250)</script>
	</head>
	<body>
		<?php include '../header.php'; ?>
			<?php
				$item = mysql_real_escape_string($_POST['item']);
				$table = mysql_real_escape_string($_POST['table']);
				$field = mysql_real_escape_string($_POST['field']);

				mysql_query("DELETE FROM {$table} WHERE {$field} = '{$item}'");
				mysql_close($connection);
			?>
			<div class="portal red">
				<h2>Succsessfuly deleted <?=$_POST['item']?>!</h2>
			</div>
			<?php
				include '../footer.php';
			?>