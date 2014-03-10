<?php
// Get the phone number that sent the SMS.
if (isset($_POST['from'])) {
    $from = $_POST['from'];
}
 
// Get the SMS aka the message sent.
if (isset($_POST['message'])) {
    $message = $_POST['message'];
}
 
// Get secret key to validate later.
if (isset($_POST['secret'])) {
    $secret = $_POST['secret'];
}
 
// Get the timestamp of the SMS
if(isset($_POST['sent_timestamp'])) {
    $sent_timestamp = $_POST['sent_timestamp'];
}
 
// Get phone number of the SMSSync device
if (isset($_POST['sent_to'])) {
    $sent_to = $_POST['sent_to'];
}
 
// Get the unique message id
if (isset($_POST['message_id'])) {
    $message_id = $_POST['message_id'];
}
 
// Set success to false as the default success status
$success = "false";
 
/**
 * Now we have retrieved the data sent by SMSSync 
 * via HTTP. Next, we handle this data. In this demo,
 * we simply save the data to a text file.
 */
if ((strlen($from) > 0) AND (strlen($message) > 0) AND 
    (strlen($sent_timestamp) > 0 ) AND (strlen($sent_to) > 0) 
    AND (strlen($message_id) > 0)) {
 
    /**
     * The secret key set here is 123456.
     * Make sure this is set in SMSSync. 
     */
    if ( ( $secret == '123456')) {
        $success = "true";
    }
 
    // Now write the info to a file called test.txt
    $string = "From: ".$from."\n";
    $string .= "Message: ".$message."\n";
    $string .= "Timestamp: ".$sent_timestamp."\n";
    $string .= "Messages Id:" .$message_id."\n";
    $string .= "Sent to: ".$sent_to."\n\n\n";
    $myFile = "test.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    @fwrite($fh, $string);
    @fclose($fh);
 
} 
 
/**
 * Finally, send a JSON formatted response to SMSSync to 
 * acknowledge that the web service received the message.
 */
// echo json_encode(array("payload"=>array(
//     "success"=>$success)));
 
/**
 * Uncomment the code below to send an instant 
 * reply as SMS to the user.
 *
 * This feature requires the "Get reply from server" checked on SMSSync.
 */
 

$msg = "Your message has been received: It's working!";
 
$reply[0] = array("to" => $from, "message" => $msg);
 
echo json_encode(array("payload"=>array(
    "success"=>$success,
    "task"=>"send",
    "messages"=>array_values($reply))));

?>