<?php
	session_start();

	include 'checkLoggedIn.php';
	include 'connection.php';
	include 'pc_stuff_lookup.php';
	
	$pageTitle = "Database";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
		<script src='../../rebuild/resources/search.js'></script>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<div class="portal blue">
				<h2 id="searchDatabase">Search the database: <input type="text" onKeyUp="searchFor(this.value);"></h2>
				<h2>Filter the database:
					<form id="sortform" action="support/getDatabaseFilterCSVAction.php" method="get">
						<select name="sort" id="sort" onChange="document.forms['sortform'].submit();">
							<option name='none' value='none'>Select from here</option>
							<optgroup id="operating_systems" label="Operating Systems">
								<option name='Windows'>Windows</option>
								<option name='Mac OSX'>Mac OS X</option>
								<?php
									stuff_lookup(os_select, operating_systems);
								?>
							</optgroup>
							<optgroup id="itteam" label="Rebuilder">
								<?php
									stuff_lookup(Rebuilder, itteam);
								?>	
							</optgroup>
						</select>
					</form>
				</h2>
			</div>
			<h2 id="downloadCSV"><a href="support/getDatabaseCSVAction.php"><span class="blue">Download</span> a .csv version of the database</a></h2>
			<div id="searchResults"></div>
			<div id="databaseTable">
				<?php include 'support/getDatabaseAction.php'; ?>
			</div>
		<?php
			mysql_close($connection);
			include 'footer.php';
		?>