<?php
	session_start();

	include "checkLoggedIn.php";
	include "pc_stuff_lookup.php";
	
	$computerName = $_GET["computerName"];
	$pageTitle = "Editing {$computerName}";
	$headerContent = "<strong id='rightLinks'>
		<a href='viewComputer.php?computerName={$computerName}' class='navLink'>Back</a> to {$computerName} - 
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
			<?php
				include "support/mysqlConnect.php";
				$list = mysqli_fetch_object(mysqli_query($mysqlConnection, "SELECT * FROM computer WHERE hostname = '{$computerName}' "));
				mysqli_close($mysqlConnection);
			?>
			<form name="editInfo" action="support/editInfoAction.php" method="post">
				<div class="portal blue" id="viewComputer">
					<h1 id="printComputerName">Editing <input type="text" name="computerName" value="<?=$list->hostname?>" maxlength="15"></h1>
					<h2 id="printOS">Service Tag: <input type="text" name="servicetag" value="<?=$list->servicetag?>"> -
						<select name="operatingsystem">
							<?php
								getTableItems(os_select, operating_systems, $list->os);
							?>
						</select>
					</h2>
				</div>
				<table style="clear: left;">
						<tr>
							<td>Employee:</td>
							<td><input type="text" name="employee" value="<?=$list->employee?>"></td>
							<td>Ex-Employee:</td>
							<td><input type="text" name="exemployee" value="<?=$list->exemployee?>"></td>
						</tr>
						<tr>
							<td>Rebuilder:</td>
							<td>
								<select name="rebuilder">
									<?php
										getTableItems("rebuilder", "itteam", $list->rebuilder);
									?>
								</select>  
							</td>
							<td>Password:</td>
							<td><input type="text" name="password" value="<?=$list->password?>"></td>
						</tr>
						<tr>
							<td>Model:</td>
							<td><input type="text" name="model" value="<?=$list->model?>"></td>
							<td>CPU:</td>
							<td><input type="text" name="cpu" value="<?=$list->cpu?>"></td>
						</tr>
						<tr>
							<td>RAM:</td>
							<td><input type="text" name="ram" value="<?=$list->ram?>"></td>
							<td>HDD:</td>
							<td><input type="text" name="hdd" value="<?=$list->hdd?>"></td>
						</tr>
						<tr>
							<td>Optical Drive:</td>
							<td><input type="text" name="opt" value="<?=$list->opt?>"></td>
							<td>Battery:</td>
							<td><input type="text" name="power" value="<?=$list->power?>"></td>
						</tr>
						<tr>
							<td>OS License Key:</td>
							<td><input type="text" name="oskey" value="<?=$list->oskey?>"></td>
							<td>Express Service Code:</td>
							<td><input type="text" name="escode" value="<?=$list->escode?>"></td>
						</tr>
						<tr>
							<td>MAC-Address LAN:</td>
							<td><input type="text" name="maclan" value="<?=$list->maclan?>"></td>
							<td>MAC-Address WAN:</td>
							<td><input type="text" name="macwifi" value="<?=$list->macwifi?>"></td>
						</tr>
						<tr>
							<td>Rebuild Date:</td>
							<td><input type="text" name="date" value="<?=$list->date?>"></td>
							<td>Date of Purchase:</td>
							<td><input type="text" name="dop" value="<?=$list->dop?>"></td>
						</tr>
						<tr>
							<td>Cell Phone Number:</td>
							<td><input type="text" name="cell" value="<?=$list->cell?>"></td>
							<td>Broadview Number:</td>
							<td><input type="text" name="broadview" value="<?=$list->broadview?>"></td>
						</tr>
						<tr>
							<td>Silverpop Account:</td>
							<td><input type="text" name="silverpop" value="<?=$list->silverpop?>"></td>
							<td>EFax Account:</td>
							<td><input type="text" name="efax" value="<?=$list->efax?>"></td>
						</tr>
						<tr>
							<td>Notes:</td>
							<td colspan="3"><textarea name="notes"><?=$list->notes?></textarea></td>
						</tr>
						<input type="hidden" name="computerid" value="<?=$list->computerid?>"/>
				</table>
			</form>
	<?php
		include 'footer.php';
	?>