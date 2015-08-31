<?php
	require("actions/checkLoggedInAction.php");
	require_once("mysql/Table.php");

	$computer = new Row(new Table("computer"), $_GET["computerName"]);
	if (!$computer->doesExist()) {
		echo("<script>
			alert(\"{$_GET["computerName"]} does not exist!\");
			history.back();
		</script>");
		exit();
	}

	$pageTitle = $computer["computer_name"];
?>
<!doctype html>
<html>
	<head>
		<?php include("templates/head.php"); ?>
		<script>
			$(function() {
				$("#deleteButton").click(function(event) {
					event.preventDefault();
					if (confirm("Are you sure you want to delete \"" + <?="\"".$computer["computer_name"]."\""?> + "\"?")) {
						$.post("actions/deleteItemAction.php", {item: <?="\"".$computer["computer_name"]."\""?>, tableName: "computer"}, function(data) {
							alert(data.message);
							location.assign("index.php");
						}, "json");
					}
				});
				$("label").click(function(event) {
					$(".fieldValue").show();
					$(".fieldInput").hide();
					$("#" + $(this).attr("for") + "Value").hide();
					$("#" + $(this).attr("for") + "Input").show();
				});
				$("span.fieldValue").click(function(event) {
					$(".fieldValue").show();
					$(".fieldInput").hide();
					$(this).hide();
					$("#" + $(this).attr("id").replace("Value", "Input")).show();
				});
				function submit(element) {
					$.post("actions/editInfoAction.php", element.serialize()+"&computer_id=<?=$computer["computer_id"]?>", function(data) {
						location.assign("viewComputer.php?computerName=" + $("#computer_nameInput").val());
					});
				}
				$(".fieldInput").change(function(event) {
					submit($(this));
				});
				$("select.fieldInput").focusout(function(event) {
					if (typeof $(this).attr("value") == "undefined") {
						submit($(this));
					}
				});
				$(".fieldInput").hide();
			});
		</script>
	</head>
	<body>
		<?php include("templates/header.php"); ?>
		<span id="customNav">
			<a href="editConfig.php?computerName=<?=$computer["computer_name"]?>" class="navLink green">Edit</a> Config -
			<a id="deleteButton" class="navLink red" href="#">Delete</a> <?=$computer["computer_name"]?>
		</span>
		<main>
			<header id="viewComputer" class="hero blue">
				<h3>
					<label id="computer_nameValue" class="fieldValue" for="computer_name"><?=$computer["computer_name"]?></label>
					<input id="computer_nameInput" class="fieldInput" name="computer_name" type="text" value="<?=$computer["computer_name"]?>" maxlength="15"/> -

					<label for="service_tag">Service Tag:</label>
					<span id="service_tagValue" class="fieldValue"><?=$computer["service_tag"]?></span>
					<input id="service_tagInput" class="fieldInput" name="service_tag" type="text" value="<?=$computer["service_tag"]?>"/> -

					<label for="operating_system">OS:</label>
					<span id="operating_systemValue" class="fieldValue"><?=$computer["operating_system"]?></span>
					<select id="operating_systemInput" class="fieldInput" name="operating_system">
						<?php
							$table = new Table("operating_system");
							$table->echoRowsAsOptions($table->runQuery(), $computer["operating_system"]);
							echo("\n");
						?>
					</select>
				</h3>
			</header>
			<section>
				<?php
				function echoRow($label1, $fieldName1, $attr1, $label2, $fieldName2, $attr2) {
					global $computer;
					echo("<div class=\"tableRow\">");
					for ($i = 0; $i < 2; $i++) {
						$label = $i == 0 ? $label1 : $label2;
						$fieldName = $i == 0 ? $fieldName1 : $fieldName2;
						$attr = $i == 0 ? $attr1 : $attr2;
						echo("
					<div class=\"tableCell quarterWidth\"><label for=\"{$fieldName}\">{$label}:</label></div>
					<div class=\"tableCell quarterWidth\">
						<span id=\"{$fieldName}Value\" class=\"fieldValue\">{$computer[$fieldName]}</span>
						");
						if ($fieldName === "rebuilder") {
							echo("<select id=\"{$fieldName}Input\" class=\"fieldInput\" name=\"{$fieldName}\">");
							$table = new Table("rebuilder");
							$table->echoRowsAsOptions($table->runQuery(), $computer["rebuilder"]);
							echo("</select>");
						} else {
							echo("<input".(is_null($attr) ? "" : " ".$attr)." id=\"{$fieldName}Input\" class=\"fieldInput\" name=\"{$fieldName}\" type=\"text\" value=\"{$computer[$fieldName]}\"/>");
						}
						echo("
				</div>");
					}
					echo("
			</div>
			");
				}
					echoRow("Employee", "employee", null, "Ex-Employee", "ex_employee", null);
					echoRow("Rebuilder", "rebuilder", null, "Password", "password", null);
					echoRow("Model", "model", null, "CPU", "cpu", null);
					echoRow("RAM", "ram", null, "Storage", "storage", null);
					echoRow("Optical Drive", "optical_drive", null, "Battery", "battery", null);
					echoRow("OS License Key", "license_key", "maxlength=\"29\"", "Express Service Code", "express_service_code", null);
					echoRow("MAC Address (LAN)", "mac_lan", "maxlength=\"17\"", "MAC Address (WLAN)", "mac_wifi", "maxlength=\"17\"");
					echoRow("Rebuild Date", "rebuild_date", "type=\"date\"", "Purcase Date", "purchase_date", "type=\"date\"");
					echoRow("Cell Phone Number", "cell_number", null, "Broadview Number", "broadview_number", null);
				?>
				<div class="tableRow">
					<div class="tableCell quarterWidth"><label for="notes">Notes:</label></div>
					<div class="tableCell halfWidth">
						<span id="notesValue" class="fieldValue"><?=$computer["notes"]?></span>
						<textarea id="notesInput" class="fieldInput" name="notes"><?=$computer["notes"]?></textarea>
					</div>
				</div>
			</section>
			<section>
				<?php
					function echoSection($title, $fieldName) {
						global $computer;
						echo("<section class=\"halfWidth\">
					<header class=\"tableRow gray\"><h3>{$title}</h3></header>
					");
					echoInstalledItems($fieldName);
					echo("		</section>
				");
					}
					function echoInstalledItems($fieldName) {
						global $computer;
						if ($computer[$fieldName] === "") {
							echo("<div class=\"tableRow\">
									Nothing to do here!
								</div>");
						} else {
							$items = explode(" - ", $computer[$fieldName]);
							foreach ($items as $item) {
								echo("<div class=\"tableRow\">
										<input type=\"checkbox\"/>{$item}
									</div>");
							}
						}
					}
					echoSection("Applications", "application_list");
					echoSection("Updates", "update_list");
					echoSection("Configuration Steps", "config_list");
					echoSection("Printers", "printer_list");
					echoSection("Hardware", "hardware_list");
				?>
			</section>
		</main>
		<?php include("templates/footer.php"); ?>
	</body>
</html>