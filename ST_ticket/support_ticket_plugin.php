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
require "gump.class.php";
$ST_dbversion = "0.9"; //current version of the database

//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}
 
//========================================================================================
//all the hooks used by our ticket
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
			entry_date date NOT NULL,
			visibility tinyint(4) NOT NULL,
			customer_name tinytext,
			site_name tinytext,
			site_address_street tinytext,
			site_address_suburb tinytext,
			site_address_city tinytext,
			site_contact_name tinytext,
			site_contact_phone tinytext,
			technician_name tinytext,
			job_manager tinytext,
			job_description text,
			special_requests text,
			planned_start_date date,
			planned_finish_date date,
			completion_date date,
			compliance_certificate_required tinytext, 
			compliance_certificate_number tinytext,
			known_site_hazards text,
			affiliate_job_number tinytext,
			description_of_repair text,
			last_updated date,
			department int(11) NOT NULL,
			priority int(11),
			status int(11),
			PRIMARY KEY (id)
			);';
		} 
		
		
		if($wpdb->get_var("show tables like 'ST_notes'") != 'ST_notes') {
	
			$sql .= 'CREATE TABLE ST_notes (
			id int(11) NOT NULL auto_increment,
			customer_notes text,
			note_date date,
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
		
		$query = "SELECT * FROM ST_ticket WHERE visibility=0 ORDER BY entry_date DESC";
		$alltickets = $wpdb->get_results($query);

		$buffer = '<ol>';
		foreach ($alltickets as $ticket) {
			$buffer .= '<li>'.format_to_post( $ticket->id ).'<br/>'.format_to_post( $ticket->customer_name ).'</li>';	
		}
		$buffer .= '</ol>';
		return $buffer;
	}
	else{
		echo "You need to be logged in to access this information";
		//add data view for public users IE not logged in.
	}
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
   $notes = $wpdb->get_results("SELECT * FROM ST_notes WHERE fgn_job_id = '$id'");
   echo '<link rel="stylesheet" href="../wp-content/plugins/ST_ticket/custom.css">
<div id="display_table">

<table id="left">
<tr>
    <td><strong>Entry Date:</strong></br>
	'.$row->entry_date.'</td>
</tr>
<tr>
	<td><strong>Last Updated:</strong></br>
	'.$row->last_updated.'</td>
</tr>
<tr>
	<td><strong>Customer Name:</strong></br>
	'.$row->customer_name.'</td>
</tr>
<tr>
	<td><strong>Planned Start Date:</strong></br>
	'.$row->planned_start_date.'</td>
</tr>
<tr>
	<td><strong>Planned Finish Date:</strong></br>
	'.$row->planned_finish_date.'</td>
</tr>
<tr>
	<td><strong>Completion Date:</strong></br>
	'.$row->completion_date.'</td>
</tr>
<tr>
	<td><strong>Priority:</strong></br>';
	$priorityOptions = array(' ', 'Low', 'High', 'Urgent', 'Critical');
	echo $priorityOptions[$row->priority].'</td>

</tr>
<tr>
	<td><strong>Status:</strong></br>';
	$statusOptions = array(' ', 'Pending','Open','Closed');
	echo $statusOptions[$row->status].'</td>
</tr>
</table>

<table id="center">
<tr>
    <td><strong>Technician Name:</strong></br>
	'.$row->technician_name.'</td>
</tr>
<tr>
	<td><strong>Job Manager:</strong></br>
	'.$row->job_manager.'</td>
</tr>
<tr>
	<td><strong>Job Description:</strong></br>
	'.$row->job_description.'</td>
</tr>
<tr>
	<td><strong>Special Requests:</strong></br>
	'.$row->special_requests.'</td>
</tr>
<tr>
	<td><strong>Compliance Certificate Required:</strong></br>';
	$complianceOptions = array('', 'Yes', 'No');
	echo $complianceOptions[$row->compliance_certificate_required].'</td>
</tr>
<tr>
	<td><strong>Compliance Certificate Number:</strong></br>
	'.$row->compliance_certificate_number.'</td>
</tr>
<tr>
	<td><strong>Affiliate Job Number:</strong></br>
	'.$row->affiliate_job_number.'</td>
</tr>
<tr>
	<td><strong>Description Of Repair:</strong></br>
	'.$row->description_of_repair.'</td>
</tr>
<tr>
	<td><strong>Department:</strong></br>';
	$departmentOptions = array('', 'Server Support', 'Network Support', 'Hardware Support', 'Data Support');
	echo $departmentOptions[$row->department].'</td>
</tr>
</table>

