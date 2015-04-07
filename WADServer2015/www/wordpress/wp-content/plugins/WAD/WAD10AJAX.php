<?php
/*
Plugin Name: WAD course - 10. AJAX examples
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This plugin demonstrates some AJAX and JQuery examples.
Author: John Jamieson
Version: 1.1
Author URI: http://http://eitonline.eit.ac.nz/course/view.php?id=72/
Last update: 17 May 2014
*/

/* DEBUGGING NOTE
 * Change the line 81 of the wp-config.php file in the Wordpress root folder
 * from 	define('WP_DEBUG', false);
 * to		define('WP_DEBUG', true);
 * This will enable the debugging and any error messages.
*/
/* CHANGELOG
	13MAY2014 - Initial release.
	17MAY2014 - Total rehash fo this example - now only focuses on AJAX and jQuery examples		
*/
/*-------------------------------------------------------------------------------------------
 * Wordpress globals - http://codex.wordpress.org/User:CharlesClarkson/Global_Variables
 * 					 - http://codex.wordpress.org/Function_Reference
 * Include JS/CSS  - http://codex.wordpress.org/Function_Reference/wp_enqueue_script
					 http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 
 -------------------------------------------------------------------------------------------*/
//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>'; var_dump($var); echo '</pre>';}
}

//-------------------------------------------------------------------
/* add in the jquery library and AJAX support to our plugin 
 * add in our custom CSS and custom js for form validation
 * https://github.com/malsup/form
 * http://bassistance.de/jquery-plugins/jquery-plugin-validation/
 * http://docs.jquery.com/Plugins/Validation
 */
add_action( 'wp_enqueue_scripts', 'WAD_load_scripts' );
function WAD_load_scripts() {
//custommmm styles
    wp_enqueue_style( 'WAD11', plugins_url('css/WAD11.css',__FILE__));
    wp_enqueue_style( 'jquery-ui', plugins_url('css/jquery-ui.css',__FILE__));
//add in jquery for the AJAX	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-datepicker');
	wp_enqueue_script( 'jquery_validate',plugins_url('js/jquery.validate.js',__FILE__) );
	wp_enqueue_script( 'jquery_forms',plugins_url('js/jquery.form.js',__FILE__) );
	wp_enqueue_script( 'json2' ); //required for AJAX to work with JSON	
}

//-------------------------------------------------------------------
/* register our own request variables so that wordpress can use them 
   when our plugin is called as a URL
   try this: http://localhost/wordpress/faq?action=A&query=ABC
   the result will just be "Testing action A with ABC"
*/
add_filter('query_vars','WAD_add_AJAX_query_vars');
function WAD_add_AJAX_query_vars($vars) {
	$vars[] = 'action';
    return $vars;
}
//-------------------------------------------------------------------
//backend (server) AJAX handler to take care of our custom request variables - ideal for AJAX activity
add_action('parse_request', 'WAD_AJAX_query_handler');
function WAD_AJAX_query_handler() {	
	//only process messages for our AJAX
	if (isset($_GET['action']) && !empty($_GET['action'])) {
		$msg = $_GET['query'];
		$action = $_GET['action'];		
		switch ($action) {
			case 'A':  echo 'Testing action A with '.$msg;
				break;
			case 'B':  echo 'Testing action B with '.$msg;
				break;
			case 'C':  echo 'Testing action C with '.$msg;
				break;
		}
		exit;	//important for our AJAX to work without returning the whole page
	}
}	

add_shortcode('ajaxdemo','WAD_ajaxdemo');  
function WAD_ajaxdemo() {
	global $page_id;
// frontend ajax javascript to the browser
?> <script>


//----------------AJAX for the form with validation
	jQuery(function() {
		jQuery( "#startdate" ).datepicker();
		jQuery( "#enddate" ).datepicker();		
	});
	
    jQuery(document).ready(function(){
    jQuery("#first-form").validate({
            rules: {
                fullName: {           //input name: fullName
                    required: true,   //required boolean: true/false
                    minlength: 5,       
                },
                email: {              //input name: email
                    required: true,   //required boolean: true/false
                    email: true       //required boolean: true/false
                },
                oneline: {            //input name: some random one liner
                    required: true,   //required boolean: true/false
                    minlength: 5
                },
                multiline: {            //input name: multi line/textarea
                    required: true,
                    minlength: 1
                }
            },
            messages: {               //messages to appear on error
                fullName: {
                      required:"Please put your full name.",
                      minlength:"Enter a longer name please."
                      },
                email: "Enter a valid email.",
                subject: {
                      required: "Enter a one line",
                      minlength: ""
                      },
                message: {
                      required: "Enter up to 6 lines",
                      minlength: "Please complete your thoughts, then submit."
                      }
            },
            submitHandler: function(form) {
					jQuery(form).ajaxSubmit({
                           url: "?page_id=<?php echo $page_id;?>&cmd=save",
                           type:"POST",
                        success: function(){
                            jQuery('#first-form').hide();
                            jQuery('#sent').show();
						}
                    });
            }

        });  
	});
	
	//------------ AJAX code using the XMLHttpRequest method
	function XMLHttpMethod(str)	{
		var xmlhttp;    

		//check if the string is empty
		if (str=="") {
			document.getElementById("OneLiner").value="";
			return;
		}
		
		//setup the XMLHttpRequest object for use
		if (window.XMLHttpRequest) {
			xmlhttp=new XMLHttpRequest();
		}
		
		//register an event handler for the AJAX response from the server
		xmlhttp.onreadystatechange=function()	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("OneLiner").value=xmlhttp.responseText;
			}
		}
		
		xmlhttp.open("GET","?action=B&query="+str,true);
		xmlhttp.send();
	}
	
	//------------ AJAX code using the jQuery library
	function jQueryMethod(str) {
		jQuery.ajax({
			url: "?action=A",
			data: {
				query: str  
			},
			success: function( data ) {
				jQuery( "#OneLiner" ).val(data);
			}});
	}
	</script>
	
	<div id="contact" class="corner-5">
			<h2>Sample AJAX powered form</h2>
			<form id="first-form" method="post">
            <input class="input required error" type="text" name="fullName" title="What is your name & family name?"/>
            <input class="input required error" type="text" name="email" title="Your email please."/>
			<input class="input required error" type="text" name="startdate" id="startdate">
			<input class="input required error" type="text" name="enddate" id="enddate">
				<select class="input" name="EXAMPLE_SELECT_A" onchange="jQueryMethod(this.value)">
					<option value="">Select using jQuery:</option>
					<option value="ABC">ABC</option>
					<option value="DEF ">DEF</option>
					<option value="GHI">GHI</option>
				</select>&nbsp;or
				<select class="input" name="EXAMPLE_SELECT_B" onchange="XMLHttpMethod(this.value)">
					<option value="">Select using XMLHTTP:</option>
					<option value="JKL">JKL</option>
					<option value="LMN">LMN</option>
					<option value="OPQ">OPQ</option>
				</select>				
            <input class="input required error" type="text" name="oneline" id="OneLiner" title="Random line of text"/>
            <textarea class="txt-input required error" name="multiline" rows="6"></textarea>
            <input class="submit" type="submit" name="submit" value="submit"/>
        </form>
        <div id="sent">Sucessfully sent</div>
    </div>
<?php
}


?>