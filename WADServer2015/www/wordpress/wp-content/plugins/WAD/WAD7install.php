<?php
/*
Plugin Name: WAD course - 7. Activation and deactivation
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This is plugin demonstrates how to setup the activation and deactivation procedures for installing and uninstalling your plugin.
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
 * Activation hooks - http://codex.wordpress.org/Function_Reference/register_activation_hook
				   - http://codex.wordpress.org/Function_Reference/register_deactivation_hook
				   - http://codex.wordpress.org/Function_Reference/register_uninstall_hook
				   - http://codex.wordpress.org/Managing_Plugins
 -------------------------------------------------------------------------------------------*/
//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}
 
//-------------------------------------------------------------------------  
$WAD_db_version  = 1.0 //current version of our plugin database in this current plugin NOT the installed plugin

register_activation_hook( __FILE__, 'WADactivate' );
register_deactivation_hook( __FILE__, 'WADdeactivate' );

//set some default options on plugin activation
function WADactivate() {
//update or create any options our plugin may need after it has been isntalled
//------------
//http://codex.wordpress.org/Function_Reference/update_option
//http://codex.wordpress.org/Function_Reference/get_option
//http://codex.wordpress.org/Function_Reference/add_option
/*
	if ( get_option( $option_name ) != $new_value ) {
		update_option( $option_name, $new_value );
	} else {
		add_option( $option_name, $new_value);
	}
*/
//update or add any tables that are required by our plugin
//----------
	global $wpdb; //access the wordpress database
	global $pidb_version; //plugin database version
	$installed_ver = get_option( "WAD_db_version" );
/*
	if ($installed_ver < $WAD_db_version) { //does it need upgrading
		$sql = '';
		if($wpdb->get_var("show tables like 'table1'") != 'table1'   {
			$sql = "...1st CREATE TABLE query..... "; //SQL for the rest of our create table query
		if($wpdb->get_var("show tables like 'table2'") != 'table1'   {
			$sql .= "....2nd CREATE TABLE query...";
		if($wpdb->get_var("show tables like 'tableN'") != 'tableN'   {
			$sql .= "...Nth CREATE TABLE query..."
*/			
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); //used for the dbDelta update function
		if (!empty($sql) dbDelta($sql); //perform the DB update process
//update the database version number wonce we have created/updated the database for the plugin
//----------      
		update_option( "WAD_db_version", $WAD_db_version ); //update the database if it exists
		add_option("WAD_db_version", $WAD_db_version); //add the option of it does not already exist
	}

}

//------------------------------------------------------------------------- 
//clean up and remove any settings than may be left in the wp_options table from our plugin
function WADdeactivate() {
//http://codex.wordpress.org/Function_Reference/delete_option
//http://codex.wordpress.org/Function_Reference/delete_site_option
/*	
	delete_site_option( $option_name1 );
	delete_option( $option_name1 );
	delete_option( $option_name2 );
	delete_option( $option_nameN );
*/	
}

?> 