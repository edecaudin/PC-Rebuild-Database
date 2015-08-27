<?php
	require("actions/checkLoggedInAction.php");
	
	$pageTitle = "Add Computer";
	$headerContent = "<strong id=\"rightLinks\"><a id=\"submitButton\" class=\"green\" href=\"#\">Add</a> Computer</strong>";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			$(function() {
				$("#submitButton").click(function(event) {
					event.preventDefault();
					if ($("#item").val() === "") {
						alert("Name is empty!");
					} else {
						$('#addComputer').submit();
					}
				});
			});
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<hgroup class="blue">
				<form id="addComputer" action="actions/addItemAction.php" method="post">
					<h3><label for="item">Computer Name: </label><input id="item" type="text" name="item"/></h3>
					<input type="hidden" name="tableName" value="computer"/>
				</form>
			</hgroup>
			<?php include("templates/footer.php"); ?>
	</body>
</html>