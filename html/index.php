<!DOCTYPE html>

<?php
	// Populate each section with contents found on the server
	// Get list of project folders in resources/pages/
	$projectpath = "resources/pages";
	// Use array_diff to remove the .. and . hidden folders
	$pathcontents = array_diff(scandir($projectpath), array("..", "."));
	// Create empty array of project directories in folder
	$projectlist = array();
	
	foreach($pathcontents as $name) {
		// If item in folder is another folder, it is a project
		if (is_dir($projectpath . '/' . $name) == true) {
			array_push($projectlist, $name);
		}
	}
	
	// Get list of images to add to the images section
	$imagepath = "img";
	$imageslist = array_diff(scandir($imagepath), array("..", "."));
?>

<html>
	<head>
		<meta charset = 'utf-8'/>
		<link rel = 'stylesheet' href = 'resources/style.css'>
		<link rel = 'icon' href = 'resources/favicon.ico'>
		<script src = 'resources/main.js'></script>
		<title>loweh.moe</title>
	</head>
	
	<body>
		<!-- these center setup divs are ugly and i hate them but they're necessary to center the "window" vertically-->
		<div id = 'center-setup1'>
    		<div id = 'center-setup2'>
				<div id = 'outer-box'>
        			<div id = 'title-box'>
        				<span><b>loweh.moe</b></span>
                        <button id = 'exit-button' onclick = 'alert("do not");'><b>X</b></button>
            		</div>
            		<div id = 'content-box'>
            			<div id = 'sidebar-box'>
							<!-- home tab -->						
                        	<div>
                            	<a class = 'sidebar-button' id = 'home'><img src = 'resources/img/home.png' class = 'sidebar-img'>  <span>loweh.moe</span></a>
                            </div>
							
							<!-- about tab -->
							
                            <div class = 'sidebar-entry1'>
                            	<a class = 'sidebar-button' id = 'about'><img src = 'resources/img/about.png' class = 'sidebar-img'>  <span>about</span></a>
                            </div>
							
							<!-- projects tab -->
							
                            <div id = 'projects-div'>
								<a class = 'sidebar-expand' id = 'expand-projects'><img src = 'resources/img/plusbutton.png' class = 'sidebar-img'></a>
                            	<a href = 'http://github.com/loweh/' target = '_blank'><img src = 'resources/img/projects.png' class = 'sidebar-img'>  <span>projects</span></a>
								
								<!-- projects list (the rest of this section is put in through PHP so i'm sorry that it's ugly) -->
								
								<?php
									foreach ($projectlist as $name) {
										// While not as efficient, echoing each div is separated into parts for readability and easy modification
										echo "<div class = 'sidebar-entry2'>";
										echo "<a href = 'http://github.com/loweh/" . $name . "' target = '_blank'>";
										echo "<img src = 'resources/img/project.png' class = 'sidebar-img'>";
										echo "  <span class = 'name'>" . $name . "</span></a></div>";
									}
								?>
                            </div>

							<!-- documentation tab -->
							
                            <div id = 'documentation-div'>
								<a class = 'sidebar-expand' id = 'expand-docs'><img src = 'resources/img/plusbutton.png' class = 'sidebar-img'></a>
                            	<a class = 'sidebar-button' id = 'documentation'><img src = 'resources/img/documentation.png' class = 'sidebar-img'>  <span>documentation</span></a>
								
								<!-- projects list (in documentation) (the rest of this section is put in through PHP so i'm sorry that it's ugly) -->
								
								<?php
									foreach ($projectlist as $name) {
										echo "<div class = 'sidebar-entry1'>";
										echo "<a class = 'sidebar-expand'>";
										echo "<img src = 'resources/img/plusbutton.png' class = 'sidebar-img'></a>";
										echo "<a class = 'sidebar-button-project'>";
										echo "<img src = 'resources/img/projectdoc.png' class = 'sidebar-img'>";
										echo "  <span class = 'name'>" . $name . "</span></a>";
										
										$folderpath = $projectpath . '/' . $name;		
										$folderlist = array_diff(scandir($folderpath), array("..", "."));
										
										foreach ($folderlist as $foldername) {
											echo "<div class = 'sidebar-entry1'>";
											echo "<a class = 'sidebar-expand'>";
											echo "<img src = 'resources/img/plusbutton.png' class = 'sidebar-img'></a>";
											echo "<a class = 'sidebar-button-folder'>";
											echo "<img src = 'resources/img/folder.png' class = 'sidebar-img'>";
											echo "<span class = 'name'>" . $foldername . "</span></a>";
											
											$docpath = $folderpath . '/' . $foldername;
											$doclist = array_diff(scandir($docpath), array("..", "."));
											
											foreach ($doclist as $docname) {
												echo "<div class = 'sidebar-entry2'>";
												echo "<a class = 'sidebar-button-doc'>";
												echo "<img src = 'resources/img/document.png' class = 'sidebar-img'>";
												echo "<span class = 'name'>" . $docname . "</span></a></div>";
												
											}
											
											echo "</div>";
										}
										
										echo "</div>";
									}
								?>
                            </div>
							
							<!-- image tab -->
							
							<div id = 'images-div'>
								<a class = 'sidebar-expand' id = 'expand-images'><img src = 'resources/img/plusbutton.png' class = 'sidebar-img'></a>
                            	<a class = 'sidebar-button' id = 'images'><img src = 'resources/img/images.png' class = 'sidebar-img'>  <span>images</span></a>
								
								<!-- image list -->
								
								<?php
									foreach ($imageslist as $filename) {
										echo "<div class = 'sidebar-entry2'>";
										echo "<a class = 'sidebar-button-img'>";
										echo "<img src = 'resources/img/image.png' class = 'sidebar-img'>";
										echo "  <span class = 'name'>" . $filename . "</span></a></div>";
									}
								?>
                            </div>
							
							<!-- contact tab -->
							
                            <div class = 'sidebar-entry1'>
                            	<a class = 'sidebar-button' id = 'contact'><img src = 'resources/img/contact.png' class = 'sidebar-img'>  <span>contact</span></a>
                            </div>
            			</div>
                        <div id = 'text-box'>
							<embed type = 'text/html' src = 'resources/pages/home.html' width = '100%' height = '100%'>
            			</div>
                    </div>
        		</div>
        	</div>
		</div>
	</body>
</html>