<?php
/*
 * Plugin Name: Support Ticket Install
 * Plugin URI: http://localhost/
 * Description: Assignment 2, support ticket system for a help desk environment.
 * Version: 1.0
 * Author: Chris Smith, Matt Ross, Mark Powell
 * Author URI: http://eitonline.eit.ac.nz/course/view.php?id=72/
 * License: GPL2
 */

$ST_dbversion = "0.1"; //current version of the database

//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}
 
//========================================================================================
//all the hooks used by our ticket demo
register_activation_hook(__FILE__,'ST_install');
register_deactivation_hook(__FILE__, 'ST_uninstall' );
add_action('plugins_loaded', 'ST_update_db_check');
add_action('plugin_action_links_'.plugin_basename(__FILE__), 'STsettingslink' );  
add_shortcode('displayticket', 'STdisplayticket');
add_action('admin_menu', 'ST_ticket_menu');

//========================================================================================
//check to see if there is any update required for the database, 
//just in case we updated the plugin without reactivating it

function ST_update_db_check() {
	global $ST_dbversion;
	if (get_site_option('ST_dbversion') != $ST_dbversion) ST_install();   
}
 
 //========================================================================================
//hook for the install function - used to create our table for our simple ticket
function ST_install () {
	global $wpdb;
	global $ST_dbversion;

	$currentversion = get_option( "ST_dbversion" ); //retrieve the version of ticket database if it has been installed
	if ($ST_dbversion > $currentversion) {
		if($wpdb->get_var("show tables like 'ST_ticket'") != 'ST_ticket') {
	
			$sql = 'CREATE TABLE ST_ticket (
			id int(11) NOT NULL auto_increment,
			author_id int(11) NOT NULL,
			question_date date NOT NULL,
			question text NOT NULL,
			answer_date date NOT NULL,
			answer text NOT NULL,
			status tinyint(4) NOT NULL,
			customer_name tinytext,
			site_name tinytext,
			site_address_street tinytext,
			site_address_suburb tinytext,
			site_address_city tinytext,
			site_contact_name tinytext,
			site_contact_phone int(11),
			technician_name tinytext,
			job_manager tinytext,
			job_description text,
			special_requests text,
			planned_start_date date,
			planned_finish_date date,
			completion_date date,
			compliance_certificate_required tinytext, 
			compliance_certificate_number int(11),
			known_site_hazards text,
			affiliate_job_number int(11),
			description_of_repair text,
			last_updated date,
			category tinytext,
			priority int(11),
			PRIMARY KEY (id)
			);';
		} 
		
		
		if($wpdb->get_var("show tables like 'ST_notes'") != 'ST_notes') {
	
			$sql .= 'CREATE TABLE ST_notes (
			id int(11) NOT NULL auto_increment,
			customer_notes text,
			technician_notes text,
			fgn_job_id int(11),
			PRIMARY KEY (id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
		}
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			//update the version of the database with the new one
			update_option( "ST_dbversion", $ST_dbversion );
			add_option("ST_dbversion", $ST_dbversion);
	}
}

//========================================================================================
//clean up and remove any settings than may be left in the wp_options table from our plugin
function ST_uninstall() {
	delete_site_option($ST_dbversion);
	delete_option($ST_dbversion);
}
//========================================================================================

//========================================================================================
// add the 'settings' label to the plugin menu
// Add settings link on plugin page
function STsettingslink($links) { 
//http://codex.wordpress.org/Function_Reference/admin_url
  array_unshift($links, '<a href="'.admin_url('plugins.php?page=STsimpleticket').'">Settings</a>'); 
  return $links; 
}

//========================================================================================
//shortcode for displaying the ticket - no parameters
//usage: [displayticket]
//display the ticket questions and answers by using a shortcode
function STdisplayticket() {
    global $wpdb;

	if (is_user_logged_in()) { //is the user authenticated - any user	
		echo "You are an authenticated user so you may access this information...";	
		
		$query = "SELECT * FROM ST_ticket WHERE status=1 ORDER BY answer_date DESC";
		$alltickets = $wpdb->get_results($query);

		$buffer = '<ol>';
		foreach ($alltickets as $ticket) {
			$buffer .= '<li>'.format_to_post( $ticket->question ).'<br/>'.format_to_post( $ticket->answer ).'</li>';	
		}
		$buffer .= '</ol>';
		return $buffer;
	}
	else
		echo "You need to be logged in to access this information";
}

//========================================================================================
//add in the ticket menu entry under the plugins menu.
//notice the menu slug 'STsimpleticket' - this is used through the ticket demo in the URL's to identify this page in the WP dashboard
function ST_ticket_menu() {
		add_submenu_page( 'plugins.php', 'ST 9. Simple ticket', 'ST Simple ticket', 'manage_options', 'STsimpleticket', 'ST_ticket_CRUD');
}

