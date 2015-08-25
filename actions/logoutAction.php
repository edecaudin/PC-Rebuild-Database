<?php
	require("checkLoggedInAction.php");
	session_destroy();
	header("Location: ../login.php");
?>