<?php
/*
Plugin Name: WAD course - 11. Frontend multipages
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This plugin demonstrates a frontend multipage example. 
Author: John Jamieson
Version: 1.2
Author URI: http://http://eitonline.eit.ac.nz/course/view.php?id=72/
Last update: 01 April 2015
*/

/* DEBUGGING NOTE
 * Change the line 81 of the wp-config.php file in the Wordpress root folder
 * from 	define('WP_DEBUG', false);
 * to		define('WP_DEBUG', true);
 * This will enable the debugging and any error messages.
*/
/* CHANGELOG
	17MAY2014 - Initial release.
	01APR2015 - fixed some bugs and removed redundant code. Enhanced the multipage demo
		
*/
/*-------------------------------------------------------------------------------------------
 * Wordpress globals - http://codex.wordpress.org/User:CharlesClarkson/Global_Variables
 * 					 - http://codex.wordpress.org/Function_Reference
 * Database object - http://codex.wordpress.org/Class_Reference/wpdb
 * 				   - http://codex.wordpress.org/Database_Description
 * Include JS/CSS  - http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 
 -------------------------------------------------------------------------------------------*/
//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>Diagnostics: '; var_dump($var); echo '</pre>';}
}

//========================================================================================
//just display a list of the records in the database
// this assumes the WAD11.sql has been preloaded
function WADlistrecs($filterletter='A') {
    global $wpdb, $page_id;

	//grab all the FAQS from the database
	//example of a crafted query
    $query  = "SELECT * FROM wad_test11 "; //<-- note the extra space before closing the quotes
	$query .= "WHERE names LIKE '".$filterletter."%' ";//<-- note the extra space before closing the quotes
	$query .= "ORDER BY names";
    $allrecs = $wpdb->get_results($query);
	
    $buffer = '<hr /><table>';
    foreach ($allrecs as $rec) {
		$buffer .= '<tr><td>'.$rec->names.'</td><td>'.$rec->email.'</td><td>'.$rec->datum.'</td>';
		$buffer .= '<td><a href="?page_id='.$page_id.'&cmd=second&bid='.$rec->id.'">Select</a></td></tr>';	
    }
    $buffer .= '</table>';
    echo $buffer;
}

//-------------------------------------------------------------------
function WAD_firstpage() {
	global $page_id; //required to determine the currently active page

	$alphabet = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'); //convert the string to an array of letters
	
//display an alphabet selection for the filtering
	echo '<h2>Select a letter...<br>';
	foreach ($alphabet as $key => $value) { //example of getting the key and not just the value
		//the $alphabet array should have integer keys as in a traditional array - this lets us test for a position
		if ($key == 13) echo '<br>'; //check if half way, at letter M, then start a new line
		echo '<a href="?page_id='.$page_id.'&filterletter='.$value.'"> '.$value.'</a>';
	}
	echo '</h2>';
	
	//grab the filtering letter if its available else default to 'A'
	if (isset($_GET['filterletter']))
		$filterletter = $_GET['filterletter'];
	else  
		$filterletter = 'A';	
	echo '<h2>First: Listing/Browse state</h2>';
	WADlistrecs($filterletter);
}
//-------------------------------------------------------------------
function WAD_secondpage($bid) {
	global $wpdb, $page_id;
		
	$query = 'SELECT * FROM wad_test11 WHERE id='.$bid;
    $rec = $wpdb->get_row($query);
	echo '<h2>Second: Selection/Modify/Checkout state</h2>';
	
	echo '
		<form name="WADform" method="post" action="?page_id='.$page_id.'&cmd=third">
		<input  type="hidden" name="bid" value="'.$bid.'"/>
		<input  type="hidden" name="names" value="'.$rec->names.'"/>
		<input  type="hidden" name="address" value="'.$rec->address.'"/>
		<p>Name: '.$rec->names.' <br />Address: '.$rec->address.'<br />		
		Email <input class="widget" type="text" name="email" value="'.$rec->email.'" size="40" />
		</p>
		<input type="submit" name="Submit" value="Continue" class="widget submit button-primary" />
		<a href="?page_id='.$page_id.'&cmd=first" class="widget" >Cancel</a>
		</form>';
		
}
//-------------------------------------------------------------------
function WAD_thirdpage($form_data) {
	global $page_id;

	echo '<h2>Third: Confirmation state</h2>';
	echo '
		<form name="WADform" method="post" action="?page_id='.$page_id.'&cmd=first">
		<input  type="hidden" name="bid" value="'.$form_data["bid"].'"/>
		<input  type="hidden" name="email" value="'.$form_data["email"].'"/>
		<p>Name: '.$form_data["names"].' <br />
		Address: '.$form_data["address"].'<br />		
		Email: '.$form_data["email"].'<br />
		</p><hr />
		<p class="widget submit"><input type="submit" name="Submit" value="Confirm Changes" class="widget submit button-primary" /></p>
		<a href="?page_id='.$page_id.'&cmd=first" class="widget" >Cancel</a>
		</form>';	
}
	