<table id="right">
<tr>
    <td><strong>Site Name:</strong></br>
	'.$row->site_name.'</td>
</tr>
<tr>
	<td><strong>Site Address:</strong></br>
	'.$row->site_address_street.'</td>
</tr>
<tr> 
	<td><strong>Site Address Suburb:</strong></br>
	'.$row->site_address_suburb.'</td>
</tr>
<tr>	
	<td><strong>Site Address City:</strong></br>
	'.$row->site_address_city.'</td>
</tr>
<tr>	
	<td><strong>Site Contact Name:</strong></br>
	'.$row->site_contact_name.'</td>
</tr>
<tr>	
	<td><strong>Site Contact Phone:</strong></br>
	'.$row->site_contact_phone.'</td>
</tr>
<tr>
	<td><strong>Known Site Hazards:</strong></br>
	'.$row->known_site_hazards.'</td>
</tr>

</table>

</div>
<p style="clear: both"><strong>Notes:</strong>
</P>';
foreach ($notes as $note) {
	if($note->customer_notes !== "") {
		echo '<p class="note">';
		echo '<p class="customer_note"">'.$note->customer_notes.'</p>';
		echo '<p class="note_date">'.$note->note_date.'</p>';
	}
}
echo '
<p style="clear: both"><a href="?page=STsimpleticket">&laquo; back to list</p>';
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
//Validate the form data before adding in to the database

function validate_form_data($data) {

	//covert the entered dates dates


	// Add custom validators
	GUMP::add_validator("equal_to_zero", function($field, $input, $param = NULL) {
		$result = $input[$field];
		if ($result != 0) {
		return true;
		}
	});
	
	
	//create new validation object Validates the ticket
	$ticketValidator = new GUMP();
	$noteValidator = new GUMP();
	
	//Define rules for the ticket data
	$ticketRules = array (
		'customer_name'						=> 'required|valid_name',
		'site_name'							=> 'required|alpha_space',
		'site_address_street'				=> 'required|alpha_space',
		'site_address_suburb'				=> 'valid_name',
		'site_address_city'					=> 'required|valid_name',
		'site_contact_name'					=> 'required|valid_name',
		'site_contact_phone'				=> 'numeric',
		'technician_name'					=> 'valid_name',
		'job_manager'						=> 'valid_name',
		'planned_start_date'				=> 'required|date',
		'planned_finish_date'				=> 'required|date',
		'completion_date'					=> 'date',
		'department'						=> 'equal_to_zero|max_numeric,4',
		'priority'							=> 'equal_to_zero|max_numeric,3',
		'status'							=> 'equal_to_zero|max_numeric,3',
		'compliance_certificate_required'	=> 'equal_to_zero|max_numeric,2',
		'compliance_certificate_number'		=> 'numeric',
		'affiliate_job_number'				=> 'numeric',
		'last_updated'						=> 'date'
	);
	
	if($data[compliance_certificate_required] == 1) {
		$ticketRules["compliance_certificate_number"] = "required";
	}

	
	//Define filters to remove bad data from ticket
	$ticketFilters = array (
		'customer_name'						=> 'sanitize_string',
		'site_name'							=> 'sanitize_string',
		'site_address_street'				=> 'sanitize_string',
		'site_address_suburb'				=> 'sanitize_string',
		'site_address_city'					=> 'sanitize_string',
		'site_contact_name'					=> 'sanitize_string',
		'site_contact_phone'				=> 'sanitize_string',
		'technician_name'					=> 'sanitize_string',
		'job_manager'						=> 'sanitize_string',
		'job_description'					=> 'sanitize_string',
		'special_requests'					=> 'sanitize_string',
		'compliance_certificate_number'		=> 'sanitize_string',
		'known_site_hazards'				=> 'sanitize_string',
		'affiliate_job_number'				=> 'sanitize_string',
		'description_of_repair'				=> 'sanitize_string'
	
	);
	
	$noteRules = array (
		//
	)
	
	//filter the data first before validating, data changed after filtering could become invalid of malicious
	$data = $ticketValidator->filter($data, $ticketFilters);
	
	//run validation
	$validated = $ticketValidator->validate($data, $ticketRules);
	
	//Check that the validation was successful
	if($validated === TRUE)
	{
		echo "Successful Validation\n\n";
		return "success";
	}
	else
	{		
		//print_r($validated); // Shows all the rules that failed along with the data
		echo $ticketValidator->get_readable_errors(true);
		return "err";
	}
}


