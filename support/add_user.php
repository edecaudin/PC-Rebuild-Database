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
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PC Rebuild Portal - Add new user</title>
    <link href="rebuildform.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
    <script type="text/javascript" language="javascript" src="ajaxfunctions.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="portal">
<?php
    echo "<h1>Create a new user here.</h1>"; 		
?>
</div>
<table>
    <form action="create_new_user.php" method="post" name="new_user">
        <tr>
            <td>Username (20 characters max):</td>
            <td><input type="text" maxlength="20" name="username"></td>
            <td>Password:</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>Full Name:</td>
            <td><input type="text" name="fullname"></td>
            <td>Password again:</td>
            <td><input type="password" name="password2"></td>
        </tr>
    </form>
</table>
 <div class="box" id="descriptive_box_add" onClick='document.forms["new_user"].submit()'>
		<h1><= Create User</h1>
    	<p>This will create the new user and they will be able to login with their new credentials.</p>
	</div>
    <div class="box" id="descriptive_box_rem" onclick='backToIndex()'>
        <h1>[X] Return to the Main Page</h1>
        <p>This will discard your changes.</p>
    </div>
<?php
include 'footer.php';
mysql_close($connection) 
?>