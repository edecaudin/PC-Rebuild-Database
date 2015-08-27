<!-- Begin Header -->
		<div id="content">
			<img id="logo" src="../../rebuild/resources/logo.png" alt="Vendome Group LLC">
			<nav class="gray">
				<?=(isset($_SESSION["username"]) ? "<strong id=\"leftLinks\"><a href=\"../../rebuild/index.php\">Home</a></strong>" : "")?>
				<?=(isset ($navContent) ? "\n\t\t\t\t".$navContent : "\n")?>
			</nav>
			<!-- End Header -->
			<!-- Begin Page -->
