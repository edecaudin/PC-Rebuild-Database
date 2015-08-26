<?php
	require("checkLoggedInAction.php");
	require_once("../mysql/Table.php");

	$computer = new Row(new Table("computer"), intval($_POST["computer_id"]));

	$computer["computer_name"] = $_POST["computer_name"];
	$computer["operating_system"] = $_POST["operating_system"];
	$computer["service_tag"] = $_POST["service_tag"];
	$computer["employee"] = $_POST["employee"];
	$computer["ex_employee"] = $_POST["ex_employee"];
	$computer["rebuilder"] = $_POST["rebuilder"];
	$computer["password"] = $_POST["password"];
	$computer["model"] = $_POST["model"];
	$computer["cpu"] = $_POST["cpu"];
	$computer["ram"] = $_POST["ram"];
	$computer["storage"] = $_POST["storage"];
	$computer["optical_drive"]  = $_POST["optical_drive"];
	$computer["battery"] = $_POST["battery"];
	$computer["license_key"] = $_POST["license_key"];
	$computer["express_service_code"] = $_POST["express_service_code"];
	$computer["mac_lan"] = $_POST["mac_lan"];
	$computer["mac_wifi"] = $_POST["mac_wifi"];
	$computer["rebuild_date"] = $_POST["rebuild_date"];
	$computer["purchase_date"] = $_POST["purchase_date"];
	$computer["cell_number"] = $_POST["cell_number"];
	$computer["broadview_number"] = $_POST["broadview_number"];
	$computer["notes"] = $_POST["notes"];

	header("Location: ../viewComputer.php?computerName={$computer["computer_name"]}");
?>