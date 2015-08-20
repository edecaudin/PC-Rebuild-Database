function searchFor(searchterm) {
	if (searchterm.trim() == "") {
		document.getElementById("searchResults").innerHTML = "";
		document.getElementById("databaseTable").style.display = "block";
		return;
	}
	try {
		var XMLHttp = new XMLHttpRequest();

		XMLHttp.open("post", "support/getDatabaseSearchAction.php", true);
		XMLHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		XMLHttp.send("searchterm=" + searchterm);
		
		XMLHttp.onreadystatechange = function() {
			if (XMLHttp.readyState == 4) {
				document.getElementById("searchResults").innerHTML = XMLHttp.responseText;
				if (XMLHttp.responseText != "") {
					document.getElementById("databaseTable").style.display = "none";
				} else {
					document.getElementById("databaseTable").style.display = "block";
				}
			}
		};
		
	} catch (e) {
		alert(e);
	}
}