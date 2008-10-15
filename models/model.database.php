<?php

$connect = mysql_connect( $mysql["host"], $mysql["user"], $mysql["password"] ) or die( mysql_error() );
mysql_select_db( $mysql["database"] ) or die( mysql_error() );


function db_query( $query ) {
	global $connect, $queries;
	
	$arguments = func_get_args(); // get an array of all the supplied arguments
	array_shift( $arguments ); // pop off the first argument, we already have it in $query
	
	if ( isset( $arguments[0] ) && ( is_array( $arguments[0] ) ) ) {
		$arguments = $arguments[0];
	}
	
	_db_query_callback( $arguments, TRUE );
	$query = preg_replace_callback( '/(%d|%s|%%|%f)/', '_db_query_callback', $query );
	
	$queries[] = $query;
	
	$result = mysql_query($query, $connect) or die( mysql_error() );
	
	return $result;
}

function _db_query_callback( $match, $init = FALSE ) {
	static $arguments = NULL;
	
	if ( $init ) {
		$arguments = $match;
		return;
	}
	
	switch ( $match[1] ) {
		case '%d':
			return (int) array_shift( $arguments );
		case '%s':
			return array_shift( $arguments ); // escape strings here later on
		case '%%':
			return '%';
		case '%f':
			return (float) array_shift( $arguments );
	}
}

function db_num_rows($table, $condition = "") {
	if ( $condition != "" ) $condition = " WHERE " . $condition;
	$result = db_query("SELECT count(*) FROM %s{$condition}");
	$row = mysql_fetch_row($result);
	return $row[0];
}

function db_record_exists($field, $table, $value) {
	global $connect;
	
	if ( !is_numeric($value) ) $value = "'".$value."'";
	
	$result = db_query("SELECT {$field} FROM {$table} WHERE {$field} = {$value} LIMIT 1");
	
	if ( mysql_num_rows($result) > 0 ) return true;
	else return false;
}

?>