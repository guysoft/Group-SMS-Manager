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
$id = intval($_GET['user_id']);
if(!$id) go('users.php');
$query = "DELETE FROM `users` WHERE `id` = '$id' LIMIT 1";
$result = _mysql_query($query);

$query = "DELETE FROM `lists_users` WHERE `user_id` = '$id' LIMIT 1";
$result = _mysql_query($query);
go('users.php?deleted_user='.$id);

?>