<?php
	session_start();

	if (isset($_SESSION["username"])) {
		header("Location: ../index.php");
	}

	$username = $_POST["username"];
	include "mysqlConnect.php";
	$getUser = mysqli_fetch_object(mysqli_query($mysqlConnection, "SELECT username, password FROM users WHERE username LIKE '$username' LIMIT 1"));
	mysqli_close($mysqlConnection);
	
	if ($getUser->password === md5($_POST["password"])) {
		$_SESSION["username"] = $username;	
		header('Location: ../index.php');
	} else {
		session_destroy();

		echo "<script type='text/javascript'>
				alert('The username or password you entered were incorrect!');
				window.location.assign(\"../login.php\");
			</script>";
	}
?>