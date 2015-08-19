<?php
session_start();
?>
<?php
if (!isset($_SESSION["username"])) {
	echo "	<script type='text/javascript'>
				alert('Please log in first.');
				window.location.assign(\"start.php\");
				</script>
				";
	exit;
	}
?>
<?php
include 'connection.php';
$username = $_POST["user"];
$remove_from_it = "DELETE FROM itteam WHERE username = '$username'";
$it = mysql_query($remove_from_it); 
$remove_from_user = "DELETE FROM users WHERE username = '$username'";
$user = mysql_query($remove_from_user); 

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=index.php">
    <title>PC Rebuild Portal - Remove user</title>
    <link href="rebuildform.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
    <script type="text/javascript" language="javascript" src="ajaxfunctions.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="portal">
<?php
    echo "<h1>User $username deleted.</h1>"; 		
?>
<h1>You will return to the main page in 3 seconds.</h1>
</div>

<?php
include 'footer.php';
mysql_close($connection) 
?>