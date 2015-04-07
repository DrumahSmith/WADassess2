<?php
/*
Plugin Name: WAD course - 5. plugin settings & options
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This is plugin demonstrates some how to save plugin settings and options into the database - browse the wp_options table.
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
 * Plugin options
				   - http://codex.wordpress.org/Options_API
 				   - http://codex.wordpress.org/Settings_API
 -------------------------------------------------------------------------------------------*/
 
//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}
 
 /*-------------------------------------------------------------------------------------------
applied to the post title retrieved from the database, prior to printing on the screen (also used in some other 	operations, such as trackbacks).
 */
 add_action('admin_menu', 'WADpluginoptionspage');
function WADpluginoptionspage() {
	add_options_page('WAD options Page', 'WAD options', 'manage_options', 'WADpluginoptions', 'WADpluginoptionsform');
}

// display the admin options page
function WADpluginoptionsform() {
		echo '<form action="options.php" method="post">';

//http://codex.wordpress.org/Function_Reference/settings_fields		
		settings_fields('WADplugin_options'); 		
//http://codex.wordpress.org/Function_Reference/do_settings_sections		
		do_settings_sections('WADplugin5');
		
		echo '<input name="Submit" type="submit" value="Save Changes" /></form>';
}

//-------------------------------------------------------------------------------------------
add_action('plugin_action_links_'.plugin_basename(__FILE__), 'WADsettingslink' );  
// Add settings link on plugin page
function WADsettingslink($links) { 
//http://codex.wordpress.org/Function_Reference/admin_url
  array_unshift($links, '<a href="'.admin_url('options-general.php?page=WADpluginoptions').'">Settings</a>'); 
  return $links; 
}

//-------------------------------------------------------------------------------------------
add_action( 'admin_init', 'WADsetdefaults' );
function WADsetdefaults($title_content) {

//http://codex.wordpress.org/Function_Reference/register_setting
	register_setting( 'WADplugin_options', 'WADplugin_options','WADoptionsvalidate');
//http://codex.wordpress.org/Function_Reference/add_settings_section/
	add_settings_section('WADplugin_main', 'Main Settings', 'WADpluginsectiontext', 'WADplugin5');
//http://codex.wordpress.org/Function_Reference/add_settings_field	
	add_settings_field('WADplugintextone', 'Plugin option one',   'WADpluginsettings', 'WADplugin5', 'WADplugin_main',array('id'=>'one'));
	add_settings_field('WADplugintexttwo', 'Plugin option two',   'WADpluginsettings', 'WADplugin5', 'WADplugin_main',array('id'=>'two'));
	add_settings_field('WADplugintextthree', 'Plugin option three', 'WADpluginsettings', 'WADplugin5', 'WADplugin_main',array('id'=>'three'));
}

 function WADpluginsectiontext() {
	echo '<p>Main description of this options section goes here.</p>';
} 

//display the options form for each of the options - this is a consolidated function to reduce duplication. individual functions can be created for each option
function WADpluginsettings($args) {
//http://codex.wordpress.org/Function_Reference/get_option	
	$options = get_option('WADplugin_options');
	switch($args['id']) {
		case 'one': echo "<input id='WADplugintextone' name='WADplugin_options[text_one]' size='40' type='text' value='{$options['text_one']}' />";
				break;
		case 'two': echo "<input id='WADplugintexttwo' name='WADplugin_options[text_two]' size='40' type='text' value='{$options['text_two']}' />";
				break;
		case 'three': echo "<input id='WADplugintextthree' name='WADplugin_options[text_three]' size='40' type='text' value='{$options['text_three']}' />";
				break;			
	}	
}

//this function iterates through the options an performs some minor testing/error checking
function WADoptionsvalidate($input) {
//the following array reference assumes you are using the manual provided with the EIT uniformserver distribution
//http://localhost/phpmanual/ref.array.html
	$newinput = array(); //empty array
	
//##using a foreach to iterate through an array	
	foreach ($input as $k => $ni) {
		$ni = trim($ni); //remove whitespace
		if (empty($ni)) $ni = '-'; //set a default if it is empty
		$newinput[$k] = $ni; //store the new value into a new array using the original key from the original array	
	}
/*
//## using a while loop to iterate through an array
	while ($ni = current($input)) { //get the current array element and loop until end of the array
		$ni = trim($ni); //remove whitespace
		if (empty($ni)) $ni = '-'; //set a default if it is empty
		$k = key($input); //get the key for the element
		$newinput[$k] = $ni; //store the new value into a new array using the original key from the original array
		next($input); //step to the next element in the array
	}
*/	
	return $input;
}
?>
