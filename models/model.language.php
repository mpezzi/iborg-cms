<?php

// Languages to translate
define("FRENCH", "fr");
define("ENGLISH","en");

$lang = ( isset($_GET['lang']) && $_GET['lang'] == FRENCH ) ? FRENCH : ENGLISH;

$translation = array( ENGLISH => array(), FRENCH => array() );

// Adds a translation to the translation array
function trans($id, $english, $french = "") {
	global $translation;
	
	if ( $french == "" ) {
		$french = $english;
		$english = $id;
	}
	
	$translation['en'][$id] = $english;
	$translation['fr'][$id] = $french;
}

// Outputs translations depending on $lang
function t($content) {
	global $lang, $translation;
	return ( isset( $translation[$lang][$content] ) ) ? $translation[$lang][$content] : $content;
}



//----------------------------------
// Translation Definitions Examples
//----------------------------------
// Not really sure if this stuff should go here, maybe in a specific controller.

// Short Translations
trans('Hello', 'Bonjour');
trans('Goodbye', 'Au revoir');
trans('Do it live', 'Font il de phase');

// Long Translations
trans('lorem',					'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
								'Lorem ipsum in french blah blah blah...');
								
/*

Usage:

t('Hello') will return Hello or Bonjour depending on $_GET['lang'] or $lang is set to 'en' or 'fr'
t('lorem') will return Lorem ipsum in english or french depending on $_GET['lang'] or $lang

*/								

?>