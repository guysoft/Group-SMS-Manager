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
function db_save($db, $table) {
	if(isset($db['id']) && intval($db['id']) > 0) {
		$id = intval($db['id']);
		unset($db['id']);
		return db_update($db, $table, $id);
	} else {
		unset($db['id']);
		return db_insert($db, $table);
	}
}

function db_update($db, $table, $id) {
	$update_query = array();
	foreach($db as $field => $val) {
		$update_query[$field] = "`$field` = '".mysql_real_escape_string($val)."'";
	}
	$query = "UPDATE `$table` SET ".implode(", ", $update_query)." WHERE `id` = '".mysql_real_escape_string($id)."' LIMIT 1";
	$result = _mysql_query($query);
	if($result) return $id;
	return false;
}

function db_insert($db, $table) {
	$keys = array();
	$values = array();
	foreach($db as $key => $value) {
		$keys[] = mysql_real_escape_string($key);
		$values[] = mysql_real_escape_string($value);
	}
	$query = "INSERT INTO `$table` (`".implode("`, `", $keys)."`) VALUES ('".implode("', '", $values)."')";
	$result = _mysql_query($query);
	if($result) return mysql_insert_id();
}

function _mysql_query($query) {
	$result = mysql_query($query);
	if(!$result) { 
		if(ENV=='DEV') 
			die("Query: $query<br />Error: ".mysql_error());
		else return false;
	}
	return $result;
}

function db_get_id($id, $table) {
	$query = "SELECT * FROM `".mysql_real_escape_string($table)."` WHERE `id` = '".mysql_real_escape_string($id)."' LIMIT 1;";
	$result = _mysql_query($query);
	$ww = mysql_fetch_assoc($result);
	return $ww;
}

?>