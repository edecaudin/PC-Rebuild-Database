<?php
	session_start();

	include 'checkLoggedIn.php';
	include 'connection.php';
	include 'pc_stuff_lookup.php';
	
	$computerName = $_GET['computerName'];
	$pageTitle = "Editing {$computerName}";
	$headerContent = "<span id='rightLinks'>
		<a href='viewComputer.php?computerName={$computerName}' class='navLink'>Back</a> to {$computerName} - 
		<a href='javascript:document.forms[\"editInfo\"].submit()' class='navLink, green'>Save</a> Info
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
			<table>
				<form name="editInfo" action="support/editInfoAction.php" method="post">
					<?php
						$list = mysql_fetch_object(mysql_query("SELECT * FROM computer WHERE hostname = '{$computerName}' "));
					?>
					<tr>
						<td>Hostname:</td>
						<td><input type="text" name="computerName" value="<?=$list->hostname?>" maxlength="15"></td>
						<td>OS:</td>
						<td>
							<select name="operatingsystem">
								<?php
									stuff_lookup(os_select, operating_systems, $list->os);
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Employee:</td>
						<td><input type='text' name='employee' value='<?=$list->employee?>'></td>
						<td>Ex-Employee:</td>
						<td><input type='text' name='exemployee' value='<?=$list->exemployee?>'></td>
					</tr>
					<tr>
						<td>RAM: <input type='text' name='ram' value='<?=$list->ram?>'> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HDD:</td>
						<td><input type='text' name='hdd' value='<?=$list->hdd?>'></td>
						<td>Optical Drive:</td>
						<td><input type='text' name='opt' value='<?=$list->opt?>'></td>
					</tr>
					<tr>
						<td>MAC-Address LAN:</td>
						<td><input type='text' name='maclan' value='<?=$list->maclan?>'></td>
						<td>MAC-Address WAN:</td>
						<td><input type='text' name='macwifi' value='<?=$list->macwifi?>'></td>
					</tr>
					<tr>
						<td>Battery:</td>
						<td><input type='text' name='power' value='<?=$list->power?>'></td>
						<td>OS License Key:</td>
						<td><input type='text' name='oskey' value='<?=$list->oskey?>'></td>
					</tr>
					<!--<tr>
						<td>Silverpop Account:</td>
						<td><input type='text' name='silverpop' value='<?=$list->silverpop?>'></td>
						<td>EFax Account:</td>
						<td><input type='text' name='efax' value='<?=$list->efax?>'></td>
					</tr>-->
					<tr>
						<td>Cell Phone Number:</td>
						<td><input type='text' name='cell' value='<?=$list->cell?>'></td>
						<td>Broadview Number:</td>
						<td><input type='text' name='broadview' value='<?=$list->broadview?>'></td>
					</tr>
					<tr>
						<td>CPU:</td>
						<td><input type='text' name='cpu' value='<?=$list->cpu?>'></td>
					</tr>
					<tr>
						<td>Service Tag:</td>
						<td><input type='text' name='servicetag' value='<?=$list->servicetag?>'></td>
						<td>Express Service Code:</td>
						<td><input type='text' name='escode' value='<?=$list->escode?>'></td>
					</tr>
					<tr>
						<td>Model:</td>
						<td><input type='text' name='model' value='<?=$list->model?>'></td>
						<td>Date of Purchase:</td>
						<td><input type='text' name='dop' value='<?=$list->dop?>'></td>
					</tr>
					<tr>
						<td>Rebuilder:</td>
						<td>
							<select name='rebuilder'>
								<?php
									stuff_lookup('rebuilder', 'itteam', $list->rebuilder);
								?>
							</select>  
						</td>
						<td>Rebuild Date:</td>
						<td><input type='text' name='date' value='<?=$list->date?>'></td>
					</tr>
					<tr>
						<td>Notes:</td>
						<td colspan='3'><textarea name='notes'><?=$list->notes?></textarea></td>
					</tr>
					<input type='hidden' name='id' value='<?=$list->computerid?>'>
				</form>
			</table>
	<?php
		mysql_close($connection);
		include 'footer.php';
	?>