//========================================================================================
//update an existing ticket in the database
function ST_ticket_update($data) {
    global $wpdb, $current_user;
	
//add in data validation and error checking here before updating the database!!

	if (validate_form_data($data) == "success")
	{
		$wpdb->update('ST_ticket',
			  array( 
				'author_id' => $current_user->ID,
				'visibility' => $data['visibility'],
				'customer_name' => stripslashes_deep($data['customer_name']),
				'site_name' => stripslashes_deep($data['site_name']),
				'site_address_street' => stripslashes_deep($data['site_address_street']),
				'site_address_suburb' => stripslashes_deep($data['site_address_suburb']),
				'site_address_city' => stripslashes_deep($data['site_address_city']),
				'site_contact_name' => stripslashes_deep($data['site_contact_name']),
				'site_contact_phone' => stripslashes_deep($data['site_contact_phone']),
				'technician_name' => stripslashes_deep($data['technician_name']),
				'job_manager' => stripslashes_deep($data['job_manager']),
				'job_description' => stripslashes_deep($data['job_description']),
				'special_requests' => stripslashes_deep($data['special_requests']),
				'planned_start_date' => date("Y-m-d", strtotime($data['planned_start_date'])),
				'planned_finish_date' => date("Y-m-d", strtotime($data['planned_finish_date'])),
				'completion_date' => date("Y-m-d", strtotime($data['completion_date'])),
				'compliance_certificate_required' => stripslashes_deep($data['compliance_certificate_required']),
				'compliance_certificate_number' => stripslashes_deep($data['compliance_certificate_number']),
				'known_site_hazards' => stripslashes_deep($data['known_site_hazards']),
				'affiliate_job_number' => stripslashes_deep($data['affiliate_job_number']),
				'description_of_repair' => stripslashes_deep($data['description_of_repair']),
				'last_updated' => date("Y-m-d"),
				'department' => stripslashes_deep($data['department']),
				'priority' => stripslashes_deep($data['priority']),
				'status' => stripslashes_deep($data['status'])),
			  array( 'id' => $data['hid']));
		$msg = "Ticket ".$data['hid']." has been updated";
		
		$wpdb->insert( 'ST_notes',
		array(
			'fgn_job_id' => $data['hid'],
			'customer_notes' => $data['notes'],
			'note_date' => date("Y-m-d")),
			array('%s', '%s', '%s' ));
		return $msg;
	}
	else
	{
		$msg = "invalid data entered";
		return $msg;
	}		
}

