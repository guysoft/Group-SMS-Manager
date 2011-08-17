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
include('init.php');
$title = "שליחת SMS";
$query = "SELECT id, name FROM lists";
$result = _mysql_query($query);
$lists = array();
while($ww = mysql_fetch_assoc($result)) $lists[$ww['id']] = $ww['name'];
//debug($lists);
if(!empty($_POST)) {
	$sms = $_POST['sms'];
	$message_id = save_message($sms, $_SERVER['REMOTE_ADDR'], true);
	if($message_id) {
		send_message($message_id);
		$message = "ההודעה נשלחה בהצלחה";
	}
}

include('webform.tpl');
?>