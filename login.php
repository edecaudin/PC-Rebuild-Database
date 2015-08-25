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
					<h2><label for="username">Username: </label><input name="username" type="text"/></h2>
					<h2><label for="password">Password: </label><input name="password" type="password"/></h2>
				</form>
			</div>
			<?php include("templates/footer.php"); ?>
	</body>
</html>