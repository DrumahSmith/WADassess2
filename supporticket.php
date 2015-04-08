<?php
/*
Plugin Name: Assignment 2 Support Ticket
Plugin URI: http://localhost/
Description: Assignment 2, support ticket system for a help desk environment.
Author: Chris Smith, Matt Ross, Mark Powell
Version: 1.0
Author URI: http://eitonline.eit.ac.nz/course/view.php?id=72/
Last update: 
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
add_action('plugin_action_links_'.plugin_basename(__FILE__), 'GCsettingslink' );  
add_shortcode('displayfaq', 'GCdisplayfaq');
add_action('admin_menu', 'GC_faq_menu');

//========================================================================================
//check to see if there is any update required for the database, 
//just in case we updated the plugin without reactivating it

function WAD_update_db_check() {
	global $GC_dbversion;
	if (get_site_option('GC_dbversion') != $GC_dbversion) GC_faq_install();   
}

//========================================================================================
//hook for the install function - used to create our table for our simple FAQ
function GC_faq_install () {
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
			customer_notes text NOT NULL,
			job_manager tinytext NOT NULL,
			technician_notes text NOT NULL,
			date_completed date NOT NULL,
			compliance_certificate_required enum('true','false') NOT NULL, /*Must enter true/false otherwise blank entry added*/
			compliance_certificate_number int(11) NOT NULL,
			known_site_hazards text NOT NULL,
			glenn_cook_job_number int(11) NOT NULL,
			description_of_repair text NOT NULL,
			last_updated date NOT NULL,
			category tinytext NOT NULL,
			priority int(11) NOT NULL,
			attached_files /* Add data type */
			PRIMARY KEY (id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
			
			

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			//update the version of the database with the new one
			update_option( "GC_dbversion", $GC_dbversion );
			add_option("GC_dbversion", $GC_dbversion);
		}  
   }	
}   

//========================================================================================
//clean up and remove any settings than may be left in the wp_options table from our plugin
function GC_faq_uninstall() {
	delete_site_option($GC_dbversion);
	delete_option($GC_dbversion);
}

//========================================================================================
// add the 'settings' label to the plugin menu
// Add settings link on plugin page
function FAQsettingslink($links) { 
//http://codex.wordpress.org/Function_Reference/admin_url
  array_unshift($links, '<a href="'.admin_url('plugins.php?page=GCsimplefaq').'">Settings</a>'); 
  return $links; 
}

//========================================================================================
//shortcode for displaying the FAQ - no parameters
//usage: [displayfaq]
//display the faq questions and answers by using a shortcode
function GCdisplayfaq() {
    global $wpdb;

    $query = "SELECT * FROM GC_faq WHERE status=1 ORDER BY answer_date DESC";
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
function GC_faq_menu() {
		add_submenu_page( 'plugins.php', 'GC 9. Simple FAQ', 'GC Simple FAQ', 'manage_options', 'GCsimplefaq', 'GC_faq_CRUD');
}

//basic CRUD selector
function GC_faq_CRUD() {

 //--- some basic debugging for information purposes only
	echo '<h3>Contents of the POST data</h3>';
	pr($_POST); //show the contents of the HTTP POST response from a new/edit command from the form
	echo '<h3>Contents of the REQUEST data</h3>';
	pr($_REQUEST);	 //show the contents of any variables made with a GET HTTP request
//--- end of basic debugging  

	echo  '<div id="msg" style="overflow: auto"></div>
		<div class="wrap">
		<h2>GC 8. Simple FAQ <a href="?page=WADsimplefaq&command=new" class="add-new-h2">Add New</a></h2>
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
			GC_faq_view($faqid);
		break;
		
		case 'edit':
			$msg = GC_faq_form('update', $faqid); //notice the $faqid passed for the form for an update/edit
		break;

		case 'new':
			$msg = GC_faq_form('insert',null);//notice the null passed for the insert/new to the form
		break;
      
		case 'delete':
			$msg = GC_faq_delete($faqid); //remove a faq entry
			$command = '';
		break;

		case 'update':
			$msg = GC_faq_update($faqdata); //update an existing faq
			$command = '';
		break;

		case 'insert':	
			$msg = GC_faq_insert($faqdata); //prepare a blank form for adding a new faq entry
			$command = '';
		break;
	}

	if (empty($command)) GC_faq_list(); //display a list of the faqs if no command issued

//show any information messages	
	if (!empty($msg)) {
      echo '<p><a href="?page=GCsimplefaq"> back to the FAQ list </a></p> Message: '.$msg;      
	}
	echo '</div>';
}

//========================================================================================
//view all the detail for a single FAQ
function GC_faq_view($id) {
   global $wpdb;
   
   $row = $wpdb->get_row("SELECT * FROM GC_faq WHERE id = '$id'");
   echo '<p>';
   echo "Question:";
   echo '<br/>';
   echo $row->question;
   echo '<p>';
   echo "Answer:";
   echo '<br/>';
   echo $row->answer;
   echo '<p><a href="?page=GCsimplefaq">&laquo; back to the FAQ list</p>';
}

//========================================================================================
//remove an existing FAQ from the database
function GC_faq_delete($id) {
   global $wpdb;

   $results = $wpdb->delete('GC_faq',array( 'id' => $id ) );
   if ($results) {
      $msg = "FAQ entry $id was successfully deleted.";
   }
   return $msg;
}

//========================================================================================
//update an existing FAQ in the database
function GC_faq_update($data) {
    global $wpdb, $current_user;
	
//add in data validation and error checking here before updating the database!!
    $wpdb->update('GC_faq',
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
function GC_faq_insert($data) {
    global $wpdb, $current_user;

//add in data validation and error checking here before updating the database!!
    $wpdb->insert( 'GC_faq',
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
function GC_faq_list() {
   global $wpdb, $current_user;

   //prepare the query for retrieving the FAQ's from the database
   $query = "SELECT id, question, answer, author_id, answer_date, status FROM GC_faq ORDER BY answer_date DESC";
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
	   $edit_link = '?page=GCsimplefaq&id=' . $faq->id . '&command=edit';
	   $view_link ='?page=GCsimplefaq&id=' . $faq->id . '&command=view';
	   $delete_link = '?page=GCsimplefaq&id=' . $faq->id . '&command=delete';

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
function GC_faq_form($command, $id = null) {
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
        $faq = $wpdb->get_row("SELECT * FROM GC_faq WHERE id = '$id'");
	}

//prepare the draft/published status for the HTML check boxes	
	if (isset($faq)) {
		$draftstatus = ($faq->status == 0)?"checked":"";
		$pubstatus   = ($faq->status == 1)?"checked":"";
	}
	
//prepare the HTML form	
    echo '<form name="GCform" method="post" action="?page=GCsimplefaq">
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
   echo '<p><a href="?page=GCsimplefaq">&laquo; back to the FAQ list</p>';		
}
?>
