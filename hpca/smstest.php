<?php
$message = strtolower($_REQUEST['Body']);
$from = strtolower($_REQUEST['From']);

date_default_timezone_set('Africa/Johannesburg');
$date = date('d-m-Y H:i:s');

$xmlzulu = simplexml_load_file("information_zulu.xml");
$xmlenglish = simplexml_load_file("information_english.xml");
$xmlhospice = simplexml_load_file("hospice_list.xml");

$file = "questionlist.xml";
$questionlist = simplexml_load_file($file);

$numberfile = "numberlist.xml";
$numberlist = simplexml_load_file($numberfile);

foreach($xmlzulu->subject as $z) {
$subjectzulu[] = $z;
}

$zululength = sizeof($subjectzulu);

foreach($xmlenglish->subject as $e) {
$subjectenglish[] = $e;
}

$englishlength = sizeof($subjectenglish);

foreach($xmlhospice as $h) {
$hospicelist[] = $h;
}

$hospicelength = sizeof($hospicelist);

$correct = false;

/*
require_once( 'pachube_functions.php' );


$api_key = "TnIZKUUPdfkHIfN-wTC7y3Fr9CZqxF4kY0umINQLAZ8";

$pachube = new Pachube($api_key);
$feed = 24004;
$data2 = $pachube->retrieveData ( $feed, "json" );
$json = json_decode($data2, true);
$level = intval($json[datastreams][2][values][0][value]);
*/
    // now greet the sender
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>

<?php 

for ($i = 0; $i < $zululength; $i++) {
	if ($message == $subjectzulu[$i]->code) { 
		$correct = true;?>
		<Sms><?php echo $subjectzulu[$i]->info ?></Sms>
		<? $message2 = $subjectzulu[$i]->info2;
		if ($message2 != " ") { ?>
		<Sms><?php echo $subjectzulu[$i]->info2 ?></Sms>
		<?php } ?>
		<?php $message3 = $subjectzulu[$i]->info3;
		if ($message3 != " ") { ?>
		<Sms><?php echo $subjectzulu[$i]->info3 ?></Sms>
		<?php } ?>
		<?php $message4 = $subjectzulu[$i]->info4;
		if ($message4 != " ") { ?>
		<Sms><?php echo $subjectzulu[$i]->info4 ?></Sms>
		<?php } ?>
		<?php $message5 = $subjectzulu[$i]->info5;
		if ($message5 != " ") { ?>
		<Sms><?php echo $subjectzulu[$i]->info5 ?></Sms>
		<?php } 
		} ?>
		
		<?php	if ($message == $subjectenglish[$i]->code) { 
		$correct = true;?>
		<Sms><?php echo $subjectenglish[$i]->info ?></Sms>
		<? $message2 = $subjectenglish[$i]->info2;
		if ($message2 != " ") { ?>
		<Sms><?php echo $subjectenglish[$i]->info2 ?></Sms>
		<?php } ?>
		<?php $message3 = $subjectenglish[$i]->info3;
		if ($message3 != " ") { ?>
		<Sms><?php echo $subjectenglish[$i]->info3 ?></Sms>
		<?php } ?>
		<?php $message4 = $subjectenglish[$i]->info4;
		if ($message4 != " ") { ?>
		<Sms><?php echo $subjectenglish[$i]->info4 ?></Sms>
		<?php } ?>
		<?php $message5 = $subjectenglish[$i]->info5;
		if ($message5 != " ") { ?>
		<Sms><?php echo $subjectenglish[$i]->info5 ?></Sms>
		<?php }
		}
		
	}

//Sending responses to hospice location requests	
for ($j = 0; $j < $hospicelength; $j++) {
	if ($message == $hospicelist[$j]->code) { 
	$correct = true;?>
		<Sms><?php echo $hospicelist[$j]->info ?></Sms><?php
	}
}

//For questions that are submitted
if (substr($message,0,4) == "000 ") {
	$correct = true;?>
	<Sms>Thank you for submitting your question or suggestion.</Sms>
	<?php
	$question = substr($message,4);
	$newMessage = $questionlist->addChild("message");
	$newMessage->addChild("question", $question);
	$newMessage->addChild("date", $date);
	$newMessage->addChild("from", $from);
	
	$dom = new DOMDocument("1.0");
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($questionlist->asXML());
	$dom->saveXML();

	$dom->save($file);
}

//For adding contacts to messaging list
if (substr($message,0,8) == "hospice " || substr($message,0,8) == "Hospice " || substr($message,0,8) == "HOSPICE ") {
	$correct = true;
	
	foreach($numberlist->contact as $n) {
		if ($n->number == $from) {?>
			<Sms>Sorry, but it seems that you are already a member of our messaging list!</Sms>
			<?php
			$duplicate = true;
		}
	}
	
	if (!$duplicate) {?>
			<Sms>Thank you for signing up to our messaging list. You will now receive news, updates, and information from HPCA.</Sms>
			<?php
			$name = substr($message, 7);
			$newContact = $numberlist->addChild("contact");
			$newContact->addChild("name", $name);
			$newContact->addChild("number", $from);
	
			$dom = new DOMDocument("1.0");
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($numberlist->asXML());
			$dom->saveXML();

			$dom->save($numberfile);
	}
}

//Automatic response if SMS received is incorrect
if ($correct == false) { ?>
	<Sms>The code or question you sent was incorrectly formatted or missing. Please make sure you are sending a valid SMS.</Sms>
	<?php }
?>

</Response>