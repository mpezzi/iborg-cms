<?php



// General Settings

$config = array();

// Is this a testing server?
$config[ "testing" ] 					= true;
$config[ "debug" ]						= true;


$config["name"] 						= "iBorg-CMS";

$config["url"]							= "";

// Email address which is used to send out payment information
$config["email_to"]						= "";
$config["email_from"]					= "";

$config["index"]						= "index.php?";

$config["css"]							= "";
$config["js"]							= "";

$config["controllers"]					= "controllers/";
$config["models"]						= "models/";
$config["helpers"]						= "helpers/";
$config["views"]						= "views/";

// Session Settings
$config["session cookie lifetime"]		= 10000;

// User Levels
define("ACCESS_ANON", 0);
define("ACCESS_AUTH", 1);
define("ACCESS_ADMIN", 2);


// MySQL Settings

$mysql = array();

$mysql["host"] 				= "";
$mysql["user"] 				= "";
$mysql["password"] 			= "";
$mysql["database"] 			= "";

// Tables
$mysql["users"] 			= "users";
$mysql["results"]	 		= "results";
$mysql["colours"] 			= "colours";



// Pagination Settings
$paginate = array();

$paginate['enabled'] = false; // Pagination is off by default, you can turn it on when needed by using paginate() in your view;
$paginate['default per_page'] = 20;

?>