//-------------------------------------------------------------------
//add some HTML for our FAQ form and AJAX examples
add_shortcode('multipagedemo','WAD_multipage');  
function WAD_multipage() {
	global $wpdb,$page_id; //required to determine the currently active page

  //check if the required table is available for this example
  //this conditional test is case sensitive so comparing 'WAD_faq' will always fail if if the table existed. 
  if($wpdb->get_var("show tables like 'wad_test11'") != 'wad_test11') { 
	echo '<h3>You need to load the WAD11.sql file, from the same folder as this plugin, into the database before this multi page example will work correctly.</h3>';
	return;	
  }	

  //parse any incoming actions or commands from our page - can be placed in it's own function
  //note: no data is actually saved in any of the pages - the exercise only demonstrates change page "states" (content) while on the same WP page
	if (isset($_GET['cmd']) && !empty($_GET['cmd'])) {
		$cmd = $_GET['cmd']; 
		$bid = $_GET['bid'];
		$form_data = $_POST;
		pr($form_data);
		switch ($cmd) {
			case "first":
				WAD_firstpage();
				break;
			case "second":
				WAD_secondpage($bid);
				break;
			case "third":
				WAD_thirdpage($form_data);
				break;
			default:
				WAD_firstpage();
		}
	} else WAD_firstpage(); 
}	
	
//========================================================================================
//========================================================================================
function WADdisplayafaq() {
    global $wpdb;

    $query = "SELECT * FROM WAD_faq WHERE status=1 ORDER BY answer_date DESC";
    $allfaqs = $wpdb->get_results($query);

    //build up a string
	$buffer = '<ol>';
    foreach ($allfaqs as $faq) {
		$buffer .= '<li>'.format_to_post( $faq->question ).'<br/>'.format_to_post( $faq->answer ).'</li>';	
    }
    $buffer .= '</ol>';
//send the string back to the calling function
//NOTE this becomes impractical when dealing with large strings or data sets
//this is merely an example of returning variables from function.	
    return $buffer; 
}

//-------------------------------------------------------------------
//add some HTML for our FAQ form and AJAX examples
add_shortcode('samepagedemo','WAD_samepage');  
function WAD_samepage() {
  global $page_id; //required to determine the currently active page
  global $wpdb, $current_user;
  
  //check if the required table is available for this example
  //this conditional test is case sensitive so comparing 'WAD_faq' will always fail if if the table existed. 
  if($wpdb->get_var("show tables like 'wad_faq'") != 'wad_faq') { 
	echo '<h3>You need to active the "WAD course - 8. Single table DB CRUD" plugin at least once create the required FAQ before this same page example will work correctly.</h3>';
	return;	
  }
  
  //parse any incoming actions or commands from our page - can be placed in it's own function
  if (isset($_GET['cmd']) && !empty($_GET['cmd'])) {
	$cmd = $_GET['cmd']; //grab the command from our form - check the form for details
	$data = $_POST;

    //some simple validation messages - note the FONT should be replaced with CSS
	if (empty($data['question'])) echo '<font color="red"><h3>The question field cannot be blank</h3></font>';
	if (empty($data['answer'])) echo '<font color="red"><h3>The answer field cannot be blank</h3></font>';
	
	if ($cmd=='saveit' and !empty($data['question']) and !empty($data['answer'])) {
	//add in data validation and error checking here before updating the database!!
		$wpdb->insert( 'WAD_faq',
		  array(
			'question' => stripslashes_deep($data['question']),
			'answer' => stripslashes_deep($data['answer']),
			'answer_date' => date("Y-m-d"),
			'author_id' => $current_user->ID,
			'status' => $data['status']),
		  array( '%s', '%s', '%s', '%d', '%d' ) );
		 echo '<h3>FAQ saved.</h3>'; 
		}
	}
	
	//display our FAQ's	- note its echoing the result of the function	
	echo WADdisplayafaq();	
	
	//display a simple form for adding faq's to the db
	echo '<h2>Non AJAX Form Example</h2>
		<form name="WADform" method="post" action="?page_id='.$page_id.'&cmd=saveit">
		<input class="widget" type="hidden" name="status" value="1"/>
		<p>Question:<br/>
		<input class="widget" type="text" name="question" value="" size="20" class="large-text"/>
		<p>Answer:<br/>
		<textarea class="widget" name="answer" rows="10" cols="30" class="large-text"></textarea>
		</p><hr />
		<p class="widget submit"><input type="submit" name="Submit" value="Save Changes" class="button-primary" /></p>
		</form>';	
		
}	
?>