<?php
/*
Plugin Name: WAD course - 2. Action hooks
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This is plugin demonstrates some common wordpress hooks and actions.
Author: John Jamieson
Version: 1.1
Author URI: http://http://eitonline.eit.ac.nz/course/view.php?id=72/
Last update: 27 January 2014
*/

/* DEBUGGING NOTE
 * Change the line 81 of the wp-config.php file in the Wordpress root folder
 * from 	define('WP_DEBUG', false);
 * to		define('WP_DEBUG', true);
 * This will enable the debugginG and any error messages.
*/
/* CHANGELOG
	05APR2013 - Initial release.
	27JAN2014 - Fixed some minor bugs, added usage reference. Tested against WP3.8.1

*/
/*-------------------------------------------------------------------------
 * Action hooks - http://codex.wordpress.org/Function_Reference/add_action
 *				- http://codex.wordpress.org/Plugin_API/Action_Reference
 -------------------------------------------------------------------------*/
 
 
 //simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}

//----------------------------------------------------------------------------- 
 /* This action is used to add extra submenus and menu options to the admin panel's menu structure. It runs after the basic admin panel menu structure is in place.
*/
//http://codex.wordpress.org/Plugin_API/Action_Reference/admin_menu
//add_action( $hook, $function_to_add, $priority, $accepted_args );
add_action('admin_menu', 'WADadminmenuhook');
function WADadminmenuhook() {
//http://codex.wordpress.org/Function_Reference/add_options_page
	add_options_page('WAD menu hook', 'WAD menu hook', 'manage_options', 'wadmenu', 'WADmenuhook');
}

function WADmenuhook() {
	echo '<h1>My Custom options page menu hook</h1>';
}

//-------------------------------------------------------------------------
//admin_init is triggered before any other hook when a user accesses the admin area. 
//http://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
add_action('admin_init','WADrestricthook', 1 );
function WADrestricthook(){
	//if not administrator, kill WordPress execution and provide a message
	//http://codex.wordpress.org/Function_Reference/current_user_can
	if (!current_user_can('manage_options')) {
		wp_die('You are not allowed to access this part of the site');
	}
}

//-------------------------------------------------------------------------
/*Runs when the template calls the wp_head() function. 
 This hook is generally placed near the top of a page template between <head> and </head>. 
 This hook does not take any parameters. */
//http://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
add_action('wp_head','WADheaderhook');
function WADheaderhook() {
	echo '<h1>My Custom wordpress header hook</h1>';
}

//-------------------------------------------------------------------------
/*Runs after the admin menu is printed to screens that aren't network- or user-admin screens.*/
//http://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
add_action('admin_notices','WADadminnoticeshook');
function WADadminnoticeshook() {
	echo '<h1>My Custom admin dashboard notices hook</h1>';
}

//-------------------------------------------------------------------------
/*Runs after the admin menu is printed to screens that aren't network- or user-admin screens.*/
//http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
add_action( 'admin_head', 'WADadminheadhook' );
function WADadminheadhook() {
	echo '<h1>My Custom admin dashboard admin header hook</h1>';
}

?>