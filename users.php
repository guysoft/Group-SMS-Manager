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
$title = "רשימת משתמשים";
$query = "SELECT * FROM `users` ORDER BY `name`";
$result = _mysql_query($query);
$users = array();
while($ww = mysql_fetch_assoc($result)) $users[$ww['id']] = $ww;

include('users.tpl');

?>