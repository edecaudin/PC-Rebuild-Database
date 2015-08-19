<div id='content'>
			<img src='../../rebuild/resources/logo.png' id='logo'>
			<div class='header noPrint'>
				<?=(isset($_SESSION["username"]) ? "<span id='leftLinks'><a href='../../rebuild/index.php' class='navLink'>Home</a></span>" : "")?>
				<?=(isset ($headerContent) ? "
".$headerContent : "")?>

			</div>
