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
function debug($obj, $die = true) {
	if(!headers_sent()) { header('Content-Type: text/plain; charset: utf8;'); $br = "\n"; }
	else { echo '<pre>'; $br = "<br />"; }
	echo gettype($obj).$br;
	print_r($obj);
	if($die) die();
}

function go($url) {
	if(!headers_sent()) header('Location: '.$url);
	else echo '<script>window.location = "'.$url.'"</script>';
}
?>