//========================================================================================
//add a new ticket to the database
function ST_ticket_insert($data) {
    global $wpdb, $current_user;

//add in data validation and error checking here before updating the database!!

	if (validate_form_data($data) == "success")
	{
		$wpdb->insert( 'ST_ticket',
			  array(
				'author_id' => $current_user->ID,
				'entry_date' => date("Y-m-d"),
				'visibility' => $data['visibility'],
				'customer_name' => stripslashes_deep($data['customer_name']),
				'site_name' => stripslashes_deep($data['site_name']),
				'site_address_street' => stripslashes_deep($data['site_address_street']),
				'site_address_suburb' => stripslashes_deep($data['site_address_suburb']),
				'site_address_city' => stripslashes_deep($data['site_address_city']),
				'site_contact_name' => stripslashes_deep($data['site_contact_name']),
				'site_contact_phone' => stripslashes_deep($data['site_contact_phone']),
				'technician_name' => stripslashes_deep($data['technician_name']),
				'job_manager' => stripslashes_deep($data['job_manager']),
				'job_description' => stripslashes_deep($data['job_description']),
				'special_requests' => stripslashes_deep($data['special_requests']),
				'planned_start_date' => date("Y-m-d", strtotime($data['planned_start_date'])),
				'planned_finish_date' => date("Y-m-d", strtotime($data['planned_finish_date'])),
				'completion_date' => date("Y-m-d", strtotime($data['completion_date'])),
				'compliance_certificate_required' => stripslashes_deep($data['compliance_certificate_required']),
				'compliance_certificate_number' => stripslashes_deep($data['compliance_certificate_number']),
				'known_site_hazards' => stripslashes_deep($data['known_site_hazards']),
				'affiliate_job_number' => stripslashes_deep($data['affiliate_job_number']),
				'description_of_repair' => stripslashes_deep($data['description_of_repair']),
				'last_updated' => date("Y-m-d"),
				'department' => stripslashes_deep($data['department']),
				'priority' => stripslashes_deep($data['priority']),
				'status' => stripslashes_deep($data['status'])),
			  array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
		$msg = "A ticket entry has been added";
		
		$wpdb->insert('ST_notes',
		array(
			'fgn_job_id' => $data['hid'],
			'customer_notes' => $data['notes'],
			'note_date' => date("Y-m-d")),
			array('%s', '%s' ));
		return $msg;
	}
	else {
		$msg = "invalid data entered";
		return $msg;
	}
}

//========================================================================================
function ST_ticket_list() {
   global $wpdb, $current_user;

   //prepare the query for retrieving the ticket's from the database
   $query = "SELECT
   id,
   author_id,
   entry_date,
   visibility,
   customer_name,
   technician_name,
   job_description,
   planned_start_date,
   planned_finish_date,
   completion_date,
   affiliate_job_number,
   last_updated,
   department,
   priority,
   status
   FROM ST_ticket ORDER BY entry_date DESC";
   $alltickets = $wpdb->get_results($query);

   //prepare the table and use a default WP style - wp-list-table widefat
   echo '<table class="wp-list-table widefat">
		<thead>
		<tr>
			<th scope="col" class="manage-column">Job Number</th>
			<th scope="col" class="manage-column">Created</th>
			<th scope="col" class="manage-column">Author</th>
			<th scope="col" class="manage-column">Visibility</th>
			<th scope="col" class="manage-column">customer_name</th>
			<th scope="col" class="manage-column">technician_name</th>
			<th scope="col" class="manage-column">job_description</th>
			<th scope="col" class="manage-column">planned_start_date</th>
			<th scope="col" class="manage-column">planned_finish_date</th>
			<th scope="col" class="manage-column">completion_date</th>
			<th scope="col" class="manage-column">affiliate_job_number</th>
			<th scope="col" class="manage-column">last_updated</th>
			<th scope="col" class="manage-column">Department</th>
			<th scope="col" class="manage-column">priority</th>
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
	   echo '<td><strong><a href="'.$edit_link.'" title="Edit Job#">' . $ticket->id . '</a></strong>';
	   echo '<div class="row-actions">';
	   echo '<span class="edit"><a href="'.$edit_link.'" title="Edit this item">Edit</a></span> | ';
	   echo '<span class="view"><a href="'.$view_link.'" title="View this item">View</a></span> | ';
	   echo '<span class="trash"><a href="'.$delete_link.'" title="Move this item to Trash" onclick="return doDelete();">Trash</a></span>';
	   echo '</div>';
	   echo '</td>';
	   echo '<td>' . $ticket->entry_date . '</td>';
	   echo '<td>' . $user_info->user_login . '</td>';
	   
//display the visibility in words depending on the current visibility value in the database - 0 or 1	   
	   $visibility = array('Private', 'Public');
 	   echo '<td>' . $visibility[$ticket->visibility] . '</td>';
	   echo '<td>' . $ticket->customer_name . '</td>';
	   echo '<td>' . $ticket->technician_name . '</td>';
	   echo '<td>' . $ticket->job_description . '</td>';
	   echo '<td>' . $ticket->planned_start_date . '</td>';
	   echo '<td>' . $ticket->planned_finish_date . '</td>';
	   echo '<td>' . $ticket->completion_date . '</td>';
	   echo '<td>' . $ticket->affiliate_job_number . '</td>';
	   echo '<td>' . $ticket->last_updated . '</td>';
	   $department = array(' ', 'Server Support', 'Network Support', 'Hardware Support', 'Data Support');
	   echo '<td>' . $department[$ticket->department] . '</td>';
	   $priority = array(' ', 'Low','High','Urgent','Critical');
	   echo '<td>' . $priority[$ticket->priority] . '</td>';
	   $status = array(' ', 'Pending','Open','Closed');
	   echo '<td>' . $status[$ticket->status] . '</td></tr>';
    }
   echo '</tbody></table>';
	
//small piece of javascript for the delete confirmation	
	echo "<script type='text/javascript'>
			function doDelete() { if (!confirm('Are you sure?')) return false; }
		  </script>";
}

//========================================================================================
//Create a dynamic dropdown menu for the form
function dropdown( $name, array $options, $selected=null )
{
    // begin the select
    $dropdown = '<select name="'.$name.'" id="'.$name.'">'."\n";

    $selected = $selected;
    // loop over the options
    foreach( $options as $key=>$option )
    {
        // assign a selected value
        $select = $selected==$key ? ' selected' : null;

        // add each option to the dropdown
        $dropdown .= '<option value="'.$key.'"'.$select.'>'.$option.'</option>'."\n";
    }

    // close the select
    $dropdown .= '</select>'."\n";

    // and return the completed dropdown
    return $dropdown;
}

