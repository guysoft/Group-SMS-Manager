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
$id = intval($_GET['list_id']);
if(!$id) go('lists.php');
$query = "DELETE FROM `lists` WHERE `id` = '$id' LIMIT 1";
$result = _mysql_query($query);

$query = "DELETE FROM `lists_users` WHERE `list_id` = '$id' LIMIT 1";
$result = _mysql_query($query);
go('lists.php?deleted_list='.$id);

?>