<?php

class web_dor_general_settings_page_class{
	
	public $generalsettings;
	
	public $shortgeneralsettings;

	public $options_generalsettings;
	
	function __construct(){
		
		global $exclusive_special_id_for_db, $exclusive_web_dor;
		/// initial params
		$this->generalsettings = "General Settings";
		$this->shortgeneralsettings = $exclusive_special_id_for_db."";
		
		
		/// get options from data base
		
		$value_of_std[0] = get_theme_mod($this->shortgeneralsettings."_logo_img", '');
		$value_of_std[1] = get_theme_mod($this->shortgeneralsettings."_body_back", '');
		$value_of_std[2] = get_theme_mod($this->shortgeneralsettings."_custom_css", '');
		$value_of_std[3] = get_theme_mod($this->shortgeneralsettings."_favicon_img", '');
		$value_of_std[4] = get_theme_mod($this->shortgeneralsettings."_blog_style", '');
		$value_of_std[5] = get_theme_mod($this->shortgeneralsettings."_grab_image", '');
		$value_of_std[6] = get_theme_mod($this->shortgeneralsettings."_show_twitter_icon", 'on');
		$value_of_std[7] = get_theme_mod($this->shortgeneralsettings."_show_rss_icon", 'on');
		$value_of_std[8] = get_theme_mod($this->shortgeneralsettings."_show_facebook_icon", 'on');
		$value_of_std[9] = get_theme_mod($this->shortgeneralsettings."_twitter_url", '');
		$value_of_std[10] = get_theme_mod($this->shortgeneralsettings."_rss_url", '');
		$value_of_std[11] = get_theme_mod($this->shortgeneralsettings."_facebook_url", '');
		$value_of_std[12] = get_theme_mod($this->shortgeneralsettings."_our_style", '');
		$value_of_std[13] = get_theme_mod($this->shortgeneralsettings."_menu_search_form", '');
		$value_of_std[14] = get_theme_mod($this->shortgeneralsettings."_post_header", '');
		$value_of_std[15] = get_theme_mod($this->shortgeneralsettings."_favicon_enable", '');
		$value_of_std[16] = get_theme_mod($this->shortgeneralsettings."_date_enable", 'on');
		$value_of_std[17] = get_theme_mod($this->shortgeneralsettings."_footer_text", '<span id="copyright">WordPress Themes by <a href="'.$exclusive_web_dor.'/wordpress-themes/exclusive.html"  target="_blank" title="Web-Dorado">Web-Dorado</a></span>');

		
		$this->options_generalsettings = array(
			
			'logo_img' => array(
			
				"name" => "Logo",
				
				"sanitize_type" => "esc_url_raw",
				
				"description" => "You can apply a custom logo image by clicking on the Upload Image button and uploading your image.",
				
				"var_name" => "logo_img",
				
				"id" => $this->shortgeneralsettings."_logo_img",
				
				"std" => $value_of_std[0]
				
			),
			
			'body_back' => array(
			
				"name" => "General Settings",
				
				"description" => "",
				
				"var_name" => "body_back",
				
				"id" => $this->shortgeneralsettings."_body_back",
				
				"std" => $value_of_std[1]
				
			),
			
			'custom_css' => array(
			
				"name" => "Custom CSS",
				
				"description" => "Custom CSS will change the visual style of the site. This CSS code will be inserted in the &lt;head&gt; tag of your site. You can provide custom CSS code to be applied to specific elements.",
				
				"var_name" => "custom_css",
				
				"id" => $this->shortgeneralsettings."_custom_css",
				
				"std" => $value_of_std[2]
			),
			
			'favicon_img' => array(
			
				"name" => "",
				
				"sanitize_type" => "esc_url_raw",
				
				"description" => "You can apply a custom favicon image by clicking on the Upload Image button and uploading your image.",
				
				"var_name" => "favicon_img",
				
				"id" => $this->shortgeneralsettings."_favicon_img",
				
				"std" => $value_of_std[3]
				
			),
			
			'blog_style' => array(
			
				"name" => "Blog Style Post Format",
				
				"description" => "Here you can choose to change the format of your index/homepage posts and view them as short post previews.",
				
				"var_name" => "blog_style",
				
				"id" => $this->shortgeneralsettings."_blog_style",
				
				"std" => $value_of_std[4]
			),
			
			'grab_image' => array(
			
				"name" => "Grab the First Post Image",
				
				"description" => "Enable this option if you want to use the images that are already in your post to create a thumbnail
											without using custom fields. In this case thumbnail images will be generated automatically using the
											first added image of the post. Note that the image needs to be hosted on your own server.",
				
				"var_name" => "grab_image",
				
				"id" => $this->shortgeneralsettings."_grab_image",
				
				"std" => $value_of_std[5]
			),
			
			'show_twitter_icon' => array(
				
				"name" => "Show Twitter Icon",
				
				"description" => "Here you can choose to show the Twitter Icon.",
				
				"var_name" => "show_twitter_icon",
				
				"id" => $this->shortgeneralsettings."_show_twitter_icon",
				
				"std" => $value_of_std[6]
			),
			
			'show_rss_icon' => array(
			
				"name" => "Show RSS Icon",
				
				"description" => "Here you can choose to show the RSS Icon.",
				
				"var_name" => "show_rss_icon",
				
				"id" => $this->shortgeneralsettings."_show_rss_icon",
				
				"std" => $value_of_std[7]
				
			),
			
			'show_facebook_icon' => array(
				
				"name" => "Show Facebook Icon",
				
				"description" => "Here you can choose to show the Facebook Icon.",
				
				"var_name" => "show_facebook_icon",
				
				"id" => $this->shortgeneralsettings."_show_facebook_icon",
				
				"std" => $value_of_std[8]
				
			),
			
			'twitter_url' => array(
			
				"name" => "",
				
				"sanitize_type" => "esc_url_raw",
				
				"description" => "Enter your Twitter Profile URL below.",
				
				"var_name" => "twitter_url",
				
				"id" => $this->shortgeneralsettings."_twitter_url",
				
				"std" => $value_of_std[9]
				
			),
			
			'rss_url' => array(
			
				"name" => "",
				
				"sanitize_type" => "esc_url_raw",
				
				"description" => "Enter your RSS URL below.",
				
				"var_name" => "rss_url",
				
				"id" => $this->shortgeneralsettings."_rss_url",
				
				"std" => $value_of_std[10]
				
			),
			
			'facebook_url' => array(
			
				"name" => "",
				
				"sanitize_type" => "esc_url_raw",
				
				"description" => "Enter your Facebook Profile URL below.",
				
				"var_name" => "facebook_url",
				
				"id" => $this->shortgeneralsettings."_facebook_url",
				
				"std" => $value_of_std[11]
				
			),				
			
			'our_style' => array(
			
				"name" => "General Settings",
				
				"description" => "",
				
				"var_name" => "our_style",
				
				"id" => $this->shortgeneralsettings."_our_style",
				
				"std" => $value_of_std[12]
				
			),
			
			'menu_search_form' => array(
			
				"name" => "General Settings",
				
				"description" => "",
				
				"var_name" => "menu_search_form",
				
				"id" => $this->shortgeneralsettings."_menu_search_form",
				
				"std" => $value_of_std[13]
				
			),
			
			'post_header' => array(
			
				"name" => "General Settings",
				
				"description" => "",
				
				"var_name" => "post_header",
				
				"id" => $this->shortgeneralsettings."_post_header",
				
				"std" => $value_of_std[14]
				
			),
			'favicon_enable' => array(
			
				"name" => "Show Favicon",
				
				"description" => "Check the box to show favicon on the site. You can add custom favicon to your homepage. Press &#34;Upload image&#34; button and choose the corresponding file if the box is checked. By default favicon is a 16 x 16 pixel file saved in favicon.ico format in root directory of the server.",
				
				"var_name" => "favicon_enable",
				
				"id" => $this->shortgeneralsettings."_favicon_enable",
				
				"std" => $value_of_std[15]
				
			),
			'date_enable' => array(
			
				"name" => "Display Date to the Posts",
				
				"description" => "Choose to display date in posts whether or not.",
				
				"var_name" => "date_enable",
				
				"id" => $this->shortgeneralsettings."_date_enable",
				
				"std" => $value_of_std[16]
				
			),
			'footer_text' => array(
			
				"name" => "Information in the Footer",
				
				"description" => "Here you can provide the HTML code to be inserted in the footer of your web site.",
				
				"var_name" => "footer_text",
				
				"id" => $this->shortgeneralsettings."_footer_text",
				
				"std" => $value_of_std[17]
				
			)
		);
		
		
	}


