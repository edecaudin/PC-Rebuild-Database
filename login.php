<?php
	session_start();

	if (isset($_SESSION["username"])) {
		header("Location: index.php");
	}

	$pageTitle = "Login";
	$headerContent = "<strong id=\"rightLinks\"><a href=\"javascript:document.forms['login'].submit();\" class=\"navLink, green\">Login</a></strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<div class="portal blue">
				<form id="login" action="actions/loginAction.php" method="post">
					<h3><label for="username">Username: </label><input name="username" type="text"/></h3>
					<h3><label for="password">Password: </label><input name="password" type="password"/></h3>
				</form>
			</div>
			<?php include("templates/footer.php"); ?>
	</body>
</html>