<?php
/*
Plugin Name: WAD course - 6. WP user handling
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This is plugin demonstrates how to access the WP user information.
Author: John Jamieson
Version: 1.1
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
	27JAN2014 - Fixed some minor bugs, added usage reference. Tested against WP3.8.1		
	
*/
/*-------------------------------------------------------------------------------------------
 * Get user metadata - http://codex.wordpress.org/Function_Reference/get_userdata		 
 * 					 - http://codex.wordpress.org/Function_Reference/get_currentuserinfo
 * User access testing - http://codex.wordpress.org/Roles_and_Capabilities
 *				 	   - http://codex.wordpress.org/Function_Reference/current_user_can

 -------------------------------------------------------------------------------------------*/
 
//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}

//------------------------------------------------------------------------- 
 add_action('admin_menu', 'WADusermenus');
 function WADusermenus() {	
	add_options_page('WAD user test', 'WAD user example', 'manage_options', 'wadusermenu', 'WADusertest');
}

//the following are examples of retrieving or gaining access to user information
//The WAD2hooks.php example demonstrates another user related function
function WADusertest() {

	global $current_user; //gain access to the wordpress user metadata variable
	get_currentuserinfo();	//refresh the current user metadata 

	
	echo '<h1>Find the current user metadata by using the "get_currentuserinfo" function .</h1>';		
	echo 'Username: ' . $current_user->user_login . '<br />';
	echo 'User email: ' . $current_user->user_email . '<br />';
	echo 'User first name: ' . $current_user->user_firstname . '<br />';
	echo 'User last name: ' . $current_user->user_lastname . '<br />';
	echo 'User display name: ' . $current_user->display_name . '<br />';
	echo 'User ID: ' . $current_user->ID . '<br />';				
}

//-------------------------------------------------------------------------
/*
  The following example demonstrates how user login information can be used outside of the dashboard area
*/
 add_shortcode('userauth','WADuserdemo');  
 
 function WADuserdemo() {
 
    $u = get_current_user_id();
	if ( $u == 0) echo '<h1>Public user</h1>';
	if ( $u == 1) echo '<h1>Admin user</h1>';
	if ( $u > 1) echo '<h1>Authenticated user</h1>';
	
	if (is_user_logged_in()) { //is the user authenticated - any user	
		echo "You are an authenticated user so you may access this information...";	
	} else
		echo "You need to be logged in to acces this information";	
 }
 
?>