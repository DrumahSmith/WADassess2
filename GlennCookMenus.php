<?php
/*
Plugin Name: Assignment 2 Menus
Plugin URI: http://localhost/
Description: Assignment 2, support ticket system for a help desk environment.
Author: Chris Smith, Matt Ross, Mark Powell
Version: 1.0
Author URI: http://eitonline.eit.ac.nz/course/view.php?id=72/
Last update: Monday, 13 April 2015
*/

//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}

//-----------------------------------------------------------------------------  
//Add the main dashboard menu hook
add_action('admin_menu', 'STadminmenus');

function STadminmenus() {
// http://codex.wordpress.org/Function_Reference/add_menu_page
//  add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );	
	add_menu_page('Support Ticket System', 'Support Ticket System', 'read','STmenu', 'STmenu','');
	
//http://codex.wordpress.org/Function_Reference/add_submenu_page
//http://codex.wordpress.org/Roles_and_Capabilities	
//  add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function ); 
    add_submenu_page('STmenu','Support Ticket System submenu one', 'Admin menu', 'manage_options' , 'STsubmenu1', 'STsubmenu1');		
    add_submenu_page('STmenu','Support Ticket System submenu one', 'Editor menu', 'publish_pages' , 'STsubmenu2', 'STsubmenu2');	
    add_submenu_page('STmenu','Support Ticket System submenu one', 'User menu', 'read' , 'STsubmenu3', 'STsubmenu3');	

function STmenu() {
	echo '<h1>My Custom menu Page</h1>';
}

function STsubmenu1() {
	echo '<h1>My Custom submenu page one with manage_options permissions</h1>';
}

function STsubmenu2() {
	echo '<h1>My Custom submenu page one with publish_pages permissions</h1>';
}

function STsubmenu3() {
	echo '<h1>My Custom submenu page one with read permissions</h1>';
}
}
?>