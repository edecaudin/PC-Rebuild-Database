<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		echo("<script type=\"text/javascript\">
				alert(\"You have to log in first!\");
				window.location.assign(\"../../rebuild/login.php\");
			</script>");
		exit();
	}
?>