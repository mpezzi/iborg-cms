<?php

function meta_tag($name, $content) {
	return "<meta name=\"{$name}\" content=\"{$content}\" />\n";
}

function stylesheet_tag($file) {
	global $config;
	return "<style type\"text/css\">@import \"{$config["css"]}{$file}\";</style>\n";
}

function javascript_tag($file) {
	global $config;
	return "<script type=\"text/javascript\" src=\"{$config["js"]}{$file}\"></script>\n";
}

function title_tag() {
	global $page, $config;
	return "<title>{$config["name"]} - {$page["title"]}</title>\n";
}

function a_tag( $link, $name ) {
	global $config;
	return "<a href=\"{$config["url"]}{$link}\">{$name}</a>";
}

function ul_tag( $items ) {
	ob_start();
	
	echo "\n\t<ul>\n";
	
	foreach ( $items as $item ) {
		echo "\t\t<li>{$item}</li>\n";
	}
	
	echo "\t</ul>\n\n";
	
	return ob_get_clean();
}




function login_link_tag() {
	return ( logged_in() ) ? a_tag("logout", "Logout") : a_tag("login", "Sign In");
}

function messages_tag() {
	global $message;
	return ( count($message) > 0 ) ? "<div id=\"message\">".ul_tag($message)."</div>\n\n" : false;
}

?>