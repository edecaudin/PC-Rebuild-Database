<?php
	session_start();

	if (isset($_SESSION["username"])) {
		header("Location: index.php");
	}

	$pageTitle = "Login";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			$(function() {
				$("#login").submit(function(event) {
					if ($("#username").val() === "") {
						alert("Username is empty!");
						event.preventDefault();
					} else if ($("#password").val() === "") {
						alert("Password is empty!");
						event.preventDefault();
					}
				});
				$("#loginButton").click(function(event) {
					event.preventDefault();
					$("#login").submit();
				});
			});
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
		<span id="customNav"><a id="loginButton" class="green" href="#">Login</a></span>
		<main>
			<div class="hero blue">
				<form id="login" action="actions/loginAction.php" method="post">
					<h3><label for="username">Username: </label><input id="username" name="username" type="text"/></h3>
					<h3><label for="password">Password: </label><input id="password" name="password" type="password"/></h3>
				</form>
			</div>
		</main>
		<?php include("templates/footer.php"); ?>
	</body>
</html>