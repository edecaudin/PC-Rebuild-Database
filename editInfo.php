<?php
	session_start();

	require("checkLoggedIn.php");
	require_once("classes/Table.php");
	require_once("classes/Row.php");
	
	$computer = new Row(new Table("computer"), $_GET["computerName"]);
	if (!$computer->doesExist()) {
		echo "<script type=\"text/javascript\">
			alert(\"{$_GET["computerName"]} does not exist!\");
			window.history.back();
		</script>";
		exit;
	}

	$pageTitle = "Editing {$computer["computer_name"]}";
	$headerContent = "<strong id='rightLinks'>
		<a href='viewComputer.php?computerName={$computer["computer_name"]}' class='navLink'>Back</a> to {$computer["computer_name"]} - 
		<a href='javascript:document.forms[\"editInfo\"].submit()' class='navLink, green'>Save</a> Info
	</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include "head.php"; ?>
	</head>
	<body>
		<?php include "header.php"; ?>
			<form name="editInfo" action="support/editInfoAction.php" method="post">
				<div class="portal blue" id="viewComputer">
					<h1 id="printComputerName">Editing <input type="text" name="computerName" value="<?=$computer["computer_name"]?>" maxlength="15"></h1>
					<h2 id="printOS">Service Tag: <input type="text" name="servicetag" value="<?=$computer["servicetag"]?>"> -
						<select name="operatingsystem">
							<?php
								$table = new Table("operating_system");
								$table->echoRowsAsOptions($table->runQuery(), $computer["os"]);
							?>
						</select>
					</h2>
				</div>
				<table style="clear: left;">
						<tr>
							<td>Employee:</td>
							<td><input type="text" name="employee" value="<?=$computer["employee"]?>"/></td>
							<td>Ex-Employee:</td>
							<td><input type="text" name="exemployee" value="<?=$computer["exemployee"]?>"/></td>
						</tr>
						<tr>
							<td>Rebuilder:</td>
							<td>
								<select name="rebuilder">
									<?php
										$table = new Table("rebuilder");
										$table->echoRowsAsOptions($table->runQuery(), $computer["rebuilder"]);
									?>
								</select>  
							</td>
							<td>Password:</td>
							<td><input type="text" name="password" value="<?=$computer["password"]?>"/></td>
						</tr>
						<tr>
							<td>Model:</td>
							<td><input type="text" name="model" value="<?=$computer["model"]?>"/></td>
							<td>CPU:</td>
							<td><input type="text" name="cpu" value="<?=$computer["cpu"]?>"/></td>
						</tr>
						<tr>
							<td>RAM:</td>
							<td><input type="text" name="ram" value="<?=$computer["ram"]?>"/></td>
							<td>HDD:</td>
							<td><input type="text" name="hdd" value="<?=$computer["hdd"]?>"/></td>
						</tr>
						<tr>
							<td>Optical Drive:</td>
							<td><input type="text" name="opt" value="<?=$computer["opt"]?>"/></td>
							<td>Battery:</td>
							<td><input type="text" name="power" value="<?=$computer["power"]?>"/></td>
						</tr>
						<tr>
							<td>OS License Key:</td>
							<td><input type="text" name="oskey" value="<?=$computer["oskey"]?>"/></td>
							<td>Express Service Code:</td>
							<td><input type="text" name="escode" value="<?=$computer["escode"]?>"/></td>
						</tr>
						<tr>
							<td>MAC-Address LAN:</td>
							<td><input type="text" name="maclan" value="<?=$computer["maclan"]?>"/></td>
							<td>MAC-Address WAN:</td>
							<td><input type="text" name="macwifi" value="<?=$computer["macwifi"]?>"/></td>
						</tr>
						<tr>
							<td>Rebuild Date:</td>
							<td><input type="text" name="date" value="<?=$computer["date"]?>"/></td>
							<td>Date of Purchase:</td>
							<td><input type="text" name="dop" value="<?=$computer["dop"]?>"/></td>
						</tr>
						<tr>
							<td>Cell Phone Number:</td>
							<td><input type="text" name="cell" value="<?=$computer["cell"]?>"/></td>
							<td>Broadview Number:</td>
							<td><input type="text" name="broadview" value="<?=$computer["broadview"]?>"/></td>
						</tr>
						<tr>
							<td>Silverpop Account:</td>
							<td><input type="text" name="silverpop" value="<?=$computer["silverpop"]?>"/></td>
							<td>EFax Account:</td>
							<td><input type="text" name="efax" value="<?=$computer["efax"]?>"/></td>
						</tr>
						<tr>
							<td>Notes:</td>
							<td colspan="3"><textarea name="notes"><?=$computer["notes"]?></textarea></td>
						</tr>
						<input type="hidden" name="computer_id" value="<?=$computer["computer_id"]?>"/>
				</table>
			</form>
	<?php
		include 'footer.php';
	?>