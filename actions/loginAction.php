<?php
	session_start();

	require_once("../mysql/Table.php");

	if (isset($_SESSION["username"])) {
		header("Location: ../index.php");
	} else if (isset($_POST["username"]) && isset($_POST["password"])) {
		$user = new Row(new Table("user"), $_POST["username"]);
		if (!is_null($user) && $user["password"] === md5($_POST["password"])) {
			$_SESSION["username"] = $user["user_name"];	
			header("Location: ../index.php");
			exit();
		}
	}
	session_destroy();
	echo("<script type=\"text/javascript\">
			alert(\"The username or password you entered were incorrect!\");
			window.location.assign(\"../login.php\");
		</script>");
?>