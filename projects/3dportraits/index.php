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
				<h1>3D Portraits</h1>
				<h3>Spring 2014 | Kinect, Maya, Mudbox</h3>
				<p>For the <a href="http://mfadt.parsons.edu/2014/">MFA Design and Technology Thesis Show</a>, I worked with <a href="http://cargocollective.com/mechanicalhuman">Jorge Proa&ntilde;o</a> to create a series of 3D portraits for the thesis website.</p>
				<p>We wanted the portraits for our graduating class to be unique and memorable, so the technique of 3D scanning was chosen. The software <a href="http://skanect.occipital.com/">Skanect</a> was chosen for the scanning process. In order to get a full three-dimensional scan, a Kinect was used to capture all angles of the subject.</p>
				<p>The resulting mesh was imported into MeshLab, scaled, rotated, and broken into the correct geometry. A photographic portrait of the subject's face was then mapped onto the 3D geometry in Mudbox. Finally, the mesh was textured, lit, and rendered in Maya.</p>
				<p>Overall, over seventy students were scanned. The resulting geometry and textures were open-sourced and made available. They can be used for a wide-range of applications, including <a href="http://isharethereforeiam.com/thesisportrait_lights/">WebGL</a> and 3D printing. Find the files on <a href="https://github.com/mfadt/mfadt-3d-models-2014">GitHub</a>.</p>
				<p>Thanks to the 2014 MFADT Web Committee for the nifty 3D GIF.</p>
				<img src="3dportraits-1.jpg" class="theImage">
				<img src="3dportraits-01.jpg" class="documentation">
				<img src="3dportraits-02.jpg" class="documentation">
			</section>
		</div>

		<script src="../js/main.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
		var images = {};
		var names = $(".theImage");

		var spin = true;
		var metaSpin = true;
		var forward = false;
		var unwindingBacktoZero = false;
		var counter = 0;
		var spinRate = 100;
		var numberOfFrames = 48;
		var frameNumber = 0;

		// load up images for each person
	    var slug = "owen-herterich";
	    
	    images[slug] = [];
	    var url = "./3dportraits-";

	    for (var j = 1; j <= numberOfFrames; j++) {
	        var src = url + j + ".jpg";
	        images[slug].push(src);

	        // preload the image into a new img element
	        var elem = document.createElement('img')
	        elem.src = src;
	    }

		//move image when you hover over it
		$(".theImage").mousemove(function(e) { 
		    // var slug = $(this).attr('data-slug')

		    var offset = $(this).offset();
		    var xLocInImage = e.pageX - offset.left;

		    var interval = $(this).width() / numberOfFrames;
		    frameNumber = parseInt(xLocInImage / interval);  

		    for (var i = 0; i < names.length; i++) {
		        $(".theImage").attr("src", images["owen-herterich"][frameNumber]);
		    }
		});

		//dont let the image auto spin when you are hovering
		$(".theImage").hover(function(){
		    spin = !spin;
		});

		//unwind back to zero when you move off
		$(".theImage").mouseout(function(){
		    unwindingBacktoZero = true;

		});

		//unwind
		setInterval(function () {
		    if (unwindingBacktoZero && spin) {
		        frameNumber--;
		        if (frameNumber < 1)  { unwindingBacktoZero = false; }
		        
		        for (var i = 0; i < names.length; i++) {
		            var slug = $(names[i]).attr('data-slug');
		            $(".theImage").attr("src", images["owen-herterich"][frameNumber]);
		        }
		    }
		}, spinRate+20);

		//spin back and forth for ever
		setInterval(function () {
		    if (frameNumber < 1) { frameNumber = numberOfFrames - 1; }
		    else if (frameNumber > numberOfFrames - 2) { frameNumber = 0; }
		    if (spin && !unwindingBacktoZero && metaSpin) {
		        if (forward){
		            frameNumber++;
		        }
		        else{
		            frameNumber--;
		        }
		        for (var i = 0; i < names.length; i++) {
		            var slug = $(names[i]).attr('data-slug');
		            $(".theImage").attr("src", images["owen-herterich"][frameNumber]);
		        }
		    }

		    if (frameNumber == 7 || frameNumber == 41) { forward = !forward; }
		    if (metaSpin) { counter += spinRate; }
		    if (counter > 3200 && frameNumber == 0) { metaSpin = false; counter = 0; } 
		}, spinRate);


		setInterval(function () {
		    metaSpin = !metaSpin;
		}, 30000);
		</script>
	</body>
</html>