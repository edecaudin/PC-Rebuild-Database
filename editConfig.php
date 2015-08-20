<?php
	session_start();

	include "checkLoggedIn.php";
	include "pc_stuff_lookup.php";
	
	$computerName = $_GET["computerName"];	
	$pageTitle = "Editing {$computerName}";
	$headerContent = "<span id='rightLinks'>
		<a href='viewComputer.php?computerName={$computerName}' class='navLink'>Back</a> to {$computerName} - 
		<a href='javascript:document.forms[\"editConfig\"].submit()' class='navLink, green'>Save</a> Config
	</span>";
?>
<!doctype html>
<html>
	<head>
		<?php include "head.php"; ?>
	</head>
	<body>
		<?php include "header.php"; ?>
			<div class="portal blue">
				<h2>Editing <?=$computerName?></h2>
			</div>
			<form name="editConfig" action="support/editConfigAction.php" method="post">
				<?php
					echo "<div class='edit_me_3_inst'>Applications:</div>";
					installedStuffLookup($computerName, "programs", "software", "programs");
					echo "<div class='edit_me_3_inst'>Configuration:</div>";
					installedStuffLookup($computerName, "configuration", "config", "config");
					echo "<div class='edit_me_3_inst'>Additional Hardware:</div>";
					installedStuffLookup($computerName, "additionalhardware", "hardware", "addhw");
					echo "<div class='edit_me_3_inst'>Updates:</div>";
					installedStuffLookup($computerName, "update_software", "updates", "updates");
					echo "<div class='edit_me_3_inst'>Printers:</div>";
					installedStuffLookup($computerName, "device", "printers", "printers");
				?> 
				<input type="hidden" name="computerName" value="<?=$computerName?>"/>
			</form>
			<?php
				include "footer.php";
			?>