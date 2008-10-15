<?php

function filter( $filtered, $html_tags_allowed ) {
	global $connect;
	
	if ( !$html_tags_allowed ) {
		$filtered = strip_tags( $filtered );
		$filtered = htmlentities( $filtered );
	}
	
	$filtered = mysql_real_escape_string( $filtered, $connect );
	
	return $filtered;
}

function unfilter( $array ) {
	$unfiltered = array();
	
	// take everything out of the array, remove the slashes 
	foreach ( $array as $key => $value ) {
		$unfiltered[ $key ] = stripslashes( $value );
	}
	
	return $unfiltered;
}

?>