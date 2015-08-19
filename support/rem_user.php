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
    <title>PC Rebuild Portal - Remove user</title>
    <link href="rebuildform.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
    <script type="text/javascript" language="javascript" src="ajaxfunctions.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="portal">
<?php
    echo "<h1>Remove a user here.</h1>"; 		
?>
</div>
<table>
    <form action="remove_user.php" method="post" name="rem_user">
    
        <tr>
            <td>
            <select name="user">
			<?php
            $query = "SELECT username FROM users ORDER BY username ASC";
			$result = mysql_query($query);
			while ($get = mysql_fetch_row($result)) {
				echo "<option name='$get[0]' value='$get[0]'>$get[0]</option>";
				}
            ?>
        	</select>
    		</td>
        </tr>
    </form>
</table>
 <div class="box" id="descriptive_box_rem" onClick='document.forms["rem_user"].submit()'>
		<h1>[X] Remove selected User</h1>
    	<p>This will remove the user from the database completely.</p>
	</div>
    <div class="box" id="descriptive_box_rem" onclick='backToIndex()'>
        <h1>[X] Return to the Main Page</h1>
        <p>This will discard your changes.</p>
    </div>
<?php
include 'footer.php';
mysql_close($connection);
?>