<?php
require_once('init.php');
$id = $_GET['user_id'];
$title = "משתמש חדש";
if($id) {
	$user = db_get_id($id, 'users');
	$query = "SELECT `list_id` FROM `lists_users` WHERE `user_id` = '".$user['id']."'";
	$result = _mysql_query($query);
	$user['lists'] = array();
	while($ww = mysql_fetch_assoc($result)) $user['lists'][] = $ww['list_id'];
	$title = "ערוך משתמש";
} elseif(!empty($_POST)) {
	$user = $_POST['user'];
	$user['id'] = intval($user['id']);
	$user['phone'] = preg_replace('/([^0-9])/', '', $user['phone']);
	$user['smsSender'] = $user['smsSender'] ? 1 : 0;
	$user['id'] = db_save($user, 'users');
	$lists = $_POST['lists'];
	$query = "DELETE FROM `lists_users` WHERE `user_id` = '".$user['id']."'";
	_mysql_query($query);
	foreach($lists as $key => $list) {
		if($list==1) {
			$db = array();
			$db['user_id'] = $user['id'];
			$db['list_id'] = $key;
			db_save($db, 'lists_users');
		}
	}
	go('users.php?edited_id='.$user['id']);
}
$query = "SELECT * FROM `lists`";
$result = _mysql_query($query);
$lists = array();
while($ww = mysql_fetch_assoc($result)) $lists[$ww['id']] = $ww;

include('edit_user.tpl');
?>