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
/*
This file creates a table depending on what has been selected on index.php to sort the database.
Diese Datei erstellt eine Tabelle abhängig davon was auf index.php zum Sortieren der Datenbank angegeben wurde.
*/
include 'connection.php';
$sort = $_POST['sort'];
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PC Rebuild Portal</title>
    <link href="rebuildform.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
    <script type="text/javascript" language="javascript" src="ajaxfunctions.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="portal">
<?php echo "<h1>All computers containing $sort</h1>"; ?>
</div>

<?php
if ($sort != "none") {
			echo "<table>";
			$query = "SELECT * FROM computer WHERE os LIKE '{$sort}%' OR rebuilder LIKE '$sort' OR
			hostname LIKE '{$sort}%' OR status LIKE '$sort' ORDER BY dop DESC";
			$result = mysql_query($query);
			while ($row = mysql_fetch_object($result)) {
				echo "<tr class='highlight'><td class='tobedone'>$row->hostname</td><td>bought on $row->dop</td>
				<td colspan='2'>$row->model $row->cpu $row->ram $row->hdd</td></tr>";
				echo "<tr class='highlight'><td>$row->os</td><td>Service Tag: $row->servicetag</td><td>Status: $row->status</td>
				<td>built by $row->rebuilder on $row->date</td></tr>";
				echo "<tr class='blackrow'><td class='blackrow' colspan='4'></td></tr>";
				}
			echo "</table>"; 
		} else {
			echo "Nothing selected.";
			}
?>
<div class="box" id="descriptive_box_add" onclick='backToIndex()'>
	<h1><= Back to the Main Page</h1>
</div>
<a href="sort_csv.php?sort=<?=$sort?>">
<div class="box" id="descriptive_box_add">
		<h1><= CSV for Excel:</h1>
    	<p>Click here to download a CSV file with these computers.</p>
	</div>   
</a>
<?php
include 'footer.php';
mysql_close($connection) 
?>