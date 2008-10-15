<?php

function navigation_item($item, $level = 0) {
	$output = "";
	
	if ( logged_in() ) {
		if ( $_SESSION["level"] >= $level && $level != -1 ) {
			$output = "<li>" . $item . "</li>\n";
		}
	} else if ( $level <= 0 ) {
		$output = "<li>" . $item . "</li>\n";
	}
	
	return $output;
}

?>