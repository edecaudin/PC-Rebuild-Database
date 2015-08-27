<?php
	require("actions/checkLoggedInAction.php");
	require_once("mysql/Table.php");

	$pageTitle = "Add or Delete Items";
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			$(function() {
				$(".addButton").click(function(event) {
					event.preventDefault();
					if ($(this).siblings("input#item").val() === "") {
						alert("Name is empty!");
					} else {
						$.post("actions/addItemAction.php", $(this).parent("form").serialize(), function(data) {
							alert(data.message);
							location.reload();
						}, "json");
					}
				});
				$(".deleteButton").click(function(event) {
					event.preventDefault();
					if (confirm("Are you sure you want to delete \"" + $(this).siblings(".deleteSelect").val() + "\"?")) {
						$.post("actions/deleteItemAction.php", $(this).parent("form").serialize(), function(data) {
							alert(data.message);
							location.reload();
						}, "json");
					}
				});
			});
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<main>
				<div class="hero blue">
					<h3>Add or Delete Items</h3>
				</div>
				<?php
					function echoAddBox($tableName, $title, $buttonText) {
						?><div class="tableRow">
						<h3><span class="green">Add</span> <?=$title?></h3>
						<form>
							<input id="item" name="item" type="text"/>
							<button class="addButton">Add <?=$buttonText?></button>
							<input type="hidden" name="tableName" value="<?=$tableName?>"/>
						</form>
					</div><?php
					}
					function echoDeleteBox($tableName, $title, $buttonText) {
						?><div class="tableRow">
						<h3><span class="red">Delete</span> <?=$title?></h3>
						<form>
							<select class="deleteSelect" name="item">
								<?php  
									$table = new Table($tableName);
									$table->echoRowsAsOptions($table->runQuery());
									echo("\n");
								?>
							</select>
							<button class="deleteButton">Delete <?=$buttonText?></button>
							<input name="tableName" type="hidden" value="<?=$tableName?>"/>
						</form>
					</div><?php
					}
				?>
				<div class="tableSection">
					<?php
						echoAddBox("application", "an application", "Application");
						echo("\n\t\t\t\t");
						echoAddBox("printer", "a printer", "Printer");
						echo("\n\t\t\t\t");
						echoAddBox("update", "something to update", "Update");
						echo("\n\t\t\t\t");
						echoAddBox("config", "a configuration step", "Configuration");
						echo("\n\t\t\t\t");
						echoAddBox("hardware", "hardware to give to users", "Hardware");
						echo("\n\t\t\t\t");
						echoAddBox("operating_system", "an OS", "OS");
						echo("\n");
					?>
				</div>
				<div class="tableSection">
					<?php
						echoDeleteBox("application", "an application", "Application");
						echo("\n\t\t\t\t");
						echoDeleteBox("printer", "a printer", "Printer");
						echo("\n\t\t\t\t");
						echoDeleteBox("update", "something to update", "Update");
						echo("\n\t\t\t\t");
						echoDeleteBox("config", "a configuration step", "Configuration");
						echo("\n\t\t\t\t");
						echoDeleteBox("hardware", "hardware to give to users", "Hardware");
						echo("\n\t\t\t\t");
						echoDeleteBox("operating_system", "an OS", "OS");
						echo("\n");
					?>
				</div>
			</main>
			<?php include("templates/footer.php"); ?>
	</body>
</html>