//basic CRUD selector
function ST_ticket_CRUD() {

 //--- some basic debugging for information purposes only
	echo '<h3>Contents of the POST data</h3>';
	pr($_POST); //show the contents of the HTTP POST response from a new/edit command from the form
	echo '<h3>Contents of the REQUEST data</h3>';
	pr($_REQUEST);	 //show the contents of any variables made with a GET HTTP request
//--- end of basic debugging  

	echo  '<div id="msg" style="overflow: auto"></div>
		<div class="wrap">
		<h2>ST 8. Simple ticket <a href="?page=STsimpleticket&command=new" class="add-new-h2">Add New</a></h2>
		<div style="clear: both"></div>';
		
	$ticketdata = $_POST; //our form data from the insert/update
	
//current ticket id for delete/edit commands
	if (isset($_REQUEST['id'])) 
		$ticketid = $_REQUEST['id']; 
	else 
		$ticketid = '';

//current CRUD command		
	if (isset($_REQUEST["command"])) 
		$command = $_REQUEST["command"]; 
	else 
		$command = '';
		
//execute the respective function based on the command		
    switch ($command) {
		case 'view':
			ST_ticket_view($ticketid);
		break;
		
		case 'edit':
			$msg = ST_ticket_form('update', $ticketid); //notice the $ticketid passed for the form for an update/edit
		break;

		case 'new':
			$msg = ST_ticket_form('insert',null);//notice the null passed for the insert/new to the form
		break;
      
		case 'delete':
			$msg = ST_ticket_delete($ticketid); //remove a ticket entry
			$command = '';
		break;

		case 'update':
			$msg = ST_ticket_update($ticketdata); //update an existing ticket
			$command = '';
		break;

		case 'insert':	
			$msg = ST_ticket_insert($ticketdata); //prepare a blank form for adding a new ticket entry
			$command = '';
		break;
	}

	if (empty($command)) ST_ticket_list(); //display a list of the tickets if no command issued

//show any information messages	
	if (!empty($msg)) {
      echo '<p><a href="?page=STsimpleticket"> back to the ticket list </a></p> Message: '.$msg;      
	}
	echo '</div>';
}

//========================================================================================
//view all the detail for a single ticket
function ST_ticket_view($id) {
   global $wpdb;
   
   $row = $wpdb->get_row("SELECT * FROM ST_ticket WHERE id = '$id'");
   echo '<p>';
   echo "Question:";
   echo '<br/>';
   echo $row->question;
   echo '<p>';
   echo "Answer:";
   echo '<br/>';
   echo $row->answer;
   echo '<p>';
   echo "Question Date:";
   echo '<br/>';
   echo $row->question_date;
   echo '<p>';
   echo "Customer Name:";
   echo '<br/>';
   echo $row->customer_name;
   echo '<p>';
   echo "Site Name:";
   echo '<br/>';
   echo $row->site_name;
   echo '<p>';
   echo "Site Address:";
   echo '<br/>';
   echo $row->site_address;
   echo '<p>';
   echo "Site Address Suburb:";
   echo '<br/>';
   echo $row->site_address_suburb;
   echo '<p>';
   echo "Site Address City:";
   echo '<br/>';
   echo $row->site_address_city;
   echo '<p>';
   echo "Site Contact Name:";
   echo '<br/>';
   echo $row->site_contact_name;
   echo '<p>';
   echo "Site Contact Phone:";
   echo '<br/>';
   echo $row->site_contact_phone;
   echo '<p>';
   echo "Technician Name:";
   echo '<br/>';
   echo $row->technician_name;
   echo '<p>';
   echo "Job Manager:";
   echo '<br/>';
   echo $row->job_manager;
   echo '<p>';
   echo "Job Description:";
   echo '<br/>';
   echo $row->job_description;
   echo '<p>';
   echo "Special Requests:";
   echo '<br/>';
   echo $row->special_requests;
   echo '<p>';
   echo "Planned Start Date:";
   echo '<br/>';
   echo $row->planned_start_date;
   echo '<p>';
   echo "Planned Finish Date:";
   echo '<br/>';
   echo $row->planned_finish_date;
   echo '<p>';
   echo "Completion Date:";
   echo '<br/>';
   echo $row->completion_date;
   echo '<p>';
   echo "Compliance Certificate Required:";
   echo '<br/>';
   echo $row->compliance_certificate_required;
   echo '<p>';
   echo "Compliance Certificate Number:";
   echo '<br/>';
   echo $row->compliance_certificate_number;
   echo '<p>';
   echo "Known Site Hazards:";
   echo '<br/>';
   echo $row->known_site_hazards;
   echo '<p>';
   echo "Affiliate Job Number:";
   echo '<br/>';
   echo $row->affiliate_job_number;
   echo '<p>';
   echo "Description Of Repair:";
   echo '<br/>';
   echo $row->description_of_repair;
   echo '<p>';
   echo "Last Updated:";
   echo '<br/>';
   echo $row->last_updated;
   echo '<p>';
   echo "Category:";
   echo '<br/>';
   echo $row->category;
   echo '<p>';
   echo "Priority:";
   echo '<br/>';
   echo $row->priority;
   echo '<p><a href="?page=STsimpleticket">&laquo; back to list</p>';
}

