<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<title>Traditional Healers SMS Information</title>
<link type="text/css" rel="stylesheet" href="style.css">
<script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
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
<article id="allmessages">
	<h3>Select a date</h3>
	<form action="monitor.php" method="get">
		<p>From</p>
		<input type="text" id="from" name="from" />
		<p>To</p>
		<input type="text" id="to" name="to" />
		<input type="submit" class="submitbutton">
	</form>

<?php
// Get the PHP helper library from twilio.com/docs/php/install
require_once('Twilio/Services/Twilio.php'); // Loads the library
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC5f2e7156f2ce0762d2a4bf4d4d7e4f00"; 
$token = "193bd6cb7a54f2912f0440b094f1f088"; 
$client = new Services_Twilio($sid, $token);

// Create arrays for code, date, and from
$codes = array();
$dates = array();
$from = array();

// Load XML file with questions/comments
$file = "questionlist.xml";
$questionlist = simplexml_load_file($file);

//Load XML file of hospices
$hospicefile = "hospice_list.xml";
$hospicelist = simplexml_load_file($hospicefile);

//Set variables for dates
date_default_timezone_set('Africa/Johannesburg');
$toDate = date('Y-m-d');
$fromDate = "2013-06-18";

if(isSet($_GET['to'])) {
	$getTo = $_GET['to'];
	$toDate = formatDate($getTo);
}

if(isSet($_GET['from'])) {
	$getFrom = $_GET['from'];
	$fromDate = formatDate($getFrom);
}

//Function to format date to "DateSent" format
function formatDate($date) {
	$year = substr($date, -4);
	$month = substr($date, 0, 2);
	$day = substr($date,3,2);
	$newDate = $year . "-" . $month . "-" . $day;
	return $newDate;
} 

// Function to shorten date
function shortenDate($date) {
	$newDate = substr($date, 0, -6);
	return $newDate;
}

// Function to format phone number
function formatFrom($number) {
	$newNumber = "0";
	$lastTen = substr($number, -9);
	$newNumber .= $lastTen;
	return $newNumber;
}
 
// Loop over the list of messages and add attributes to array.
foreach ($client->account->sms_messages->getIterator(0,50, array(
	"Direction" => "inbound",
	"DateSent>" => $fromDate,
	"DateSent<" => $toDate
	)) as $message) {
	if ($message->direction == "inbound") {
		if ($message->body[0] == "1" || $message->body[0] == "2") {
    		$codes[] = $message->body;
    		$dates[] = shortenDate($message->date_sent);
    		$from[] = formatFrom($message->from);
    	}
    	
    	foreach ($hospicelist->district as $d) {  	
    		if ($message->body == $d->code) {
    			$mapcodes[] = $message->body;
    			$mapdates[] = shortenDate($message->date_sent);
    			$mapfrom[] = formatFrom($message->from);
    		}
    	}
    }
}

// Get length of array of messages
$length = sizeof($codes);

echo '<h3>List of Incoming SMS Codes</h3>
		<p>From '.$fromDate.' until '.$toDate.'</p>
	<table>
		<tr>
			<th>Code</th>
			<th>Date</th>
			<th>From</th>
		</tr>';

// Loop through arrays and echo all three attributes
for ($i=0; $i<$length; $i++) {
	echo "<tr>
			<td>$codes[$i]</td>
			<td>$dates[$i]</td>
			<td>$from[$i]</td>
		</tr>";
}

echo '</table> </article>
	<article id="commoncode">
	<h3>Most Requested Codes</h3>';
	
$countCodes = array_count_values($codes);
arsort($countCodes);

echo '<table>
		<tr>
			<th></th>
			<th>Code</th>
			<th># of Requests</th>
		</tr>';

$num = 0;

foreach ($countCodes as $x=>$x_value) {
	if ($x_value > 1) {
		$num += 1;
		echo "<tr>
				<td>$num.</td>
				<td>$x</td>
				<td>$x_value requests</td>
			</tr>";
	}
}

echo '</table></article>
		<article id="commonphone">
		<h3>Most Common Phone Numbers</h3>';
	
$countFrom = array_count_values($from);
arsort($countFrom);

echo '<table>
		<tr>
			<th></th>
			<th>From</th>
			<th># of Requests</th>
		</tr>';

$num = 0;

foreach ($countFrom as $x=>$x_value) {
	if ($x_value > 1) {
		$num += 1;
		echo "<tr>
				<td>$num.</td>
				<td>$x</td>
				<td>$x_value requests</td>
			</tr>";
	}
}

echo '</table></article>
		<article id="questions">
		<h3>Questions & Suggestions</h3>';

echo "<table>
		<tr>
			<th>Question</th>
			<th>Date</th>
			<th>From</th>
		</tr>";

//Get list of questions sent in
foreach ($questionlist->message as $q) {
	echo "<tr>
			<td>$q->question</td>
			<td>$q->date</td>
			<td>$q->from</td>
		</tr>";
}

echo '</table></article>
		<article id="locations">
		<h3>Hospice Location Requests</h3>';

// Map codes


// Get length of array of messages
$length = sizeof($mapcodes);

echo '<table>
		<tr>
			<th>Code</th>
			<th>Date</th>
			<th>From</th>
		</tr>';

// Loop through arrays and echo all three attributes
for ($i=0; $i<$length; $i++) {
	echo "<tr>
			<td>$mapcodes[$i]</td>
			<td>$mapdates[$i]</td>
			<td>$mapfrom[$i]</td>
		</tr>";
}

echo '</table> </article>';
?>

<footer>
	<p>HPCA  |  Parsons School of Design  |  Open Society Foundations &copy; 2013</p>
</footer>
</section>

</div>
</body>
</html>