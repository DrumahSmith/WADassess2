<?php
/*
Plugin Name: WAD course - 8. Single table DB CRUD
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This is plugin is a sample FAQ demonstrating hooks, actions, filters and database CRUD activity.
Author: John Jamieson
Version: 1.3
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
	05APR2013 - Initial release.
	12APR2013 - Fixed the question list view - moved </form> & </tbody> tags out of the loop
	27JAN2014 - Fixed some minor bugs, added usage reference. Tested against WP3.8.1			
	01APR2015 - Changed the record delete function to use then Wordpress function. Fixed up some navigation issues.
*/
/*-------------------------------------------------------------------------------------------
 * Wordpress globals - http://codex.wordpress.org/User:CharlesClarkson/Global_Variables
 * 					 - http://codex.wordpress.org/Function_Reference
 * Database object - http://codex.wordpress.org/Class_Reference/wpdb
 * 				   - http://codex.wordpress.org/Database_Description
 * Get user metadata - http://codex.wordpress.org/Function_Reference/get_userdata		 
 * 					 - http://codex.wordpress.org/Function_Reference/get_currentuserinfo
 * User access testing - http://codex.wordpress.org/Roles_and_Capabilities
 *				 	   - http://codex.wordpress.org/Function_Reference/current_user_can
 * Data Validation	  - http://codex.wordpress.org/Data_Validation
 -------------------------------------------------------------------------------------------*/
$WAD_dbversion = "0.1"; //current version of our database for our simple FAQ demo

//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}
 
//========================================================================================
//all the hooks used by our FAQ demo
register_activation_hook(__FILE__,'WAD_faq_install');
register_deactivation_hook( __FILE__, 'WAD_faq_uninstall' );
add_action('plugins_loaded', 'WAD_update_db_check');
add_action('plugin_action_links_'.plugin_basename(__FILE__), 'FAQsettingslink' );  
add_shortcode('displayfaq', 'WADdisplayfaq');
add_action('admin_menu', 'WAD_faq_menu');

//========================================================================================
//check to see if there is any update required for the database, 
//just in case we updated the plugin without reactivating it

function WAD_update_db_check() {
	global $WAD_dbversion;
	if (get_site_option('WAD_dbversion') != $WAD_dbversion) WAD_faq_install();   
}

