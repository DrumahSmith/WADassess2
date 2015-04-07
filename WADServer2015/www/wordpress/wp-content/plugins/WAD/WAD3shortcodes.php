<?php
/*
Plugin Name: WAD course - 3. Shortcodes
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This is plugin demonstrates some common wordpress hooks and actions.
Author: John Jamieson
Version: 1.2
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
	12APR2013 - Added demosntration code for calling annother plugin's shortcode
	27JAN2014 - Fixed some minor bugs, added usage reference. Tested against WP3.8.1	
*/
/*-------------------------------------------------------------------------
 * Shortcode hooks - http://codex.wordpress.org/Function_Reference/add_shortcode
 * 				   - http://codex.wordpress.org/Function_Reference/shortcode_atts
 -------------------------------------------------------------------------*/
 
 //simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}

//-------------------------------------------------------------------------
 /*
  A shortcode without any parameters
 Insert [datetoday] into a post.
 */
add_shortcode('datetoday','WADdatesc');
function WADdatesc() {
	$today = date("F j, Y, g:i a");
	echo "<H1>$today</H1><br /><br />";
}

//-------------------------------------------------------------------------
 /*
  A shortcode with some parameters
 Insert [scparamtest param1=ABC param2=DEF] into a post.
 */
add_shortcode('scparamtest','WADscparamtest');
function WADscparamtest($shortcodeattributes) {
//example of more than one attribute passed through a shortcode
//extract — Import variables into the current symbol table from an array
	extract(shortcode_atts(array('param1' => '-', 'param2' => '-'), $shortcodeattributes));	

	echo '<h1>Shortcode parameter test</h1>';
	echo '<ul><li> Parameter 1 '.$param1.'</li>';
	echo '<li> Parameter 2 '.$param2.'</li></ul>';		
}

//-------------------------------------------------------------------------
 /*
  A shortcode demonstrating how another plugin's shortcode can be called from your plugin
  Insert [sctestother] into a post.
 */
add_shortcode('sctestother','WADsctestother');
function WADsctestother() {
//first test to see if the functions/class from the 3rd party plugin do exist - they wont exist
//if the plugin has not been activated or installed into wordpress
//http://wordpress.org/plugins/nice-paypal-button-lite/
	if (function_exists('NicePayPalButtonLite') or class_exists('NicePayPalButtonLite')) {
		echo do_shortcode('[nicepaypallite name="Random donation" amount="1.00"]');
	} else {
	  echo 'WARNING: Install and activate the "Nice PayPal Button Lite" wordpress plugin before trying to use this shortcode';
	}
}
?>