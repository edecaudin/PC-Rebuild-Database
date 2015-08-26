<?php
	require("actions/checkLoggedInAction.php");
	
	$pageTitle = "Add Computer";
	$headerContent = "<strong id=\"rightLinks\"><a href=\"javascript:document.forms['addComputer'].submit()\" class=\"navLink green\">Add</a> Computer</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<div class="portal blue">
				<form id="addComputer" action="actions/addItemAction.php" method="post">
					<h3><label for="item">Computer Name: </label><input type="text" name="item"/></h3>
					<input type="hidden" name="tableName" value="computer"/>
				</form>
			</div>
			<?php include("templates/footer.php"); ?>
	</body>
</html>