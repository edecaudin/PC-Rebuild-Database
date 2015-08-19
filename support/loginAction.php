<?php
	session_start();

	include '../connection.php';

	$username = $_POST["username"];
	$log=0;

	$getUser = mysql_fetch_object(mysql_query("SELECT username, password FROM users WHERE username LIKE '$username' LIMIT 1"));
	
	if ($getUser->password == md5($_POST["password"])) {
		$_SESSION["username"] = $username;	
		header('Location: ../index.php');
	} else {
		echo "<script type='text/javascript'>
				alert('The username or password you entered were incorrect!');
				window.location.assign(\"../login.php\");
			</script>";
	}
?>