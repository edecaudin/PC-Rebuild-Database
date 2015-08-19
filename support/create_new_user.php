<?php
	session_start();

	if (!isset($_SESSION["username"])) {	
		echo "<script type='text/javascript'>
				alert('Please log in first.');
				window.location.assign(\"start.php\");
			</script>";

		exit;
	}
	
	include 'connection.php';

	$username = $_POST["username"];
	$fullname = $_POST["fullname"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];

	if (($password == $password2) && ($username != '')) {
		$duplicateuser = "SELECT username FROM users";
		$result = mysql_query($duplicateuser);
		$userarray = array();
		
		while ($get = mysql_fetch_row($result)) {
			$userarray[] = $get[0]; 
		}
		
		$password = md5($password);
		
		if (in_array($username,$userarray)) {
			echo "	<script type='text/javascript'>
					alert('$username does already exist. Please go back and change it.');
					window.history.back();
					</script>
					";
			} else {
				$new_user = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
				$entry_user = mysql_query($new_user);
				$new_it = "INSERT INTO itteam (Rebuilder, username) VALUES ('$fullname', '$username')";
				$entry_it = mysql_query($new_it);
				}
		} else {
			echo "	<script type='text/javascript'>
					alert('The passwords you have entered are not identical or there was no username assigned.');
					window.history.back();
					</script>
					";
			}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=index.php">
    <title>PC Rebuild Portal - Add new user</title>
    <link href="rebuildform.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
    <script type="text/javascript" language="javascript" src="ajaxfunctions.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="portal">
<?php
    echo "<h1>New user $username created.</h1>"; 		
?>
<h1>You will return to the main page in 3 seconds.</h1>
</div>

<?php
include 'footer.php';
mysql_close($connection) 
?>