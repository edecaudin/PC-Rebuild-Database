<?php
	session_start();

	require("checkLoggedIn.php");
	
	$pageTitle = "Database";
?>
<!doctype html>
<html>
	<head>
		<?php include "head.php"; ?>
		<script>
			function searchFor(search) {
				try {
					var XMLHttp = new XMLHttpRequest();
					XMLHttp.open("post", "support/getDatabaseAction.php", true);
					XMLHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					XMLHttp.send("search=" + (typeof search == "undefined" ? "" : search));
					XMLHttp.onreadystatechange = function() {
						if (XMLHttp.readyState == 4) {
							document.getElementById("databaseTable").innerHTML = XMLHttp.responseText;
						}
					};
				} catch (e) {
					alert(e);
				}
			}
		</script>
	</head>
	<body onLoad="searchFor();">
		<?php include "header.php"; ?>
			<div class="portal blue">
				<h2>Search the database: <input type="text" onKeyUp="searchFor(this.value);"></h2>
			</div>
			<div id="databaseTable" ></div>
			<?php
				include "footer.php";
			?>