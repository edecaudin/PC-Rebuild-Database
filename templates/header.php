<!-- Begin Header -->
		<div id="content">
			<img src="../../rebuild/resources/logo.png" id="logo">
			<div class="header gray">
				<?=(isset($_SESSION["username"]) ? "<strong id=\"leftLinks\"><a href=\"../../rebuild/index.php\" class=\"navLink\">Home</a></strong>" : "")?>
				<?=(isset ($headerContent) ? "
				".$headerContent : "")?>

			</div>
			<!-- End Header -->
			<!-- Begin Page -->
