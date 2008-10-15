<?php

define("INPUT_TEXT", "text");
define("INPUT_PASSWORD", "password");
define("TEXTAREA", "textarea");

function form_required($message = "") {
	return "<em>* {$message}</em>";
}

function form_divider() {
	return "<div class=\"form-spacing\"></div>\n";
}

function form_row($type, $label, $name, $required = "no") {
	
	switch ( $type ) {
		case INPUT_TEXT:
			$field = input_text_tag($name);
			break;
		case INPUT_PASSWORD:
			$field = input_password_tag($name);
			break;
		case TEXTAREA:
			$field = textarea_tag($name);
			break;
		default:
			$field = input_text_tag($name);
			break;
	}
	
	( $required != "no" ) ? $required = form_required($required) : $required = "";
	return "<div class=\"form-row\"><label for=\"{$name}\">{$label}:</label>" . $field . $required . "</div>\n";
}

function form_submit($name, $align = "left") {
	return "<div style=\"clear: both; text-align: {$align}\">" . input_submit_tag($name) . "</div>\n";
}




function input_checkbox_tag( $label, $name, $checked = false ) {
	( $checked ) ? $checked_str = " checked=\"checked\"" : $checked_str = "";
	return "<input type=\"checkbox\"{$checked_str} id=\"{$name}\" name=\"{$name}\" /><label for=\"{$name}\">{$label}</label>";
}

function input_hidden_tag($name, $value = false) {
	( !$value ) ? $value = form($name) : null;
	return "<input type=\"hidden\" id=\"{$name}\" name=\"{$name}\" value=\"".$value."\" />";
}

function input_text_tag($name, $value = false) {
	( !$value ) ? $value = form($name) : null;
	return "<input type=\"text\" id=\"{$name}\" name=\"{$name}\" value=\"".$value."\" />";
}

function input_password_tag($name) {
	return "<input type=\"password\" id=\"{$name}\" name=\"{$name}\" value=\"\" />";
}

function input_submit_tag($name) {
	return "<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"{$name}\" />";
}

function textarea_tag($name, $cols = 50, $rows = 10) {
	return "<textarea name=\"{$name}\" id=\"{$name}\" cols=\"{$cols}\" rows=\"{$rows}\">" . form($name) . "</textarea>";
}

function option_tag( $id, $name, $selected = "" ) {
	( $selected != "" && $id == $selected ) $selected = " selected=\"selected\"" : $selected = "";	
	return "\t<option value=\"{$id}\"{$selected}>{$name}</option>\n";
}




?>