//========================================================================================
//this is the form used for the insert as well as the edit/update of the ticket data
function ST_ticket_form($command, $id = null) {
    global $wpdb;

//if the current command is insert then clear the form variables to ensure we have a blank
//form before starting	

//if the current command is 'edit' then retrieve the ticket record based on the id passed to this function
	if ($command == 'update') {
        $ticket = $wpdb->get_row("SELECT * FROM ST_ticket WHERE id = '$id'");
	}

//prepare the draft/published visibility for the HTML check boxes	
	if (isset($ticket)) {
		$privateVisibility = ($ticket->visibility == 0)?"checked":"";
		$pubVisibility   = ($ticket->visibility == 1)?"checked":"";
	}

//prepare the compliance variables for the dropdown menu
	$complianceName = 'compliance_certificate_required';
	$complianceOptions = array('', 'Yes', 'No');
	$complianceSelected = 1;
	
//prepare the priorities variables for the dropdown menu
	$priorityName = 'priority';
	$priorityOptions = array(' ', 'Low', 'High', 'Urgent', 'Critical');
	$prioritySelected = 1;
	
//prepare the department variables for the dropdown menu
	$departmentName = 'department';
	$departmentOptions = array('', 'Server Support', 'Network Support', 'Hardware Support', 'Data Support');
	$departmentSelected = 1;

//prepare the department variables for the dropdown menu
	$statusName = 'status';	
	$statusOptions = array(' ', 'Pending','Open','Closed');
	$statusSelected = 1;
	
//prepare the HTML form	
    echo '
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!-- Load jQuery JS -->
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <!-- Load jQuery UI Main JS  -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	
	<!-- load the data validation script -->
	<script src="http://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
	<script src="http://cdn.jsdelivr.net/jquery.validation/1.13.1/additional-methods.min.js"></script>
	<script type="text/javascript" src="../wp-content/plugins/ST_ticket/plugin.js"></script>
	<!-- load the styling for the validation -->
	<link rel="stylesheet" href="../wp-content/plugins/ST_ticket/custom.css">

	<form name="STform" id="STform" method="post" action="?page=STsimpleticket">
		<input type="hidden" name="hid" value="'.$id.'"/>
		<input type="hidden" name="command" value="'.$command.'"/>

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
		<input type="text" name="planned_start_date" class="datepicker" value="'.$ticket->planned_start_date.'" placeholder="Pick a Date" size="20" class="large-text" />
		<p>Planned Finish Date:<br/>
		<input type="text" name="planned_finish_date" class="datepicker" value="'.$ticket->planned_finish_date.'" placeholder="Pick a Date" size="20" class="large-text" />
		<p>Compliance Certificate Required:<br/>
		
		'.dropdown($complianceName, $complianceOptions, $ticket->compliance_certificate_required).'
		<p>Compliance Certificate Number:<br/>
		<input type="text" name="compliance_certificate_number" value="'.$ticket->compliance_certificate_number.'" size="20" class="large-text"/>
		<p>Known Site Hazards:<br/>
		<textarea name="known_site_hazards" rows="5" cols="20" class="large-text">'.$ticket->known_site_hazards.'</textarea>
		<p>Affiliate Job Number:<br/>
		<input type="text" name="affiliate_job_number" value="'.$ticket->affiliate_job_number.'" size="20" class="large-text"/>
		<p>Description of Repair:<br/>
		<textarea name="description_of_repair" rows="5" cols="20" class="large-text">'.$ticket->description_of_repair.'</textarea>
		<p>Department:<br/>
		
		'.dropdown($departmentName, $departmentOptions, $ticket->department).'
		<p>Priority:<br/>
		
		'.dropdown($priorityName, $priorityOptions, $ticket->priority).'
		<p>Status:<br/>
		
		'.dropdown($statusName, $statusOptions, $ticket->status).'
		<p>Completion Date:<br/>
		<input type="text" name="completion_date" class="datepicker" value="'.$ticket->completion_date.'" placeholder="Pick a Date" size="20" class="large-text" />
		<p><input name="notes_button" id="notes_button" type="button" value="Add Note" onclick="showNotes()"></p>
		<p>Visibility:<br/>
		<label><input type="radio" name="visibility" value="0" '.$privateVisibility.'> Private</label> 
		<label><input type="radio" name="visibility" value="1" '.$pubVisibility.'> Public</label> 
		</p>
		
		
		<div id="toggleNotes" style="display: none">
			<p>Notes:<br/>
			<textarea name="notes" type="hidden" rows="5" cols="20" class="large-text"></textarea>
		</div>
		
		<p class="submit"><input type="submit" name="Submit" value="Save Changes" class="button-primary" /></p>
		</form>';
		

}
 ?>
