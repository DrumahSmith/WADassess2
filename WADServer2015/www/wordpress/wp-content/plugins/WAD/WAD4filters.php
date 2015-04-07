<?php
/*
Plugin Name: WAD course - 4. Filter hooks
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This is plugin demonstrates some filtering hooks.
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
	12APR2013 - Added an example of custom markup without using shortcodes
	27JAN2014 - Fixed some minor bugs, added usage reference. Tested against WP3.8.1	
*/
/*-------------------------------------------------------------------------------------------
 * Filter hooks - http://codex.wordpress.org/Function_Reference/add_filter
 * 				- http://codex.wordpress.org/Plugin_API/Filter_Reference
 -------------------------------------------------------------------------------------------*/
 
//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}

 /*-------------------------------------------------------------------------------------------
applied to the post title retrieved from the database, prior to printing on the screen (also used in some other 	operations, such as trackbacks).
 */
//add the filter hook  onto the post title
add_filter( 'the_title', "WADfilterposttitle");
function WADfilterposttitle($title_content) {
	//wrap the post title in an H1 header before printing it on the page 
	$newtitle = '<h1>'.$title_content.'</h1>';
	return $newtitle;
}
 
/*-------------------------------------------------------------------------------------------
applied to the post content retrieved from the database, prior to printing on the screen (also used in some other operations, such as trackbacks).
	try adding any of the bad words below into a post
 */ 
//add the filter hook  onto the post content
add_filter( 'the_content', "WADfiltercontent");
function WADfiltercontent($post_content) {
	//array of some bad words
	$badlist= array("badword", "crap","poop");
	//replace all occurances of the badwords in the content of a post
	//NOTE: this is a simple search and replace. A more efficient algortihm should be used
	$newpost = str_replace($badlist, "****", $post_content);
	return $newpost;
}

/*-------------------------------------------------------------------------------------------
demonstration of creating your own markup that looks like a shortcode but behaves more like BBcode.
	try adding [[wp_my_test_markup]] into a post
 */ 
//add the filter hook  onto the post content
add_filter( 'the_content', "WADfiltermarkup");
function WADfiltermarkup($post_content) {

	//test for the occurance of our custom markup
    if (strpos($post_content, "[[wp_my_test_markup]]") !== FALSE)
    {
		$mymarkup = '<strong>THIS WAS INSERTED INTO THE CONTENT</strong>';
		//replace the markup with some of our own text
        $newpost = str_replace('[[wp_my_test_markup]]', $mymarkup, $post_content);
    }
    return $newpost;
}
?>