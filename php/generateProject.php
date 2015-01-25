<?php

	$tpl_file = "templates/projectTemplate.php";

	$numPhotos = $_POST['numPhotos'];

	$data['title'] = $_POST['title'];
	$data['date'] = $_POST['date'];
	$data['tools'] = $_POST['tools'];
	$data['description'] = $_POST['description'];
	$data['video'] = $_POST['video'];

	$placeholders = array( "{title}", "{date}", "{tools}", "{description}", "{video}" );

	for ( $i = 1; $i <= $numPhotos; $i+=1) {
		$data['photo'.$i] = $_POST['photo'.$i];
		array_push($placeholders, '{photo'.$i.'}');
	}

	$tpl = file_get_contents($tpl_file);

	$new_project_file = str_replace($placeholders, $data, $tpl);

	$pos = strpos($tpl, '<a href="#"');

	for ($i = 1; $i <= $numPhotos; $i+=1) {
		$img = '<img src="'.$data['photo'.$i].'" class="documentation">';
		$new_project_file = substr_replace($new_project_file, $img, $pos+4, 0);
	}

	$html_file_name = "index.html";

	$folder_name = strtolower($data['title']);
	$folder_name = str_replace(' ', '', $folder_name);
	mkdir( "projects/".$folder_name);

	$project_path = "projects/".$folder_name."/";

	$fp = fopen($project_path.$html_file_name, "w");
	fwrite($fp, $new_project_file);
	fclose($fp);



	/**************** UPLOAD IMAGES ***********************/
	for ($i = 1; $i <= $numPhotos; $i+=1) {
		$photo = 'photo'.$i;

		if($_FILES[$photo]['name'])
		{
			echo $_FILES[$photo]['name'];
			//if no errors...
			if(!$_FILES[$photo]['error'])
			{
				//now is the time to modify the future file name and validate the file
				$new_file_name = strtolower($_FILES[$photo]['tmp_name']); //rename file
				
				//move it to where we want it to be
				move_uploaded_file($_FILES[$photo]['tmp_name'], $new_file_name);
				echo "Uploaded!";
			}
			//if there is an error...
			else
			{
				//set that to be the returned message
				$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES[$photo]['error'];
			}
		}
	}

?>