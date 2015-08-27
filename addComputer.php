<?php
	require("actions/checkLoggedInAction.php");
	
	$pageTitle = "Add Computer";
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
			<span id="customNav"><a id="submitButton" class="green" href="#">Add</a> Computer</span>
			<main>
				<div class="hero blue">
					<form id="addComputer" action="actions/addItemAction.php" method="post">
						<h3><label for="item">Computer Name: </label><input id="item" type="text" name="item"/></h3>
						<input type="hidden" name="tableName" value="computer"/>
					</form>
				</div>
			</main>
			<?php include("templates/footer.php"); ?>
	</body>
</html>