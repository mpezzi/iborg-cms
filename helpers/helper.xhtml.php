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

function pagination() {
	global $config, $page, $paginate;
	
	ob_start();
	
	$pages = array();
	
	if ( $paginate['enabled'] ) {
		$num_pages = ceil( $paginate['total'] / $paginate['per_page'] );
		
		if ( $paginate['page'] != 1 ) {
			$pages[] = a_tag($page['url']."&page=". ($paginate['page'] - 1) ."&per_page=".$paginate['per_page'], "&laquo; Prev");
		}
		
		for ($i=1;$i<=$num_pages;$i++) {
			$pages[] = a_tag($page['url'] . "&page=" . $i . "&per_page=" . $paginate['per_page'], $i);
		}
		
		if ( $paginate['page'] != $num_pages ) {
			$pages[] = a_tag($page['url']."&page=". ($paginate['page'] + 1) ."&per_page=".$paginate['per_page'], "Next &raquo;");
		}
		
		echo "<div class=\"pagination clear\">\n";
		echo ul_tag($pages);
		echo "</div>\n";
		
		echo "Pages: " . floor( $paginate['total'] / $paginate['per_page'] ) . "<br />\n";
		echo "Total: " . $paginate['total'];
	}
	
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