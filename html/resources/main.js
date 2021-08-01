function hideChildren(element) {
	// Hide all sidebar-entry1 divs
	var listentry1 = element.getElementsByClassName("sidebar-entry1");
	
	for (let i = 0; i < listentry1.length; i++) {
		listentry1[i].style.display = "none";
	}
	
	// Hide any sidebar-entry2 divs
	var listentry2 = element.getElementsByClassName("sidebar-entry2");
	
	for (let i = 0; i < listentry2.length; i++) {
		listentry2[i].style.display = "none";
	}
	
	// Revert any sidebar-expand elements back to the + state
	var listexpand = element.getElementsByClassName("sidebar-expand");
	
	for (let i = 0; i < listexpand.length; i++) {
		listexpand[i].innerHTML = "<img src = 'resources/img/plusbutton.png' class = 'sidebar-img'>";
	}
	
	// In case a child page is open, change the page back to home
	document.getElementById("home").click();
	
}

function showChildren(element) {
	// Show all sidebar-entry1 divs
	var listentry1 = element.getElementsByClassName("sidebar-entry1");
	
	for (let i = 0; i < listentry1.length; i++) {
		if (listentry1[i].parentElement == element) {
			listentry1[i].style.display = "block";
		}
	}
	
	// Show any sidebar-entry2 divs
	var listentry2 = element.getElementsByClassName("sidebar-entry2");
	
	for (let i = 0; i < listentry2.length; i++) {
		if (listentry2[i].parentElement == element) {
			listentry2[i].style.display = "block";
		}
	}
}

function initExpandButtons() {
	var expandbuttons = document.getElementsByClassName("sidebar-expand");
	
	for (let i = 0; i < expandbuttons.length; i++) {
		expandbuttons[i].onclick = function () {
			if (expandbuttons[i].innerHTML == "<img src=\"resources/img/plusbutton.png\" class=\"sidebar-img\">") {
				expandbuttons[i].innerHTML = "<img src = 'resources/img/minusbutton.png' class = 'sidebar-img'>";
				showChildren(expandbuttons[i].parentElement);
			} else {
				expandbuttons[i].innerHTML = "<img src = 'resources/img/plusbutton.png' class = 'sidebar-img'>";				
				hideChildren(expandbuttons[i].parentElement);
			}
			
			return false;
		}
	}
}

function initSidebarButtons(cursidebar) {
	// Since the embed tag is what is getting modified by these buttons, we need to store its element here
	var embed = document.getElementsByTagName("embed")[0];
	// Set onclick events for all sidebar-button classes
	var sidebarbuttons = document.getElementsByClassName("sidebar-button");
	
	for (let i = 0; i < sidebarbuttons.length; i++) {
		sidebarbuttons[i].onclick = function() {
			embed.setAttribute("src", "resources/pages/" + sidebarbuttons[i].id + ".html");
			// Change background color of button so the user knows it is selected
			cursidebar.item.style.backgroundColor = "white";
			sidebarbuttons[i].style.backgroundColor = "#C0C0C0";
			cursidebar.item = sidebarbuttons[i];
		}
	}
	// Set onclick events for all sidebar-button-doc classes
	var docbuttons = document.getElementsByClassName("sidebar-button-doc");
	
	for (let i = 0; i < docbuttons.length; i++) {
		docbuttons[i].onclick = function() {
			// In order to get the correct pathway, some unfortunately long single lines of code are necessary.
			var folderdiv = docbuttons[i].parentElement.parentElement;
			var filename = docbuttons[i].getElementsByClassName("name")[0].innerHTML;
			var foldername = folderdiv.getElementsByClassName("sidebar-button-folder")[0].getElementsByClassName("name")[0].innerHTML;
			var projectname = folderdiv.parentElement.getElementsByClassName("sidebar-button-project")[0].getElementsByClassName("name")[0].innerHTML;
			
			embed.setAttribute("src", "resources/pages/" + projectname + "/" + foldername + "/" + filename);
			// Change background color of button so the user knows it is selected
			cursidebar.item.style.backgroundColor = "white";
			docbuttons[i].style.backgroundColor = "#C0C0C0";
			cursidebar.item = docbuttons[i];
		}
	}
	
	// Set onclick events for all sidebar-button-img classes
	
	var imgbuttons = document.getElementsByClassName("sidebar-button-img");
	
	for (let i = 0; i < imgbuttons.length; i++) {
		imgbuttons[i].onclick = function() {
			// In order to get the correct pathway, some unfortunately long single lines of code are necessary.
			var filename = imgbuttons[i].getElementsByClassName("name")[0].innerHTML;
			embed.setAttribute("src", "img/" + filename);
			// Change background color of button so the user knows it is selected
			cursidebar.item.style.backgroundColor = "white";
			imgbuttons[i].style.backgroundColor = "#C0C0C0";
			cursidebar.item = imgbuttons[i];
		}
	}
}

window.onload = function() {
	var projectsdiv = document.getElementById("projects-div");
	var docsdiv = document.getElementById("documentation-div");
	var imagesdiv = document.getElementById("images-div");
	var cursidebar = {item: document.getElementById("home")};
	cursidebar.item.style.backgroundColor = "#C0C0C0";
	
	// The children of expandable sidebar options should be hidden by default on site loading
	hideChildren(projectsdiv);
	hideChildren(docsdiv);
	hideChildren(imagesdiv);
	
	// Initialize the onclick events for all expand buttons in the sidebar
	initExpandButtons();
	initSidebarButtons(cursidebar);
}