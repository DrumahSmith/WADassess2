<?php
/*
Plugin Name: WAD course - 1. Menus
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This is plugin demonstrates some wordpress admin/dashboard menus and how to link into the dashboard menu hook.
Author: John Jamieson
Version: 1.3
Author URI: http://http://eitonline.eit.ac.nz/course/view.php?id=72/
Last update: 27 January 2014
*/

/* DEBUGGING NOTE
 * Change the line 81 of the wp-config.php file in the Wordpress root folder
 * from 	define('WP_DEBUG', false);
 * to		define('WP_DEBUG', true);
 * This will enable the debugging and any error messages.
*/
/* CHANGELOG
	05APR2013 - Initial release.
	12APR2013 - Added in menu type for non admin type users - roles 'manage-options','read','publish_pages'
	25APR2013 - Added individual functions for each of the submenus and unique menu stubs
	27JAN2014 - Fixed some minor bugs, added usage reference. Tested against WP3.8.1

*/
/*-------------------------------------------------------------------------
 * Dashboard menus - http://codex.wordpress.org/Administration_Menus
 *				   - http://codex.wordpress.org/Function_Reference/add_menu_page 
 *				   - http://codex.wordpress.org/Function_Reference/add_submenu_page 
 * 				   - http://codex.wordpress.org/Plugin_API/Action_Reference/admin_init 
 *				   - http://codex.wordpress.org/Roles_and_Capabilities
 -------------------------------------------------------------------------*/

//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}

//-----------------------------------------------------------------------------  
//Add the main dashboard menu hook
add_action('admin_menu', 'WADadminmenus');

function WADadminmenus() {
// http://codex.wordpress.org/Function_Reference/add_menu_page
//  add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );	
	add_menu_page('WAD Demo Menu', 'WAD Demo Menu 2015', 'read','WADmenu', 'WADmenu','');
	
//http://codex.wordpress.org/Function_Reference/add_submenu_page
//http://codex.wordpress.org/Roles_and_Capabilities	
//  add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function ); 
    add_submenu_page('WADmenu','WAD submenu one', 'Admin menu 1', 'manage_options' , 'WADsubmenu1', 'WADsubmenu1');	
    add_submenu_page('WADmenu','WAD submenu two', 'Admin menu 2', 'manage_options' , 'WADsubmenu2', 'WADsubmenu2');	
    add_submenu_page('WADmenu','WAD submenu one', 'Editor menu 1', 'publish_pages' , 'WADsubmenu3', 'WADsubmenu3');	
    add_submenu_page('WADmenu','WAD submenu two', 'Editor menu 2', 'publish_pages' , 'WADsubmenu4', 'WADsubmenu4');	
    add_submenu_page('WADmenu','WAD submenu one', 'User menu 1', 'read' , 'WADsubmenu5', 'WADsubmenu5');	
    add_submenu_page('WADmenu','WAD submenu two', 'User menu 2', 'read' , 'WADsubmenu6', 'WADsubmenu6');	
	
	
//http://codex.wordpress.org/Function_Reference/add_options_page
//add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_options_page('WAD menu Options', 'WAD menu options', 'read', 'wadmenu', 'WADoptionsmenu');
	
//http://codex.wordpress.org/Function_Reference/add_dashboard_page	
//add_dashboard_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_dashboard_page('WAD dashboard', 'WAD dashboard', 'read', 'wadmenu', 'WADdashboardmenu');
	
}

function WADmenu() {
	echo '<h1>My Custom menu Page</h1>';
}
function WADoptionsmenu() {
	echo '<h1>My Custom options menu Page</h1>';
}

function WADdashboardmenu() {
	echo '<h1>My Custom dashboard menu Page</h1>';
}

function WADsubmenu1() {
	echo '<h1>My Custom submenu page one with manage_options permissions</h1>';
}
function WADsubmenu2() {
	echo '<h1>My Custom submenu page two with manage_options permissions</h1>';
}
function WADsubmenu3() {
	echo '<h1>My Custom submenu page one with publish_pages permissions</h1>';
}
function WADsubmenu4() {
	echo '<h1>My Custom submenu page two with publish_pages permissions</h1>';
}
function WADsubmenu5() {
	echo '<h1>My Custom submenu page one with read permissions</h1>';
}
function WADsubmenu6() {
	echo '<h1>My Custom submenu page two with read permissions</h1>';
}?>