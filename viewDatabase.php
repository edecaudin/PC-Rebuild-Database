<?php
	session_start();

	require("checkLoggedIn.php");
	
	$pageTitle = "Database";
?>
<!doctype html>
<html>
	<head>
		<?php include 'head.php'; ?>
		<script>
			function searchFor(searchterm) {
				if (searchterm.trim() == "") {
					document.getElementById("searchResults").innerHTML = "";
					document.getElementById("databaseTable").style.display = "block";
					return;
				}
				try {
					var XMLHttp = new XMLHttpRequest();
			
					XMLHttp.open("post", "support/getDatabaseAction.php", true);
					XMLHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					XMLHttp.send("search=" + searchterm);
					
					XMLHttp.onreadystatechange = function() {
						if (XMLHttp.readyState == 4) {
							document.getElementById("searchResults").innerHTML = XMLHttp.responseText;
							if (XMLHttp.responseText != "") {
								document.getElementById("databaseTable").style.display = "none";
							} else {
								document.getElementById("databaseTable").style.display = "block";
							}
						}
					};
					
				} catch (e) {
					alert(e);
				}
			}
		</script>
	</head>
	<body>
		<?php include 'header.php'; ?>
			<div class="portal blue">
				<h2>Search the database: <input type="text" onKeyUp="searchFor(this.value);"></h2>
			</div>
			<div id="databaseTable">
				<h2 id="downloadCSV"><a href="support/getDatabaseCSVAction.php"><span class="blue">Download</span> a .csv version of the database</a></h2>
				<?php
					include 'support/getDatabaseAction.php';
				?>
			</div>
			<div id="searchResults"></div>
			<?php
				include 'footer.php';
			?>