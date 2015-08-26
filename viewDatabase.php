<?php
	require("actions/checkLoggedInAction.php");
	
	$pageTitle = "Database";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			function searchFor(search) {
				try {
					var XMLHttp = new XMLHttpRequest();
					XMLHttp.open("post", "actions/getDatabaseAction.php", true);
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
		<?php include("templates/header.php"); ?>
			<div class="portal blue">
				<h3>Search the database: <input type="text" onKeyUp="searchFor(this.value);"/></h3>
			</div>
			<div id="databaseTable"></div>
			<?php include("templates/footer.php"); ?>
	</body>
</html>