<?php
	session_start();

    include '../checkLoggedIn.php';
    include '../connection.php';
    include '../pc_stuff_lookup.php';
	
	$computerName = $_POST['computerName'];
	$pageTitle = "Edited {$computerName}";
?>
<!doctype html>
<html>
	<head>
		<?php include '../head.php'; ?>
	</head>
	<body>
		<?php include '../header.php'; ?>
			<?php
				$id = $_POST['id'];
				saveChangesFromCheckbox($id,'programs','software',$_POST['software'],'programs');
				saveChangesFromCheckbox($id,'configuration','config',$_POST['config'],'config');
				saveChangesFromCheckbox($id,'additionalhardware','hardware',$_POST['hardware'],'addhw');
				saveChangesFromCheckbox($id,'update_software','updates',$_POST['updates'],'updates');
				saveChangesFromCheckbox($id,'device','printers',$_POST['printers'],'printers');
				mysql_close($connection);
				
				header("Location: ../viewComputer.php?computerName={$computerName}");

				include '../footer.php';
			?>