//========================================================================================
//remove an existing ticket from the database
function ST_ticket_delete($id) {
   global $wpdb;

   $results = $wpdb->query("DELETE FROM ST_ticket WHERE id='$id'");
   if ($results) {
      $msg = "ticket entry $id was successfully deleted.";
   }
   return $msg;
}

//========================================================================================
//update an existing ticket in the database
function ST_ticket_update($data) {
    global $wpdb, $current_user;
	
//add in data validation and error checking here before updating the database!!
    $wpdb->update('ST_ticket',
		  array( 'question' => stripslashes_deep($data['question']),
				 'question_date' => date("Y-m-d"),
				 'answer' => stripslashes_deep($data['answer']),
				 'answer_date' => date("Y-m-d"),
				 'author_id' => $current_user->ID,
				 'status' => $data['status']),
		  array( 'id' => $data['hid']));
    $msg = "Question and answer ".$data['hid']." has been updated";
    return $msg;
}

//========================================================================================
//add a new ticket to the database
function ST_ticket_insert($data) {
    global $wpdb, $current_user;

//add in data validation and error checking here before updating the database!!
    $wpdb->insert( 'ST_ticket',
		  array(
			'question' => stripslashes_deep($data['question']),
			'question_date' => date("Y-m-d"),
			'answer' => stripslashes_deep($data['answer']),
			'answer_date' => date("Y-m-d"),
			'author_id' => $current_user->ID,
			'status' => $data['status']),
		  array( '%s', '%s', '%s', '%s', '%d', '%d' ) );
    $msg = "A ticket entry has been added";
    return $msg;
}

//========================================================================================
function ST_ticket_list() {
   global $wpdb, $current_user;

   //prepare the query for retrieving the ticket's from the database
   $query = "SELECT id, question, answer, author_id, answer_date, status FROM ST_ticket ORDER BY answer_date DESC";
   $alltickets = $wpdb->get_results($query);

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

    
    foreach ($alltickets as $ticket) {
       if ($ticket->author_id == 0) $ticket->author_id = $current_user->ID;

//use a WP function to retrieve user information based on the id
	   $user_info = get_userdata($ticket->author_id);
	   
//prepare the URL's for some of the CRUD	   
	   $edit_link = '?page=STsimpleticket&id=' . $ticket->id . '&command=edit';
	   $view_link ='?page=STsimpleticket&id=' . $ticket->id . '&command=view';
	   $delete_link = '?page=STsimpleticket&id=' . $ticket->id . '&command=delete';

//use some inbuilt WP CSS to perform the rollover effect for the edit/view/delete links	   
	   echo '<tr>';
	   echo '<td><strong><a href="'.$edit_link.'" title="Edit question">' . $ticket->question . '</a></strong>';
	   echo '<div class="row-actions">';
	   echo '<span class="edit"><a href="'.$edit_link.'" title="Edit this item">Edit</a></span> | ';
	   echo '<span class="view"><a href="'.$view_link.'" title="View this item">View</a></span> | ';
	   echo '<span class="trash"><a href="'.$delete_link.'" title="Move this item to Trash" onclick="return doDelete();">Trash</a></span>';
	   echo '</div>';
	   echo '</td>';
	   echo '<td>' . $ticket->answer_date . '</td>';
	   echo '<td>' . $user_info->user_login . '</td>';
	   
//display the status in words depending on the current status value in the database - 0 or 1	   
	   $status = array('Draft', 'Published');
 	   echo '<td>' . $status[$ticket->status] . '</td></tr>';  
    }
   echo '</tbody></table>';
	
//small piece of javascript for the delete confirmation	
	echo "<script type='text/javascript'>
			function doDelete() { if (!confirm('Are you sure?')) return false; }
		  </script>";
}

