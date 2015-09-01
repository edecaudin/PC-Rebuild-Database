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
							$("header.hero").addClass("green");
							html = $("header.hero h3").html();
							$("header.hero h3").html(data.message);
							setTimeout(function() {
								$("header.hero").removeClass("green");
								$("header.hero h3").html(html);
								location.reload();
							}, 1000);
						}, "json");
					}
				});
				$(".deleteButton").click(function(event) {
					event.preventDefault();
					if (confirm("Are you sure you want to delete \"" + $(this).siblings(".deleteSelect").val() + "\"?")) {
						$.post("actions/deleteItemAction.php", $(this).parent("form").serialize(), function(data) {
							$("header.hero").addClass("green");
							html = $("header.hero h3").html();
							$("header.hero h3").html(data.message);
							setTimeout(function() {
								$("header.hero").removeClass("green");
								$("header.hero h3").html(html);
								location.reload();
							}, 1000);
						}, "json");
					}
				});
			});
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
			<main>
				<header class="hero blue">
					<h3>Add or Delete Items</h3>
				</header>
				<section>
					<?php
						function echoAddOrDeleteBox($tableName, $title, $buttonText) {
							?><div class="tableRow">
							<div class="tableCell halfWidth">
								<h3><span class="green">Add</span> <?=$title?></h3>
								<form>
									<input id="item" name="item" type="text"/>
									<button class="addButton">Add <?=$buttonText?></button>
									<input type="hidden" name="tableName" value="<?=$tableName?>"/>
								</form>
							</div>
							<div class="tableCell halfWidth">
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
							</div>
						</div><?php
						}
					?>
					<?php
						echoAddOrDeleteBox("application", "an application", "Application");
						echo("\n\t\t\t\t");
						echoAddOrDeleteBox("printer", "a printer", "Printer");
						echo("\n\t\t\t\t");
						echoAddOrDeleteBox("update", "something to update", "Update");
						echo("\n\t\t\t\t");
						echoAddOrDeleteBox("config", "a configuration step", "Configuration");
						echo("\n\t\t\t\t");
						echoAddOrDeleteBox("hardware", "hardware to give to users", "Hardware");
						echo("\n\t\t\t\t");
						echoAddOrDeleteBox("operating_system", "an OS", "OS");
						echo("\n");
					?>
				</section>
			</main>
			<?php include("templates/footer.php"); ?>
	</body>
</html>