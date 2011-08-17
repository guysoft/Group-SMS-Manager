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
//define('ENV', 'PROD');
//define('ENV', 'DEV');
//define('DB_HOST', ENV=='DEV' ? 'localhost' : 'localhost');
//define('DB_USER', ENV=='DEV' ? 'root' : 'root');
//define('DB_PASS', ENV=='DEV' ? 'root' : '');
//define('DB_NAME', ENV=='DEV' ? 'hamaavak' : 'maavak-sms');

define('ENV', 'DEV');
define('DB_HOST', 'localhost');
define('DB_USER', '');
define('DB_PASS',  '');
define('DB_NAME','maavak-sms');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Unable to connect to DB');
mysql_select_db(DB_NAME) or die('Unable to select DB');
mysql_query('SET NAMES utf8;');
//j14_sms
//140711)#
?>