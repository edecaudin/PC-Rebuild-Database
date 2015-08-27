<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		echo("<script>
				alert(\"You have to log in first!\");
				location.replace(\"../../rebuild/login.php\");
			</script>");
		exit();
	}
?>