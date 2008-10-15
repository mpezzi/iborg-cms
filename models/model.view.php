<?php

view_load();

// loads the appropriate view from a given url
function view_load() {
	global $connect, $config, $url, $page, $query, $error, $links;
	
	$page["url"] = strtolower( implode( "/", $url ) );
	$page["view"] = "";
	
	if ( strlen( $page["url"] ) < 1 ) { // No URL Path
		$page["url"] 	= $page["default view"];
		$page["title"] 	= $page["default title"];
		$page["view"] 	= $page["default view"];
	} else { // Has URL Path
		foreach ( $links as $link ) { // Check to find static views
			if ( $link["url"] == $page["url"] ) {
				$page["level"] 	= $link["level"];
				$page["title"] 	= $link["title"];
				$page["view"] 	= $link["view"];
			} 
		}
		
		if ( $url[0] == "login" ) { // Login Redirect
			$page["title"] = $page["default login title"];
			$page["view"] = $page["default login view"];
			if ( count($url) > 1 ) {
				message("You must be logged in to view this page.");
			}
		}
		
		if ( $page["view"] == "" ) { // Check to find dynamic view
			$match = false;
			
			//echo "<pre>\n";
			//echo "Checking for Dynamic view...\n";
			usort($links, "array_length_cmp");
			//echo print_r($links) . "\n";
			
			foreach ( $links as $link ) {
				$temp_url = $url;
				$temp_query = array();
				
				while ( count($temp_url) > 1 ) {
					array_push($temp_query, array_pop($temp_url));
						
					//echo "Checking... " . strtolower(implode("/", $temp_url)) . " against " . $link["url"] . "\n";
							
					if ( ( $link["url"] == strtolower(implode("/", $temp_url)) ) && !$match ) {
						$match = true;
						$page["title"] = $link["title"];
						$page["view"] = $link["view"];
						$page["level"] = $link["level"];
						$query = array_reverse($temp_query);
						//echo "MATCHED\n";
					}
				}
			}
			
			//echo print_r($query) . "\n";
			//echo $page["view"] . "\n";
			//echo "</pre>";
		}
		
		if ( $page["view"] == "" ) { // Error Page
			error("Sorry, that page doesn't exist.");
		}
	}
}

function array_length_cmp($a, $b) {
	$a = count(explode("/", $a["url"]));
	$b = count(explode("/", $b["url"]));
	
	if ( $a == $b ) return 0;
	return ( $a > $b ) ? -1 : 1;
}

?>