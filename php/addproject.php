<!DOCTYPE HTML>
<html>
	<head>
		<title>Add A Project</title>

		<style>
			body {
				background: #ddd;
			}

			#content {
				width: 70%;
				margin: 0 auto;
				padding: 1%;
				background: #fff;
			}

			input {
				display: block;
				padding: 1%;
				margin: 2%;
			}

			textarea {
				display: block;
				padding: 1%;
				margin: 2%;
			}

			button {
				display: block;
				padding: 1%;
				margin: 2%;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<h1>Add A Project</h1>
			<form id="projectform" method="post" action="generateProject.php" enctype="multipart/form-data">
				<input type="text" name="title" placeholder="Title">
				<input type="text" name="date" placeholder="Date">
				<input type="text" name="tools" placeholder="Tools/Techniques">
				<textarea form="projectform" name="description" placeholder="Description"></textarea>
				<textarea form="projectform" name="video" placeholder="Video Link"></textarea>
					<div id="photolinks">
						<input type="file" name="photo1" placeholder="Photo Link">
					</div>
				<button type="button" onclick="addPhoto()">Add Photo</button>
				<input type="hidden" id="numPhotosInput" name="numPhotos" value="1">
				<input type="submit">
			</form>
		</div>

		<script>
		var numPhotos = 1;
		var numPhotosInput = document.getElementById('numPhotosInput');

			var addPhoto = function() {
				numPhotos++;
				numPhotosInput.value = numPhotos;

				var photos = document.getElementById('photolinks');
				var p = document.createElement('input');
				p.type = 'file';
				p.name = 'photo' + numPhotos;
				p.placeholder = "Photo Link"
				photos.appendChild(p);
			}
		</script>
	</body>
</html>