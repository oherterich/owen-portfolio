<!DOCTYPE HTML>
<html>
	<head>
		<title>Owen Herterich</title>

		<link href="../../css/projects.css" type="text/css" rel="stylesheet">
		<link href="../../css/tablet.css" type="text/css" rel="stylesheet">
		<link href="../../css/mobile.css" type="text/css" rel="stylesheet">
		<link rel='icon' href='../../img/icons/favicon.png' type='image/png'>

		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<div id="content">
			<?php
				require_once('../../php/nav.php');
			?>
			<section id="project">
				<h1>Space Jam</h1>
				<h3>Fall 2013 | Javascript</h3>
				<p><a href="http://isharethereforeiam.com/spacejam">Visit the website!</a></p>
				<p>Amazingly enough, the original Space Jam movie website from 1996 is still up and running on the <a href="http://www2.warnerbros.com/spacejam/movie/jam.htm">web</a>. I wanted to recreate this classic site, but with a modern twist. I decided to use Mr.doob's three.js Javascript framework to recreate the site in 3D.</p>
				<p>While the links themselves aren't active, the user is free to navigate around three-dimensional space with the mouse. Different models and textures were created for the different assets, and two particle systems were implemented to make the stars. The result is a fun reimagining of the old Space Jam website.</p>
				<img src="spacejam01.jpg" class="documentation">
				<img src="spacejam02.jpg" class="documentation">
				<img src="spacejam03.jpg" class="documentation">
				<img src="spacejam04.jpg" class="documentation">
			</section>
		</div>

		<script src="js/main.js"></script>
	</body>
</html>