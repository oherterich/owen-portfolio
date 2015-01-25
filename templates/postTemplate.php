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
			<?
				require_once('../php/post-nav.php');
			?>
			<section id="all-posts">
				<article class="post">
				<h1>{title}</h1>
				<h3>{date}</h3>
				{content}
				</article>
			</section>
		</div>
	</body>
</html>