<?php

/* Swashbuckler MVC Content Manager, simple, useable, PHP content
      management system.
      Copyright (C) 2008
  
    Thomas Borzecki
    and Humber College DITC Web Design, Development & Maintenance
    class of Winter 2008
      This program is free software: you can redistribute it and/or modify
      it under the terms of the GNU General Public License as published by
      the Free Software Foundation, either version 3 of the License, or
      (at your option) any later version.
      This program is distributed in the hope that it will be useful,
      but WITHOUT ANY WARRANTY; without even the implied warranty of
      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
      GNU General Public License for more details.
      You should have received a copy of the GNU General Public License
      along with this program. If not, see http://www.gnu.org/licenses/.
  */

// Include the configuration file
include ( "models/model.config.php" );

if ( $config[ "testing" ] ) { // show all php errors
	ini_set( "display_errors", "stdout" );
	error_reporting( E_ALL );
} else { // show no php errors
	error_reporting( 0 );
}

// Load the controller we are using
include ( $config["controllers"] . "controller.php" );

?>