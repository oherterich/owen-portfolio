<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Traditional Healers SMS Information</title>
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
	<article class="instructions half left">
		<h2>Mass SMS System</h2>
		<h3>Use this page to send out an SMS to everyone on the messaging list.</h3>
		<h3>You can also add contacts to the list in two different ways:</h3>
		<ul>
			<li>Use the form on this page to manually add contacts.</li>
			<li>SMS the word "Hospice" plus your name to the number. Example: "Hospice Zodwa Sithole"</li>
		</ul>
	</article>

<article class="half left">
	<h3>Send a message to the list</h3>
	<p>To send a message, simply type your message in the box below and click "Submit"</p>
	<h4>Remember, this must be less than 160 characters.</h4>
	<form>
		<p>Message:<textarea type="textarea" name="message" class="140"></textarea></p>
		<input type="submit" class="submitbutton">
	</form>
	
<?php
// Get the PHP helper library from twilio.com/docs/php/install
require_once('Twilio/Services/Twilio.php'); // Loads the library
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC5f2e7156f2ce0762d2a4bf4d4d7e4f00"; 
$token = "193bd6cb7a54f2912f0440b094f1f088"; 
$client = new Services_Twilio($sid, $token);

$file = "numberlist.xml";
$numberlist = simplexml_load_file($file);
//Code to send messages

if(isset($_GET['message'])) {
	$message = $_GET['message'];

	foreach($numberlist->contact as $n) { 
		$message = $client->account->sms_messages->create("+14844434657", "$n->number", "$message");
	}
	
	echo '<p>You have sent a message.</p>';
	
}

//Add a contact to table
echo '</article>
		<article class="half left">
		<h3>Add a new contact to list</h3>
		<p>To add a contact, please enter their name and phone number in the boxes below and click "Submit"</p>
		<form>
		<p>Name:<input type="text" name="newname"></p>
		<p>Number:<input type="text" name="newnumber"></p>
		<input type="submit" class="submitbutton">
		</form>';

if(isset($_GET['newname']) && isset($_GET['newnumber'])) {
	$newname = $_GET['newname'];
	$newnumber = $_GET['newnumber'];
	if($newname == "" || $newnumber == "") {
		echo "<p>Please enter both a name AND a number.</p>";
	}
	else {
		$newContact = $numberlist->addChild("contact");
		$newContact->addChild("name", $newname);
		$newContact->addChild("number", $newnumber);
	
		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($numberlist->asXML());
		$dom->saveXML();

		$dom->save($file);
	}
}

echo '</article><article class="half right">';

//Table of contacts in XML file
echo '<h3>Messaging List</h3>
		<table>
			<tr>
			<th>Name</th>
				<th>Number</th>
			</tr>';
			
foreach($numberlist as $n) {
		echo '<tr>
			<td>' . $n->name . '</td>
			<td>' . $n->number . '</td>
		</tr>';
}
	
echo '</table></article>';

?>

<footer>
	<p>HPCA  |  Parsons School of Design  |  Open Society Foundations &copy; 2013</p>
</footer>
</section>

</div>
</body>
</html>