	public function web_dorado_theme_update_and_get_options_general_settings(){	
	
		if ( isset($_GET['page']) && $_GET['page'] ==  "web_dorado_theme" && isset($_GET['controller']) && $_GET['controller'] == "general_page") {
			
			if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {
				
				foreach ($this->options_generalsettings as $value) {
					$sanitize_type='exclusive_do_nothing';
					if(isset($value['sanitize_type']) && $value['sanitize_type'])	
						$sanitize_type=$value['sanitize_type'];
					   set_theme_mod($value['id'], $sanitize_type($_REQUEST[$value['var_name']]));
					
				}
				
				
				header("Location: admin.php?page=web_dorado_theme&controller=general_page&saved=true");
				die;
				
			} 
			else {
				
				if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset' ) {
					
					foreach ($this->options_generalsettings as $value) {
						remove_theme_mod($value['id']);
					}
					
					header("Location: admin.php?page=web_dorado_theme&controller=general_page&reset=true");
					die;
				
				}
			}			
		}	
	}
	public function update_parametr($param_name,$value){
		set_theme_mod($this->options_generalsettings[$param_name]['id'],$value);
	}

	
	public function web_dorado_general_settings_page_admin_scripts(){	
		
		wp_enqueue_style('general_settings_page_main_style',get_template_directory_uri().'/admin/css/general_settings_page.css');	
		wp_enqueue_script('jquery');
		wp_enqueue_script('common');
		wp_enqueue_script('jquery-color');
		wp_print_scripts('editor');
		if (function_exists('add_thickbox')) add_thickbox();
		wp_print_scripts('media-upload');
		//if (function_exists('wp_tiny_mce')) wp_tiny_mce();
		wp_admin_css();
		wp_enqueue_script('utils');
		do_action("admin_print_styles-post-php");
		do_action('admin_print_styles');
	
	}
	
	public function dorado_theme_admin_general_settings(){
		if (isset($_REQUEST['saved']) && $_REQUEST['saved']  && isset($_REQUEST['controller']) && $_REQUEST['controller']=='general_page') 
		
			echo '<div id="message" class="updated"><p><strong>' . $this->generalsettings . ' settings are saved.</strong></p></div>';
			
		if (isset($_REQUEST['reset']) && $_REQUEST['reset']  && isset($_REQUEST['controller']) && $_REQUEST['controller']=='general_page') 
		
			echo '<div id="message" class="updated"><p><strong>' . $this->generalsettings . ' settings are reset.</strong></p></div>';
			
		global $exclusive_admin_helepr_functions, $exclusive_web_dor;
		?>
		
			<script type="text/javascript">
			function open_or_hide_param(cur_element){
				if(cur_element.checked){
					jQuery(cur_element).parent().parent().parent().find('.open_hide').show();
				}
				else
				{
					jQuery(cur_element).parent().parent().parent().find('.open_hide').hide();
				}
				
			}
				

					
			</script>
		<div id="main_general_page">
       
			<table align="center" width="90%" style="margin-top: 0px;border-bottom: rgb(111, 111, 111) solid 2px;">
			    <tr>   
                     <td style="font-size:14px; font-weight:bold">
					     <a href="<?php echo $exclusive_web_dor.'/wordpress-themes-guide-step-1.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">User Manual</a><br />This section allows you to make changes in overall content of the site.
                         <a href="<?php echo $exclusive_web_dor.'/wordpress-theme-options/3-3.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">More...</a>
					 </td>  
                      <td  align="right" style="font-size:16px;">
                           <a href="<?php echo $exclusive_web_dor.'/wordpress-themes/exclusive.html'; ?>" target="_blank" style="color:red; text-decoration:none;">
                              <img src="<?php echo get_template_directory_uri() ?>/images/header.png" border="0" alt="" width="215">
                           </a>
                        </td>
                </tr>
				<tr>
					<td>
						<h3 style="margin: 0px;font-family:Segoe UI;padding-bottom: 15px;color: rgb(111, 111, 111); font-size:18pt;">General</h3>
					</td>
				</tr>
			</table>
			<form method="post" action="themes.php?page=web_dorado_theme&controller=general_page">
					
				<table align="center" width="90%" style=" padding-bottom:0px; padding-top:0px;">
					<tr>
						<td>
							<div id="wrap-general"  class="content-div ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all">
							<?php 
								$exclusive_admin_helepr_functions->only_textarea($this->options_generalsettings['custom_css']); 
								$exclusive_admin_helepr_functions->only_upload($this->options_generalsettings['logo_img']);
								$exclusive_admin_helepr_functions->checkbox_with_upload($this->options_generalsettings['favicon_enable'],$this->options_generalsettings["favicon_img"]); 
								$exclusive_admin_helepr_functions->only_checkbox($this->options_generalsettings['blog_style']); 
								$exclusive_admin_helepr_functions->only_checkbox($this->options_generalsettings['grab_image']); 
								$exclusive_admin_helepr_functions->checkbox_with_input($this->options_generalsettings['show_twitter_icon'],$this->options_generalsettings['twitter_url']); 
								$exclusive_admin_helepr_functions->checkbox_with_input($this->options_generalsettings['show_rss_icon'],$this->options_generalsettings['rss_url']); 
								$exclusive_admin_helepr_functions->checkbox_with_input($this->options_generalsettings['show_facebook_icon'],$this->options_generalsettings['facebook_url']); 
								$exclusive_admin_helepr_functions->only_checkbox($this->options_generalsettings['date_enable']); 
								$exclusive_admin_helepr_functions->only_textarea($this->options_generalsettings['footer_text']); 
							?>
							</div>	
                            <script>
                            jQuery(document).ready(function(e) {
                              jQuery('#main_general_page .with_input').each(function(){
									if(this.checked){
										jQuery(this).parent().parent().parent().find('.open_hide').show();
									}
									else
									{
										jQuery(this).parent().parent().parent().find('.open_hide').hide();
									}
									})
                            });
                            
                            </script>	
						</td>
					</tr>
				</table>
					<br/>
	

		<p class="submit" style="float: left; margin-left: 63px; margin-right: 8px;">
			<input class="button" name="save" type="submit" value="Save changes"/>
			<input type="hidden" name="action" value="save"/>
		</p>
		</form>
		<form method="post" action="themes.php?page=web_dorado_theme&controller=general_page">
			<p class="submit">
				<input class="button" name="reset" type="submit" value="Reset"/>
				<input type="hidden" name="action" value="reset"/>
			</p>
		</form>
		</div>
		<?php

	
	}	

}
 