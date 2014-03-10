<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Traditional Healers Information Form</title>
<link type="text/css" rel="stylesheet" href="style.css">
</head>

<body>

	<div id="wrapper">

	<header></header>
	
	<nav>
	<ul>
		<li><a href="index.html">Home</a></li><li><a href="edit.php">Edit</a></li><li><a href="monitor.php">Monitor</a></li><li><a href="send.php">Send</a></li><li><a href="materials.html">Materials</a></li>
	</ul>
	</nav>

	<section>
	<article class="instructions half">
		<h2>Instructions</h2>
		<p>1. Select the language of the information you want to change.</p>
		<p>2. Select which code/topic you want to change.</p>
		<p>3. Change the text in the text box and press the 'Submit' button</p>
		<aside>
			<h4>Note: If the information is longer than one SMS message, the information will be shown in multiple boxes.</h4>
			<h4>Please distribute changed information across all available boxes to maximise efficiency (Maximum 160 characters in each box)</h4>
		</aside>
	</article>
		
	<article class="half">
<?php

if(isset($_GET['language'])) {
	$language = $_GET['language'];
	
	if ($language == 'english') {
	$xmlFile = "information_english.xml";
	$xml = simplexml_load_file($xmlFile);
	$subject = array();
	foreach($xml->subject as $s) {
		$subject[] = $s;
		}
$length = sizeof($subject);
	}
	
if ($language == 'zulu') {
	$xmlFile = "information_zulu.xml";
	$xml = simplexml_load_file($xmlFile);
	$subject = array();
	foreach($xml->subject as $s) {
	$subject[] = $s;
		}
	$length = sizeof($subject);
	}
}

$message = strtolower($_REQUEST['Body']);

$subject = array();

if(isset($_GET['language'])) {
	foreach($xml->subject as $s) {

		$subject[] = $s;
	}
}
$length = sizeof($subject);

if(isset($_GET['selected'])){
	$whichcode = $_GET['selected'];
$selected = $subject[$whichcode]->info;
$selected2 = $subject[$whichcode]->info2;
$selected3 = $subject[$whichcode]->info3;
$selected4 = $subject[$whichcode]->info4;
$selected5 = $subject[$whichcode]->info5;
echo '<form action="edit.php" method="get">';
echo '<textarea class="140" name="updatedtext">' . $selected . '</textarea>';
if ($selected2 != "") {echo '<textarea class="140" name="updatedtext2">' . $selected2 . '</textarea>';}
if ($selected3 != "") {echo '<textarea class="140" name="updatedtext3">' . $selected3 . '</textarea>';}
if ($selected4 != "") {echo '<textarea class="140" name="updatedtext4">' . $selected4 . '</textarea>';} 
if ($selected5 != "") {echo '<textarea class="140" name="updatedtext5">' . $selected5 . '</textarea>';}
echo '<input type="hidden" name="code" value="'.$subject[$whichcode]->code.'">';
echo '<input type="hidden" name="language" value="' . $language . '">';
echo '<input type="submit" class="submitbutton"></form>';
}

if(isset($_GET['updatedtext']) && isset($_GET['code'])){
$updated = $_GET['updatedtext'];
$updated2 = $_GET['updatedtext2'];
$updated3 = $_GET['updatedtext3'];
$updated4 = $_GET['updatedtext4'];
$updated5 = $_GET['updatedtext5'];
$number = $_GET['code'];
foreach($xml->subject as $s){
	if ($s->code == $number) {
		$s->info = $updated;
		$s->info2 = $updated2;
		$s->info3 = $updated3;
		$s->info4 = $updated4;
		$s->info5 = $updated5;
		break;
	}
}
$xml->asXML($xmlFile);

}

//echo '</article><article id="selecttopic">';

if(isset($_GET['language'])) {

echo '<form action="edit.php" method="get">';
echo '<select name="selected">';
echo '<option>-- Select a topic --</option>';
for ($i = 0; $i < $length; $i++) { 
 echo '<option value="' . $i . '">'; 
  echo $subject[$i]->code . " - " . $subject[$i]['name'] . "</option>";
  }
echo '</select>';
echo '<input type="hidden" name="language" value="' . $language . '">';
echo '<span class="submit"><input type="submit" class="submitbutton"> </span></form>';
}

?> 

<form action="edit.php" method="get">
<select name="language">
<option>-- Select a language --</option>
<option value="zulu">Isizulu</option>
<option value="english">English</option>
</select>
<span class="submit">
<input type='submit' class="submitbutton">
</span>
</form>
	</article>
	<footer>
	<p>HPCA  |  Parsons School of Design  |  Open Society Foundations &copy; 2013</p>
</footer>
	</section>	
	</wrapper>
</body>
</html>