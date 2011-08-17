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
require_once('init.php');
$id = $_GET['list_id'];
$title = "קבוצה חדשה";
if($id) {
	$list = db_get_id($id, 'lists');
	if($list['id']) $title = "ערוך משתמש";
} elseif(!empty($_POST)) {
	$list = $_POST['list'];
	$list['id'] = intval($list['id']);
	$list['id'] = db_save($list, 'lists');
	go('lists.php?edited_id='.$list['id']);
}

include('edit_list.tpl');
?>