<?php

$exclude = array(".", "..", "controller.php");

// Builds a path to a view
function view( $view ) {
	global $config;
	$file = $config[ "views" ] . "view." . $view . ".php";
	
	if( file_exists( $file ) ) {
		debug( "Loading {$file}" );
		return $file;
	} else {
		debug( "Can't Load {$file}" );
		return false;
	}
}


// Builds a path to a model
function model( $model ) {
	global $config;
	$file = $config[ "models" ] . "model." . $model . ".php";
	
	if( file_exists( $file ) ) {
		debug( "Loading {$file}" );
		return $file;
	} else {
		debug( "Can't Load {$file}" );
		return false;
	}
}


// Builds a path to a helper
function helper( $helper ) {
	global $config;
	$file = $config[ "helpers" ] . "helper." . $helper . ".php";
	
	if( file_exists( $file ) ) {
		debug( "Loading {$file}" );
		return $file;
	} else {
		debug( "Can't Load {$file}" );
		return false;
	}
}


// Builds a path to a controller
function controller() {
	global $config, $url, $exclude;
	
	$file = "";
	$found = false;
	
	if ( isset($url[0]) ) {
		$controllers = scandir($config["controllers"]);
	
		foreach ( $controllers as $controller ) {
			if ( !array_search($controller, $exclude) && $controller != "." ) {
				$name = split("[.]", $controller);
				
				if ( $name[1] == $url[0] ) {
					$file = $config[ "controllers" ] . $controller;
					$found = true;
				}
			}
		}
	}
	
	if ( !$found ) {
		$file = $config[ "controllers" ] . "controller.main.php";
	}
	
	debug( "Loading {$file}" );
	
	return $file;
}

// Creates a new action
function new_action($title, $level, $url, $view = "") {
	global $links;
	if ( $view == "" ) $view = implode(".", explode("/", $url));
	$links[] = array("view" => $view, "url" => $url, "title" => $title, "level" => $level);
}


// Displays a debug message
function debug( $message ) {
	global $config;
	
	if ( $config[ "debug" ] ) {
		//echo "<div style=\"background: #464646; padding: 2px 6px; font-size: 12px; color: #dadada; font-weight: bold;\">[debug message: {$message}]</div>";
	}
}

// Displays a error message
function error( $message ) {
	global $page, $config, $error;
	
	$page["view"] 	= $page["default error view"];
	$page["title"] 	= $page["default error title"];
	$page["level"] 	= "public";
	
	array_push( $error, $message );
}

function message( $text ) {
	global $message;
	
	array_push($message, $text);
}

function no_messages() {
	global $message;
	return ( count($message) == 0 ) ? true : false;
}


// Renders the final page
function render() {
	global $page, $config, $error, $url, $site, $form, $query, $queries, $mysql;
	
	//echo view( $page[ "view" ] );
	
	ob_start();
	
	if( view( $page[ "view" ] ) ) {
		include_once( view( $page[ "view" ] ) );
	} else {
		die( "Rendering error" );
	}
	
	return ob_get_clean();
}

// Redirects to a url
function redirect($url = "") {
	global $config;
	
	header("Location: " . $config["url"] . $url);
}

function paginate($page_num = "", $per_page = "") {
	global $paginate;
	
	$default_page_num = ( $page_num == "" ) ? 1 : $page_num;
	$default_per_page = ( $per_page == "" ) ? $paginate['default per_page'] : $per_page;
	
	$paginate['enabled'] = true;
	$paginate['per_page'] = ( isset($_GET['per_page']) && is_numeric($_GET['per_page']) ) ? $_GET['per_page'] : $default_per_page;
	$paginate['page'] = ( isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : $default_page_num;
}

?>