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
				<h1>New World Symphony + Parsons</h1>
				<h3>Fall 2013 | openFrameworks</h3>
				<p>In fall 2013, I participated in a collaboration between Parsons The New School for Design and the New World Symphony, based in Miami. The purpose of the collaboration was to create a visual component to a series of musical pieces using biometric and sound data. The performance took place on November 10, 2013, at the New World Center in Miami.</p>
				<p>The way we chose to interact with the performers was through physical motion by using accelerometers, and Fast Fourier Transform (FFT) code to translate pitch, attack, and other aural qualities of the music into visual output, or programmatically manipulatable variables. As for the physical motion, we felt it would be advantageous to connect accelerometers directly to the musicians wrists. This would allow a noise free, one-to-one connection to the movement of the violin bow, yielding orientation and movement data in 3 axes. This data was brought into openFrameworks, where the visuals were created.</p>
				<img src="nws01.jpg" class="documentation">
				<img src="nws02.jpg" class="documentation">
				<img src="nws03.jpg" class="documentation">
				<img src="nws04.jpg" class="documentation">
				<img src="nws05.jpg" class="documentation">
				<img src="nws06.jpg" class="documentation">
			</section>
		</div>

		<script src="js/main.js"></script>
	</body>
</html>