//========================================================================================
//this is the form used for the insert as well as the edit/update of the ticket data
function ST_ticket_form($command, $id = null) {
    global $wpdb;

//if the current command is insert then clear the form variables to ensure we have a blank
//form before starting	
    if ($command == 'insert') {
      $ticket->question = '';
      $ticket->answer = '';
	  $ticket->status = 0;
    }
	
//if the current command is 'edit' then retrieve the ticket record based on the id pased to this function
	if ($command == 'update') {
        $ticket = $wpdb->get_row("SELECT * FROM ST_ticket WHERE id = '$id'");
	}

//prepare the draft/published status for the HTML check boxes	
	if (isset($ticket)) {
		$draftstatus = ($ticket->status == 0)?"checked":"";
		$pubstatus   = ($ticket->status == 1)?"checked":"";
	}

//prepare the HTML form	
    echo '<form name="STform" method="post" action="?page=STsimpleticket">
		<input type="hidden" name="hid" value="'.$id.'"/>
		<input type="hidden" name="command" value="'.$command.'"/>

		<p>Question:<br/>
		<input type="text" name="question" value="'.$ticket->question.'" size="20" class="large-text"/>
		<p>Answer:<br/>
		<textarea name="answer" rows="10" cols="30" class="large-text">'.$ticket->answer.'</textarea>
		<p>Customer Name:<br/>
		<input type="text" name="customer_name" value="'.$ticket->customer_name.'" size="20" class="large-text"/>
		<p>Site Name:<br/>
		<input type="text" name="site_name" value="'.$ticket->site_name.'" size="20" class="large-text"/>
		<p>Site Address Street:<br/>
		<input type="text" name="site_address_street" value="'.$ticket->site_address_street.'" size="20" class="large-text"/>
		<p>Site Address Suburb:<br/>
		<input type="text" name="site_address_suburb" value="'.$ticket->site_address_suburb.'" size="20" class="large-text"/>
		<p>Site Address City:<br/>
		<input type="text" name="site_address_city" value="'.$ticket->site_address_city.'" size="20" class="large-text"/>
		<p>Site Contact Name:<br/>
		<input type="text" name="site_contact_name" value="'.$ticket->site_contact_name.'" size="20" class="large-text"/>
		<p>Site Contact Phone:<br/>
		<input type="text" name="site_contact_phone" value="'.$ticket->site_contact_phone.'" size="20" class="large-text"/>
		<p>Technician Name:<br/>
		<input type="text" name="technician_name" value="'.$ticket->technician_name.'" size="20" class="large-text"/>
		<p>Job Manager:<br/>
		<input type="text" name="job_manager" value="'.$ticket->job_manager.'" size="20" class="large-text"/>
		<p>Job Description:<br/>
		<textarea name="job_description" rows="5" cols="20" class="large-text">'.$ticket->job_description.'</textarea>
		<p>Special Requests:<br/>
		<textarea name="special_requests" rows="5" cols="20" class="large-text">'.$ticket->special_requests.'</textarea>
		<p>Planned Start Date:<br/>
		<input type="text" name="planned_start_date" value="'.$ticket->planned_start_date.'" size="20" class="large-text"/>
		<p>Planned Finish Date:<br/>
		<input type="text" name="planned_finish_date" value="'.$ticket->planned_finish_date.'" size="20" class="large-text"/>
		<p>Completion Date:<br/>
		<input type="text" name="completion_date" value="'.$ticket->completion_date.'" size="20" class="large-text"/>
		<p>Compliance Certificate Required?:<br/>
		<input type="text" name="compliance_certificate_required" value="'.$ticket->compliance_certificate_required.'" size="20" class="large-text"/>
		<p>Compliance Certificate Number:<br/>
		<input type="text" name="compliance_certificate_number" value="'.$ticket->compliance_certificate_number.'" size="20" class="large-text"/>
		<p>Known Site Hazards:<br/>
		<textarea name="known_site_hazards" rows="5" cols="20" class="large-text">'.$ticket->known_site_hazards.'</textarea>
		<p>Affiliate Job Number:<br/>
		<input type="text" name="affiliate_job_number" value="'.$ticket->job_manager.'" size="20" class="large-text"/>
		<p>Description of Repair:<br/>
		<textarea name="description_of_repair" rows="5" cols="20" class="large-text">'.$ticket->description_of_repair.'</textarea>
		<p>Last Updated:<br/>
		<input type="text" name="last_updated" value="'.$ticket->last_updated.'" size="20" class="large-text"/>
		<p>Category:<br/>
		<input type="text" name="category" value="'.$ticket->category.'" size="20" class="large-text"/>
		<p>Priority:<br/>
		<input type="text" name="priority" value="'.$ticket->priority.'" size="20" class="large-text"/>
		
		<label><input type="radio" name="status" value="0" '.$draftstatus.'> Draft</label> 
		<label><input type="radio" name="status" value="1" '.$pubstatus.'> Published</label> 
		</p>
		<p class="submit"><input type="submit" name="Submit" value="Save Changes" class="button-primary" /></p>
		</form>';
}
 ?>
