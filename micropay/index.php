<?php
/**
 * @file
 * Group SMS Manager
 * A system to control mass sign up and sending of SMS to a variety of services
 * https://github.com/guysoft/Group-SMS-Manager
 * J14Hackers group
 * 
 * @author: Eyal Ben Ivri <eyalbenivri at gmail.com>
 * 
 */
 
/*
function grab_dump($var) {
	ob_start();
	print_r($var);
	return ob_get_clean();
}

$r = grab_dump($_REQUEST);

$myFile = "testFile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $r);
fclose($fh);
*/


require_once('../init.php');
$sms = $_REQUEST;
$user = getUserByPhone($sms['phone']);
if($user['id']) {
	$sms = parse_sms($sms, $user);
	$message_id = save_message($sms, $user['id'], false);
	if($message_id) {
		send_message($message_id);
		send_complete($message_id);
	}

} else {
	// ignore - optional: put into blacklist
}
?>
OK