//========================================================================================
//hook for the install function - used to create our table for our simple FAQ
function WAD_faq_install () {
	global $wpdb;
	global $WAD_dbversion;

	$currentversion = get_option( "WAD_dbversion" ); //retrieve the version of FAQ database if it has been installed
	if ($WAD_dbversion > $currentversion) {
		if($wpdb->get_var("show tables like 'WAD_faq'") != 'WAD_faq') {
	
			$sql = 'CREATE TABLE WAD_faq (
			id int(11) NOT NULL auto_increment,
			author_id int(11) NOT NULL,
			question_date date NOT NULL,
			question text NOT NULL,
			answer_date date NOT NULL,
			answer text NOT NULL,
			status tinyint(4) NOT NULL,
			PRIMARY KEY (id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;';

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			//update the version of the database with the new one
			update_option( "WAD_dbversion", $WAD_dbversion );
			add_option("WAD_dbversion", $WAD_dbversion);
		}  
   }	
}   

//========================================================================================
//clean up and remove any settings than may be left in the wp_options table from our plugin
function WAD_faq_uninstall() {
	delete_site_option($WAD_dbversion);
	delete_option($WAD_dbversion);
}

//========================================================================================
// add the 'settings' label to the plugin menu
// Add settings link on plugin page
function FAQsettingslink($links) { 
//http://codex.wordpress.org/Function_Reference/admin_url
  array_unshift($links, '<a href="'.admin_url('plugins.php?page=WADsimplefaq').'">Settings</a>'); 
  return $links; 
}

//========================================================================================
//shortcode for displaying the FAQ - no parameters
//usage: [displayfaq]
//display the faq questions and answers by using a shortcode
function WADdisplayfaq() {
    global $wpdb;

    $query = "SELECT * FROM WAD_faq WHERE status=1 ORDER BY answer_date DESC";
    $allfaqs = $wpdb->get_results($query);

    $buffer = '<ol>';
    foreach ($allfaqs as $faq) {
		$buffer .= '<li>'.format_to_post( $faq->question ).'<br/>'.format_to_post( $faq->answer ).'</li>';	
    }
    $buffer .= '</ol>';
    return $buffer;
}

//========================================================================================
//add in the FAQ menu entry under the plugins menu.
//notice the menu slug 'WADsimplefaq' - this is used through the FAQ demo in the URL's to identify this page in the WP dashboard
function WAD_faq_menu() {
		add_submenu_page( 'plugins.php', 'WAD 9. Simple FAQ', 'WAD Simple FAQ', 'manage_options', 'WADsimplefaq', 'WAD_faq_CRUD');
}

//basic CRUD selector
function WAD_faq_CRUD() {

 //--- some basic debugging for information purposes only
	echo '<h3>Contents of the POST data</h3>';
	pr($_POST); //show the contents of the HTTP POST response from a new/edit command from the form
	echo '<h3>Contents of the REQUEST data</h3>';
	pr($_REQUEST);	 //show the contents of any variables made with a GET HTTP request
//--- end of basic debugging  

	echo  '<div id="msg" style="overflow: auto"></div>
		<div class="wrap">
		<h2>WAD 8. Simple FAQ <a href="?page=WADsimplefaq&command=new" class="add-new-h2">Add New</a></h2>
		<div style="clear: both"></div>';
		
	$faqdata = $_POST; //our form data from the insert/update
	
//current FAQ id for delete/edit commands
	if (isset($_REQUEST['id'])) 
		$faqid = $_REQUEST['id']; 
	else 
		$faqid = '';

//current CRUD command		
	if (isset($_REQUEST["command"])) 
		$command = $_REQUEST["command"]; 
	else 
		$command = '';
		
//execute the respective function based on the command		
    switch ($command) {
		case 'view':
			WAD_faq_view($faqid);
		break;
		
		case 'edit':
			$msg = WAD_faq_form('update', $faqid); //notice the $faqid passed for the form for an update/edit
		break;

		case 'new':
			$msg = WAD_faq_form('insert',null);//notice the null passed for the insert/new to the form
		break;
      
		case 'delete':
			$msg = WAD_faq_delete($faqid); //remove a faq entry
			$command = '';
		break;

		case 'update':
			$msg = WAD_faq_update($faqdata); //update an existing faq
			$command = '';
		break;

		case 'insert':	
			$msg = WAD_faq_insert($faqdata); //prepare a blank form for adding a new faq entry
			$command = '';
		break;
	}

	if (empty($command)) WAD_faq_list(); //display a list of the faqs if no command issued

//show any information messages	
	if (!empty($msg)) {
      echo '<p><a href="?page=WADsimplefaq"> back to the FAQ list </a></p> Message: '.$msg;      
	}
	echo '</div>';
}

//========================================================================================
//view all the detail for a single FAQ
function WAD_faq_view($id) {
   global $wpdb;
   
   $row = $wpdb->get_row("SELECT * FROM WAD_faq WHERE id = '$id'");
   echo '<p>';
   echo "Question:";
   echo '<br/>';
   echo $row->question;
   echo '<p>';
   echo "Answer:";
   echo '<br/>';
   echo $row->answer;
   echo '<p><a href="?page=WADsimplefaq">&laquo; back to the FAQ list</p>';
}

//========================================================================================
//remove an existing FAQ from the database
function WAD_faq_delete($id) {
   global $wpdb;

   $results = $wpdb->delete('WAD_faq',array( 'id' => $id ) );
   if ($results) {
      $msg = "FAQ entry $id was successfully deleted.";
   }
   return $msg;
}

//========================================================================================
//update an existing FAQ in the database
function WAD_faq_update($data) {
    global $wpdb, $current_user;
	
//add in data validation and error checking here before updating the database!!
    $wpdb->update('WAD_faq',
		  array( 'question' => stripslashes_deep($data['question']),
				 'answer' => stripslashes_deep($data['answer']),
				 'answer_date' => date("Y-m-d"),
				 'author_id' => $current_user->ID,
				 'status' => $data['status']),
		  array( 'id' => $data['hid']));
    $msg = "Question and answer ".$data['hid']." has been updated";
    return $msg;
}

//========================================================================================
//add a new FAQ to the database
function WAD_faq_insert($data) {
    global $wpdb, $current_user;

//add in data validation and error checking here before updating the database!!
    $wpdb->insert( 'WAD_faq',
		  array(
			'question' => stripslashes_deep($data['question']),
			'answer' => stripslashes_deep($data['answer']),
			'answer_date' => date("Y-m-d"),
			'author_id' => $current_user->ID,
			'status' => $data['status']),
		  array( '%s', '%s', '%s', '%d', '%d' ) );
    $msg = "A FAQ entry has been added";
    return $msg;
}

//========================================================================================
function WAD_faq_list() {
   global $wpdb, $current_user;

   //prepare the query for retrieving the FAQ's from the database
   $query = "SELECT id, question, answer, author_id, answer_date, status FROM WAD_faq ORDER BY answer_date DESC";
   $allfaqs = $wpdb->get_results($query);

   //prepare the table and use a default WP style - wp-list-table widefat
   echo '<table class="wp-list-table widefat">
		<thead>
		<tr>
			<th scope="col" class="manage-column">Question</th>
			<th scope="col" class="manage-column">Created</th>
			<th scope="col" class="manage-column">Author</th>
			<th scope="col" class="manage-column">Status</th>
		</tr>
		</thead>
		<tbody>';

    
    foreach ($allfaqs as $faq) {
       if ($faq->author_id == 0) $faq->author_id = $current_user->ID;

//use a WP function to retrieve user information based on the id
	   $user_info = get_userdata($faq->author_id);
	   
//prepare the URL's for some of the CRUD	   
	   $edit_link = '?page=WADsimplefaq&id=' . $faq->id . '&command=edit';
	   $view_link ='?page=WADsimplefaq&id=' . $faq->id . '&command=view';
	   $delete_link = '?page=WADsimplefaq&id=' . $faq->id . '&command=delete';

//use some inbuilt WP CSS to perform the rollover effect for the edit/view/delete links	   
	   echo '<tr>';
	   echo '<td><strong><a href="'.$edit_link.'" title="Edit question">' . $faq->question . '</a></strong>';
	   echo '<div class="row-actions">';
	   echo '<span class="edit"><a href="'.$edit_link.'" title="Edit this item">Edit</a></span> | ';
	   echo '<span class="view"><a href="'.$view_link.'" title="View this item">View</a></span> | ';
	   echo '<span class="trash"><a href="'.$delete_link.'" title="Move this item to Trash" onclick="return doDelete();">Trash</a></span>';
	   echo '</div>';
	   echo '</td>';
	   echo '<td>' . $faq->answer_date . '</td>';
	   echo '<td>' . $user_info->user_login . '</td>';
	   
//display the status in words depending on the current status value in the database - 0 or 1	   
	   $status = array('Draft', 'Published');
 	   echo '<td>' . $status[$faq->status] . '</td></tr>';  
    }
   echo '</tbody></table>';
	
//small piece of javascript for the delete confirmation	
	echo "<script type='text/javascript'>
			function doDelete() { if (!confirm('Are you sure?')) return false; }
		  </script>";
}

//========================================================================================
//this is the form used for the insert as well as the edit/update of the FAQ data
function WAD_faq_form($command, $id = null) {
    global $wpdb;

//if the current command is insert then clear the form variables to ensure we have a blank
//form before starting	
    if ($command == 'insert') {
      $faq->question = '';
      $faq->answer = '';
	  $faq->status = 0;
    }
	
//if the current command is 'edit' then retrieve the FAQ record based on the id pased to this function
	if ($command == 'update') {
        $faq = $wpdb->get_row("SELECT * FROM WAD_faq WHERE id = '$id'");
	}

//prepare the draft/published status for the HTML check boxes	
	if (isset($faq)) {
		$draftstatus = ($faq->status == 0)?"checked":"";
		$pubstatus   = ($faq->status == 1)?"checked":"";
	}
	
//prepare the HTML form	
    echo '<form name="WADform" method="post" action="?page=WADsimplefaq">
		<input type="hidden" name="hid" value="'.$id.'"/>
		<input type="hidden" name="command" value="'.$command.'"/>

		<p>Question:<br/>
		<input type="text" name="question" value="'.$faq->question.'" size="20" class="large-text"/>
		<p>Answer:<br/>
		<textarea name="answer" rows="10" cols="30" class="large-text">'.$faq->answer.'</textarea>
		</p><hr />
		<p>
		<label><input type="radio" name="status" value="0" '.$draftstatus.'> Draft</label> 
		<label><input type="radio" name="status" value="1" '.$pubstatus.'> Published</label> 
		</p>
		<p class="submit"><input type="submit" name="Submit" value="Save Changes" class="button-primary" /></p>
		</form>';
   echo '<p><a href="?page=WADsimplefaq">&laquo; back to the FAQ list</p>';		
}
?>
