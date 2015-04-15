<?php
/**
 * Plugin Name: Assignment 2 Support Ticket
 * Plugin URI: http://localhost/
 * Description: Assignment 2, support ticket system for a help desk environment.
 * Version: 1.0
 * Author: Chris Smith, Matt Ross, Mark Powell
 * Author URI: http://eitonline.eit.ac.nz/course/view.php?id=72/
 * License: GPL2
 */

 $GC_dbversion = "0.1"; //current version of the database

//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}
 
//========================================================================================
//all the hooks used by our FAQ demo
register_activation_hook(__FILE__,'GC_install');
register_deactivation_hook( __FILE__, 'GC_uninstall' );
add_action('plugins_loaded', 'GC_update_db_check');
//add_action('plugin_action_links_'.plugin_basename(__FILE__), 'GCsettingslink' );  
//add_shortcode('displayfaq', 'GCdisplayfaq');
//add_action('admin_menu', 'GC_faq_menu');

//========================================================================================
//check to see if there is any update required for the database, 
//just in case we updated the plugin without reactivating it

function GC_update_db_check() {
	global $GC_dbversion;
	if (get_site_option('GC_dbversion') != $GC_dbversion) GC_install();   
}
 
 //========================================================================================
//hook for the install function - used to create our table for our simple FAQ
function GC_install () {
	global $wpdb;
	global $GC_dbversion;

	$currentversion = get_option( "GC_dbversion" ); //retrieve the version of FAQ database if it has been installed
	if ($GC_dbversion > $currentversion) {
		if($wpdb->get_var("show tables like 'GC_ticket'") != 'GC_ticket') {
	
			$sql = 'CREATE TABLE GC_ticket (
			
			id int(11) NOT NULL auto_increment,
			job_id int(11) NOT NULL,
			customer_name tinytext NOT NULL,
			technician_name tinytext NOT NULL,
			job_status int(11) NOT NULL,
			site_name tinytext NOT NULL,
			street tinytext NOT NULL,
			suburb tinytext NOT NULL,
			city tinytext NOT NULL,
			description text NOT NULL,
			contact_name tinytext NOT NULL,
			purchase_order_number int(11) NOT NULL,
			planned_start_date date NOT NULL,
			planned_finish_date date NOT NULL,
			site_contact_name tinytext NOT NULL,
			site_contact_phone int(11) NOT NULL,
			address tinytext NOT NULL,
			special_requests text NOT NULL,
			job_manager tinytext NOT NULL,
			date_completed date NOT NULL,
			compliance_certificate_required tinytext NOT NULL, 
			compliance_certificate_number int(11) NOT NULL,
			known_site_hazards text NOT NULL,
			glenn_cook_job_number int(11) NOT NULL,
			description_of_repair text NOT NULL,
			last_updated date NOT NULL,
			category tinytext NOT NULL,
			priority int(11) NOT NULL,
			attached_files tinytext NOT NULL,
			PRIMARY KEY (job_id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
			
		} 
		
		if($wpdb->get_var("show tables like 'GC_notes'") != 'GC_notes') {
	
			$sql = 'CREATE TABLE GC_notes (
			id int(11) NOT NULL auto_increment,
			customer_notes text NOT NULL,
			technician_notes text NOT NULL,
			fgn_job_id int(11) NOT NULL,
			PRIMARY KEY (id)
			FOREIGN KEY (fgn_job_id) REFERENCES GC_ticket(job_id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
			
		}
		if($wpdb->get_var("show tables like 'GC_accounts'") != 'GC_accounts') {
	
			$sql = 'CREATE TABLE GC_accounts (
			id int(11) NOT NULL auto_increment,
			
			/* Add fields for extra user info */
			
			fgn_user_id int(11) NOT NULL,
			PRIMARY KEY (id)
			FOREIGN KEY (fgn_user_id) REFERENCES wp_users(ID)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
		}
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			//update the version of the database with the new one
			update_option( "GC_dbversion", $GC_dbversion );
			add_option("GC_dbversion", $GC_dbversion);
	}
}

//========================================================================================
//clean up and remove any settings than may be left in the wp_options table from our plugin
function GC_uninstall() {
	delete_site_option($GC_dbversion);
	delete_option($GC_dbversion);
}

//========================================================================================
 
 ?>