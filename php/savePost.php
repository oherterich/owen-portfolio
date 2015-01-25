<?php

	if ( $_POST['title'] == '' || $_POST['content'] == '' ) {
		echo '<h1>Enter all of the fields!</h1> <a href="createpost.php">Try again?</a>';
	}

	else if ( isset( $_POST['title'] ) && isset( $_POST['content'] ) ) {
		$mysql = mysql_connect('127.0.0.1', 'owenhert_owen', 'gnEsW.qO_C2n');
		//$mysql = mysql_connect('127.0.0.1', 'root', 'root');
		mysql_select_db('owenhert_blog', $mysql);
		//mysql_select_db('PortfolioBlog', $mysql);

		$title = $_POST['title'];
		$newTitle = mysql_real_escape_string($title);
		$content = $_POST['content'];
		$newContent = mysql_real_escape_string($content);
		$time = date('m d Y');
		$link = str_replace( ' ', '-', strtolower($title) ) . '-' . str_replace( ' ', '-', $time ) . ".php";

		$sql = "INSERT INTO info (link, title, time, content) VALUES ( '$link', '$newTitle', '$time', '$newContent' )";
		$result = mysql_query($sql);

		if ( $result != false) {
			echo '<h1>Success!</h1> <a href="createpost.php">Go back.</a>';

			$placeholders = array( "{title}", "{date}", "{content}" );
			$data = array( $title, $time, $content );

			$tpl_file = "../templates/postTemplate.php";
			$tpl = file_get_contents($tpl_file);

			$new_project_file = str_replace($placeholders, $data, $tpl);

			$project_path = "../posts/";

			$fp = fopen($project_path.$link, "w");
			fwrite($fp, $new_project_file);
			fclose($fp);
		}
		else {
			echo '<h1>Something went wrong.</h1> <a href="createpost.php">Try again?</a>';
			echo mysql_error();
		}
	}

	else {
		echo '<h1>Something went wrong.</h1> <a href="createpost.php">Try again?</a>';
	}
?>