<?php

new_action("Login", ACCESS_ANON, "login");
new_action("Logout?", ACCESS_ANON, "logout");
new_action("Announcements", ACCESS_ANON, "announcements");
new_action("FAQ", ACCESS_ANON, "faq");


include_once( model( "view" ) );
include_once( helper( "xhtml" ) );


if ( isset($form["submit"]) ) {
	switch ( strtolower($form["submit"]) ) {
		case "sign in":
			if ( login($form["email"], $form["password"]) ) {
				if ( $form["redirect"] != "" ) redirect($form["redirect"]);
				$page["title"] = $page["default title"];
				$page["view"] = $page["default view"];
			}
		
			break;
		case "yup": // Logout a user
			logout();
			
			redirect();
			
			break;
	}
}

echo render();

?>