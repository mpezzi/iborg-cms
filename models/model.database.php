<?php

$connect = mysql_connect( $mysql["host"], $mysql["user"], $mysql["password"] ) or die( mysql_error() );
mysql_select_db( $mysql["database"] ) or die( mysql_error() );


// Idea based on Drupal's way of doing database business
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

// Paginated results
// Call pagination() in your view to show the pagination navigation
function db_query_paginate( $query ) {
	global $connect, $paginate, $queries;
	
	$arguments = func_get_args(); // get an array of all the supplied arguments
	array_shift( $arguments ); // pop off the first argument, we already have it in $query
	
	if ( isset( $arguments[0] ) && ( is_array( $arguments[0] ) ) ) {
		$arguments = $arguments[0];
	}
	
	_db_query_callback( $arguments, TRUE );
	$query = preg_replace_callback( '/(%d|%s|%%|%f)/', '_db_query_callback', $query );
	
	$query = str_replace("*", "COUNT(*)", $query);
	$queries[] = $query;
	
	paginate();
	
	$result = mysql_query($query, $connect) or die( mysql_error() );
	$total = mysql_fetch_row( $result );
	$paginate['total'] = $total[0];
	
	if ( $paginate['enabled'] ) {
		$query .= " LIMIT " . mysql_real_escape_string($paginate['page'] - 1) * $paginate['per_page'] . ", " . mysql_real_escape_string($paginate['per_page']);
	}
	
	$query = str_replace("COUNT(*)", "*", $query);
	
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
			return (int) mysql_real_escape_string( array_shift( $arguments ) );
		case '%s':
			return mysql_real_escape_string( array_shift( $arguments ) ); // escape strings here later on
		case '%%':
			return '%';
		case '%f':
			return (float) mysql_real_escape_string( array_shift( $arguments ) );
	}
}

function db_num_rows($table, $condition = "") {
	$condition = ( $condition != "" ) ? $condition : "";
	$temp = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM {$table}{$condition} LIMIT 1");
	$result = mysql_query("SELECT FOUND_ROWS()");
	$total = mysql_fetch_row($result);
	return $total[0];
}

function db_record_exists($field, $table, $value) {
	if ( !is_numeric($value) ) $value = "'".$value."'";
	$result = db_query("SELECT {$field} FROM {$table} WHERE {$field} = {$value} LIMIT 1");
	return ( mysql_num_rows($result) > 0 ) ? true : false;
}

?>