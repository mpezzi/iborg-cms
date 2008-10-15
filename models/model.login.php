<?php

// Logs in a user
function login($email, $password) {
	global $connect, $mysql;
	
	$logged_in = false;
	
	$result = db_query("SELECT * FROM %s WHERE email = '%s' LIMIT 1", $mysql["users"], $email);
	
	if ( mysql_num_rows($result) > 0 ) {
		$row = mysql_fetch_assoc($result);
		
		if ( strcmp( md5($password), $row["password"] ) == 0 ) {
			$_SESSION["email"] = $row["email"];
			$_SESSION["first_name"] = $row["first_name"];
			$_SESSION["last_name"] = $row["last_name"];
			$_SESSION["level"] = $row["level"];
			$_SESSION["id"] = $row["id"];
			
			$logged_in = true;
		} else {
			message("The password you entered is incorrect.");
		}
	} else {
		message("The email address you entered does not exist.");
	}
	
	return $logged_in;
}

// Logs out a user
function logout() {
	unset($_SESSION["email"]);
	unset($_SESSION["first_name"]);
	unset($_SESSION["last_name"]);
	unset($_SESSION["level"]);
	unset($_SESSION["id"]);
	unset($_SESSION["terms-accepted"]);
}

function authenticate() {
	global $page;
	
	if ( $page["level"] > 0 ) {
		if ( isset($_SESSION["level"]) ) {
			if ( $page["level"] <= $_SESSION["level"] ) {
				// do nothing
			} else {
				error("You don't have permission to view this page.");
			}
		} else {
			//redirect("login/".$page["url"]);
			redirect("user/terms");
		}
	}
}


function logged_in() {
	return ( isset($_SESSION['level']) ) ? true : false;
}

function admin() {
	return ( logged_in() && $_SESSION['level'] == ACCESS_ADMIN ) ? true : false;
}
?>