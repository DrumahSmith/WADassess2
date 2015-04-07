<?php
/*
Plugin Name: WAD course - 9. Master Detail DB demo
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This plugin demonstrates master-detail database relationships without CRUD.
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
	12APR2013 - Initial release.
	27JAN2014 - Fixed some minor bugs. Tested against WP3.8.1			
	
*/
/*-------------------------------------------------------------------------------------------
 * Wordpress globals - http://codex.wordpress.org/User:CharlesClarkson/Global_Variables
 * 					 - http://codex.wordpress.org/Function_Reference
 * Database object - http://codex.wordpress.org/Class_Reference/wpdb
 * 				   - http://codex.wordpress.org/Database_Description

 -------------------------------------------------------------------------------------------*/

//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}
 
/*-------------------------------------------------------------------------------------------
 * Add the shortcode [listcustomers] to a post or new page
 * WARNING: make sure you load up the 'extra_tables.sql' file into your database before testing this code
 */
 
 //add the shortcode
add_shortcode('listcustomers','WADlistcustomers');
function WADlistcustomers() {
	global $wpdb; //gain access to the wordpress database system
	global $page_id; //the id of the current wordpress page

//check if the 	table exists

	$table_name = "wad_customers";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		echo "<h2>WARNING: make sure you load up the 'extra_tables.sql' file into your database before testing this code</h2>";
		return;
	}
	
	
//set up the default values for our various variables - these will get over written later
	$orderid = '';
	$customerid = '';
	$sortletter = 'A';
	
//handle any incoming _REQUEST data
	if (isset($_REQUEST['customerid'])) $customerid = $_REQUEST['customerid'];	
	if (isset($_REQUEST['sortletter'])) $sortletter = $_REQUEST['sortletter'];
	if (isset($_REQUEST['orderid'])) $orderid = $_REQUEST['orderid'];	
		
//display an alphabetical data base filter 
	echo '<h2>[ ';
	for ($i=0;$i<26;$i++) {
		$letter = chr(0x41+$i); //Letter A is 41 in hex
		echo '<a href="?page_id='.$page_id.'&sortletter='.$letter.'"> '.$letter.'</a>';
	}
	echo ' ]</h2>';
	

//list all the customers filtered by the companyname	
	//============================	
	/* This query joins the customer table with the orders table so that we can get a count of the 
	   total number of orders per customer.
	Note: Only customers that actually have orders will be listed
	*/
	$Q  = 'SELECT C.CustomerID,CompanyName,ContactName,ContactTitle, count(O.OrderID) as Orders
		   FROM WAD_customers C, WAD_orders O
		   WHERE CompanyName LIKE "'.$sortletter.'%"
			     AND C.CustomerID = O.CustomerID
		   GROUP BY C.CustomerID';	

	$rows = $wpdb->get_results($Q); //execute the query without the WHERE clause

	//iterate through the result of the query and display the results
	echo '<h2>CUSTOMER LIST</h2>';
	echo '<table><th>Customer ID</th><th>Company Name</th><th> Contact Name</th><th>Contact Title</th><th>Total orders</th>';
	foreach ( $rows as $row ) {
		$CIDurl = '?page_id='.$page_id.'&customerid='.$row->CustomerID.'&sortletter='.$sortletter;
		echo '<tr><td><a href="'.$CIDurl.'">'.$row->CustomerID.'</a></td>';
		echo '<td> '.$row->CompanyName.'</td>';
		echo '<td> '.$row->ContactName.'</td>';
		echo '<td>'.$row->ContactTitle .'</td>';
		echo '<td> '.$row->Orders.'</td></tr>';
	}
	echo '</table>';
	
//list all the orders for a specific customer
	//============================
	if (isset($customerid) and !empty($customerid)) {

		$Q = "SELECT * FROM WAD_orders WHERE CustomerID='".$customerid."'";
		$rows = $wpdb->get_results($Q); //execute the query without the WHERE clause
		
		//iterate through the result of the query and display the results
		echo '<h2>Orders for customer '.$customerid.'</h2>';
		echo '<table><th>Order ID Name</th><th>Ship Name</th><th>Ship Address</th><th>Ship Country</th>';
	
		foreach ( $rows as $row ) {
			$ODurl = '?page_id='.$page_id.'&customerid='.$row->CustomerID.'&orderid='.$row->OrderID.'&sortletter='.$sortletter;
			echo '<tr><td><a href="'.$ODurl.'">'.$row->OrderID.'</a></td>';
			echo '<td> '.$row->ShipName.'</td>';
			echo '<td>'.$row->ShipAddress .'</td>';
			echo '<td>'.$row->ShipCountry .'</td></tr>';
		}
		echo '</table>';		
	}
	
//list the details for a specific order
	//============================
	if (isset($orderid) and !empty($orderid)) {

		$Q = "SELECT * FROM WAD_order_details WHERE OrderID='".$orderid."'";
		$rows = $wpdb->get_results($Q); //execute the query without the WHERE clause
		
		//iterate through the result of the query and display the results
		echo '<h2>Details for the order '.$orderid.'</h2>';
		echo '<table><th>Product ID</th><th>Unit price</th><th>Quantity</th><th>Discount</th>';
	
		foreach ( $rows as $row ) {
			echo '<tr><td>'.$row->ProductID.'</a></td>';
			echo '<td> '.$row->UnitPrice.'</td>';
			echo '<td>'.$row->Quantity .'</td>';
			echo '<td>'.$row->Discount .'</td></tr>';
		}
		echo '</table>';		
	}	
	echo '<img src="'.plugin_dir_url( __FILE__ ).'/WAD9erd.jpg">';
}
?>
