<?php
/**
 * @file func_sms.php SMS sending using ws.my-t.co.il
 * Group SMS Manager
 * A system to control mass sign up and sending of SMS to a variety of services
 * https://github.com/guysoft/Group-SMS-Manager
 * J14Hackers group
 * 
 * @author: Eyal Ben Ivri <eyalbenivri at gmail.com>
 * @author: Guy Sheffer <guysoft at gmail.com>
 * 
 */
$SMS_USER="";
$SMS_SENDER="";
$SMS_PASS="";
$SMS_TARGET = "";

function send_sms($message, $users) {
	$targets = array();
	$outbox = array();
	foreach($users as $user) {
		$db = array();
		$db['message_id'] = $message['id'];
		$db['user_id'] = $user['id'];
		$db['sent'] = date("Y-m-d H:i:s", time());
		$db['id'] = db_save($db, 'sms_outbox');
		if($db['id']) { $targets[$user['id']] = $user; $outbox[$db['id']] = $db; }
	}
	//$xml = getXMLForSending($message['text'], $targets);
	//$result = curlToSend($xml);
	$result = getToSend($message['text'], $targets);
	//debug($result);
	foreach($outbox as $id => $db) {
		$db['result'] = $result;
		db_save($db, 'sms_outbox');
	}
}

function send_message($message_id) {
	$message = db_get_id($message_id, 'sms_messages');
	if(!$message['id']) return false;
	
	$query = "
		SELECT `users`.* 
		FROM `users`
		INNER JOIN `lists_users` ON `users`.`id` = `lists_users`.`user_id`
		WHERE `lists_users`.`list_id` = '".$message['list_id']."'
	";
	$result = _mysql_query($query);
	$users = array();
	while($ww = mysql_fetch_assoc($result)) {
		if($ww['id'] != $message['creator_id']) $users[$ww['id']] = $ww;
	}
	send_sms($message, $users);
	$message['finished'] = date("Y-m-d H:i:s");
	db_save($message, 'sms-messages');
}

function parse_sms($arr, $user) {
	$query = "SELECT * FROM `lists`";
	$result = _mysql_query($query);
	$lists = array();
	$the_list = false;
	while($ww = mysql_fetch_assoc($result)) {
		$lists[$ww['id']] = $ww;
		if(strpos($arr['sms'], $ww['name'])===0) $the_list = $ww;
	}
	
	if($the_list) {
		$sms = array();
		$sms['text'] = substr(trim($arr['sms']), strlen(trim($the_list['name'])) + 1);
		$sms['list_id'] = $the_list['id'];
		return $sms;
	} else {
		send_single("לא נמצאה רשימה", $user);
	}
}

function save_message($message, $source_data, $isFromWebForm = false) {
	$query = "SELECT * FROM `lists` WHERE `id` = '".mysql_real_escape_string($message['list_id'])."' LIMIT 1";
	$result = _mysql_query($query);
	$list = mysql_fetch_assoc($result);
	if($list['id']) {
		$db = array();
		$db['list_id'] = $list['id'];
		$db['source'] = $isFromWebForm ? 'WEBFORM' : 'SMS';
		$db['ip_address'] = $isFromWebForm ? $source_data : '';
		$db['creator_id'] = $isFromWebForm ? 0 : $source_data;
		$db['text'] = $message['text'];
		$db['created'] = date("Y-m-d H:i:s", time());
		return db_save($db, 'sms_messages');
	}
	return false;
}

function getXMLForSending($text, $users) {
	global $SMS_USER;
	global $SMS_SENDER;
	global $SMS_PASS;
	global $SMS_TARGET;
	
	$targets = '';
	foreach($users as $user) if($user['phone']) $targets .= "<Target>".urlencode($user['phone'])."</Target>";
	$xml = "
		<Netcell>
			<Header Method=\"SMSMT\" Billing=\"CB\">
				<User>" . $SMS_USER . "</User>
				<Password>" . $SMS_PASS . "</Password>
				<Sender>" . $SMS_SENDER . "</Sender>
			</Header>
			<Body>
				<Content Type=\"TEXT\">
					<Data>Tents</Data>
				</Content>
				<Destination>
					<Target>" . $SMS_TARGET . "</Target>
				</Destination>
			</Body>
		</Netcell>
	";
	$xml = str_replace("\t", "", $xml);
	$xml = str_replace("\n", "", $xml);
	return $xml;
}

function curlToSend($post) {
	//debug($post);
	$url = 'http://ws.my-t.co.il/SendSms.aspx';
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 20); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
	$result = curl_exec($ch);
	
	if(curl_errno($ch)) {
		$result = 'ERROR -> '.curl_errno($ch).': '.curl_error($ch);
	} else {
		$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		switch($returnCode) {
			case 200:
				break;
			default:
				$result = 'HTTP ERROR -> '.$returnCode;
			break;
		}
	}
	
	curl_close($ch);
	return $result;
}

function getToSend($text, $users) {
	global $SMS_USER;
	global $SMS_SENDER;
	global $SMS_PASS;
	$phones = array();
	foreach($users as $user) if($user['phone']) $phones[] = $user['phone'];
	$url = 'http://ws.my-t.co.il/SendSms.aspx?User=' . $SMS_USER . '&Password='.$SMS_PASS . '&Method=SMSMT&Billing=CB&Sender='. $SMS_SENDER .'&Data='.urlencode($text).'&Target='.implode(';', $phones);
	//debug($url);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 20); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
	$result = curl_exec($ch);
	
	if(curl_errno($ch)) {
		$result = 'ERROR -> '.curl_errno($ch).': '.curl_error($ch);
	} else {
		$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		switch($returnCode) {
			case 200:
				break;
			default:
				$result = 'HTTP ERROR -> '.$returnCode;
			break;
		}
	}
	
	curl_close($ch);
	return $result;
}

function getUserByPhone($phone) {
	$query = "SELECT * FROM `users` WHERE `phone` = '".mysql_real_escape_string($phone)."' AND `smsSender` = '1' LIMIT 1";
	$result = _mysql_query($query);
	$user = mysql_fetch_assoc($result);
	return $user;
}

function send_complete($message_id) {
	$message = db_get_id($message_id, 'sms_messages');
	if(!$message['id']) return false;
	$user = db_get_id($message['creator_id'], 'users');
	$list = db_get_id($message['list_id'], 'lists');
	if($user['id'] && $list['id']) send_single("ההודעה נשלחה בהצלחה ל ".$list['name'], $user);
}

function send_single($text, $user) {
	return getToSend($text, array($user));
}

?>