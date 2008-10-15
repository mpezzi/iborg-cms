<?php

url_load();
url_load_title();

// Loaded the url array with the path elements
function url_load() {
	global $url;
	
	$path = "";
	
	// Check if there are queries in the address
	if ( count( $_GET ) > 0 ) {
		list( $path, $dummy ) = each( $_GET );
	}
	
	$temp = explode( "/", $path );
	
	foreach ( $temp as $value ) {
		if ( strlen( $value ) > 0 ) {
			array_push( $url, $value );
		}
	}
}

// Set the title to the last element in the url
function url_load_title() {
	global $url, $page;
	
	if ( count( $url ) > 0 ) {
		$title = $url[ count($url) - 1 ];
		$title = str_replace( "_", " ", $title );
		$title = ucwords( $title );
		
		if ( !isset($page["title"]) ) {
			$page["title"] = $title;
		}
	} else {
		return false;
	}
}

?>