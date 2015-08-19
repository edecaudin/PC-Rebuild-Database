<?php
	$pageTitle = "Login";
	$headerContent = "<span id='rightLinks'>
					<a href='javascript:document.forms[\"login\"].submit();' class='navLink, green'>Login</a>
				</span>";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<div class="portal blue">
				<form id='login' action='support/loginAction.php' method='post'>
					<h2><label for='username'>Username: </label><input name='username' type='text'></h2>
					<h2><label for='password'>Password: </label><input name='password' type='password'></h2>
				</form>
			</div>
			<?php include 'footer.php'; ?>