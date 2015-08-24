<div id='content'>
			<img src='../../rebuild/resources/logo.png' class="noPrint" id='logo'>
			<div class='header noPrint'>
				<?=(isset($_SESSION["username"]) ? "<strong id='leftLinks'><a href='../../rebuild/index.php' class='navLink'>Home</a></strong>" : "")?>
				<?=(isset ($headerContent) ? "
".$headerContent : "")?>

			</div>
