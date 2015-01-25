<!DOCTYPE HTML>
<html>
	<head>
		<title>Owen Herterich</title>

		<link href="../css/style.css" type="text/css" rel="stylesheet">
		<link href="../css/tablet.css" type="text/css" rel="stylesheet">
		<link href="../css/mobile.css" type="text/css" rel="stylesheet">
		<link rel='icon' href='../img/icons/favicon.png' type='image/png'>

		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<div id="content">
			<section id="sidebar">
				<a href="../index.html"><img src="../img/owen_logo.png"></a>
				<ul>
					<a href="../index.html"><li id="workplay">WORK / PLAY</li></a>
					<a href="../about.html"><li id="whoami">WHO AM I?</li></a>
					<li class="active" id="thisthat">THIS &amp; THAT</li>
				</ul>
			</section>

			<section id="all-posts">
				<?php
					$mysql = mysql_connect('127.0.0.1', 'owenhert_owen', 'gnEsW.qO_C2n');
					//$mysql = mysql_connect('127.0.0.1', 'root', 'root');
					mysql_select_db('owenhert_blog', $mysql);
					//mysql_select_db('PortfolioBlog', $mysql);

					$sql = "SELECT * FROM info ORDER BY `id` DESC";
					$query = mysql_query($sql);
					while ( $data = mysql_fetch_assoc($query) ) {
						echo '<article class="post">';
						echo '<h1><a href="' . $data['link'] . '">' . $data['title'] . '</a></h1>';
						echo '<h3>' . $data['time'] . '</h3>';
						echo $data['content'];
						echo '</article>';
					}
				?>
			</section>

		</div>
	</body>
</html>