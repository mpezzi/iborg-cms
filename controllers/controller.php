<?php

session_set_cookie_params( $config[ "session cookie lifetime" ] );
session_start();
session_regenerate_id();


$url = array();
$page = array();
$links = array();
$query = array();
$form = array();
$error = array();
$queries = array();
$message = array();


// Default Views
$page["level"]					= 0;

$page["default title"]			= "Welcome";
$page["default view"]			= "default";

$page["default error title"]	= "Whoops!";
$page["default error view"] 	= "error";

$page["default login title"]	= "Sign in";
$page["default login view"]		= "login";


// Include General Functions
include_once ( $config["models"] . "model.controller.php" );
include_once ( model( "database" ) );
include_once ( model( "url" ) );
include_once ( model( "filter" ) );
include_once ( model( "form" ) );
include_once ( model( "login" ) );
include_once ( controller() );

?>