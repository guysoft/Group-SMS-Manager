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
$file = 'sms.csv';
$csv = trim(file_get_contents($file));
$csv = explode("\n", $csv);
foreach($csv as &$row) $row = explode(",", $row);
foreach($csv as &$row) foreach($row as &$cell) $cell = "0".trim($cell);

foreach($csv as $row) {
	$db = array();
	$db['phone'] = $row[0];
	$db['name'] = $row[0];
	$db['smsSender'] = 0;
	
	$db['id'] = db_save($db, 'users');
	
	$db2 = array();
	$db2['list_id'] = 1;
	$db2['user_id'] = $db['id'];
	$db2['id'] = db_save($db2, 'lists_users');
}

?>