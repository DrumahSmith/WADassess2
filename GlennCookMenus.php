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
    add_submenu_page('STmenu','Support Ticket System submenu one', 'Admin menu 1', 'manage_options' , 'STsubmenu1', 'STsubmenu1');	
    add_submenu_page('STmenu','Support Ticket System submenu two', 'Admin menu 2', 'manage_options' , 'STsubmenu2', 'STsubmenu2');	
    add_submenu_page('STmenu','Support Ticket System submenu one', 'Editor menu 1', 'publish_pages' , 'STsubmenu3', 'STsubmenu3');	
    add_submenu_page('STmenu','Support Ticket System submenu two', 'Editor menu 2', 'publish_pages' , 'STsubmenu4', 'STsubmenu4');	
    add_submenu_page('STmenu','Support Ticket System submenu one', 'User menu 1', 'read' , 'STsubmenu5', 'STsubmenu5');	
    add_submenu_page('STmenu','Support Ticket System submenu two', 'User menu 2', 'read' , 'STsubmenu6', 'STsubmenu6');	
	
	
//http://codex.wordpress.org/Function_Reference/add_options_page
//add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_options_page('WAD menu Options', 'WAD menu options', 'read', 'wadmenu', 'SToptionsmenu');

function STmenu() {
	echo '<h1>My Custom menu Page</h1>';
}

function SToptionsmenu() {
	echo '<h1>My Custom options menu Page</h1>';
}

function STsubmenu1() {
	echo '<h1>My Custom submenu page one with manage_options permissions</h1>';
}

function STsubmenu2() {
	echo '<h1>My Custom submenu page two with manage_options permissions</h1>';
}

function STsubmenu3() {
	echo '<h1>My Custom submenu page one with publish_pages permissions</h1>';
}

function STsubmenu4() {
	echo '<h1>My Custom submenu page two with publish_pages permissions</h1>';
}

function STsubmenu5() {
	echo '<h1>My Custom submenu page one with read permissions</h1>';
}

function STsubmenu6() {
	echo '<h1>My Custom submenu page two with read permissions</h1>';
}

?>