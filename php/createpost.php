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
				width: 600px;
				height: 300px;
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
			<h1>Add A Post</h1>
			<form id="projectform" method="post" action="savePost.php" enctype="multipart/form-data">
				<input type="text" name="title" placeholder="Title">
				<textarea form="projectform" name="content" placeholder="Content"></textarea>
				<input type="submit">
			</form>
		</div>
	</body>
</html>