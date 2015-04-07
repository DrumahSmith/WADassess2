<?php 

$exclusive_theme_name='Exclusive Options'; /// menu theme name

$exclusive_special_id_for_db='exclusive'; // spec identifikator databese

$exclusive_show_logo=true; /// if set tru show web dorado logo in admin panel if false dont show

$exclusive_web_dor='http://web-dorado.com';

///// initial menu

add_action('admin_menu','web_dorado_theme_admin_menu');

/// action save or update after submit
add_action('init','update_and_reset_web_dorado_theme');

/// include functions_class

require( 'includes/class_functions_for_admin.php' );

/// include Layoute page class

require( 'layout_page.php' );

/// include General Settings page class

require( 'general_settings_page.php' );

/// include Home page class

require( 'home_page.php' );


/// include Integration page class

require( 'color_control.php' );

/// include Integration page class

require( 'typography_page.php' );

/// include Integration page class

require( 'slider_page.php' );

/// include Integration page class

require( 'install_sampl_date.php' );

/// include widgets

require( 'widgets/widgets.php' );


/// include Licensing

require( 'licensing.php' );

//// set classes objects

$exclusive_admin_helepr_functions = new web_dor_admin_helper_class();

$exclusive_layout_page = new web_dor_layout_page_class();

$exclusive_general_settings_page = new web_dor_general_settings_page_class();

$exclusive_home_page = new web_dor_home_page_class();

$exclusive_color_control_page = new web_dor_color_control_page_class();

$exclusive_typography_page = new web_dor_typography_page_class();

$exclusive_slider_page = new web_dor_slider_page_class();

$exclusive_sample_date = new exclusive_sample_date();

$exclusive_licensing_page = new expert_licensing_page_class();

/// functions for conected hooks

/// ajax for install sample date
add_action('wp_ajax_install_sample_date',  array(&$exclusive_sample_date,'install_ajax'));

/// ajax for remove sample date
add_action('wp_ajax_remove_sample_date',  array(&$exclusive_sample_date,'remove_ajax'));

function web_dorado_theme_admin_menu(){
	global $exclusive_theme_name;
	$theme_name=$exclusive_theme_name;	
	
	/// create menu for web dorado theme		
	$web_dor_theme_option=add_theme_page( $theme_name, $theme_name, 'manage_options', "web_dorado_theme", 'web_dor_theme_control_pages' );
	add_action('admin_print_styles-' . $web_dor_theme_option, 'web_dorado_theme_admin_scripts');

}


////// this function work  in admin

function update_and_reset_web_dorado_theme(){
	
	if(is_admin()){
		
		global $exclusive_layout_page,$exclusive_general_settings_page,$exclusive_home_page,$exclusive_color_control_page,$exclusive_typography_page,$exclusive_licensing_page;
		$exclusive_layout_page->web_dorado_theme_update_and_get_options_layout();
		$exclusive_general_settings_page->web_dorado_theme_update_and_get_options_general_settings();
		$exclusive_home_page->web_dorado_theme_update_and_get_options_home();
		$exclusive_color_control_page->web_dorado_theme_update_and_get_options_color_control();
		$exclusive_typography_page->web_dorado_theme_update_and_get_options_typography();
		
	}
	
}

/// scripts and styles for admin page

function web_dorado_theme_admin_scripts(){
	
			/// use global page classes for printing scripts
			global 	$exclusive_layout_page,
					$exclusive_general_settings_page,
					$exclusive_home_page,
					$exclusive_color_control_page,
					$exclusive_typography_page,
					$exclusive_slider_page,
					$exclusive_licensing_page,
					$exclusive_sample_date;

			$exclusive_layout_page->web_dorado_layout_page_admin_scripts();
			$exclusive_general_settings_page->web_dorado_general_settings_page_admin_scripts();
			$exclusive_home_page->web_dorado_home_page_admin_scripts();
			$exclusive_color_control_page->web_dorado_color_control_page_admin_scripts();
			$exclusive_typography_page->web_dorado_typography_page_admin_scripts();
			$exclusive_slider_page->web_dorado_slider_page_admin_scripts();
			$exclusive_sample_date->web_dorado_sample_data_admin_scripts();
			$exclusive_licensing_page->web_dorado_licensing_admin_scripts();


}


function web_dor_theme_control_pages(){
	
	global  $exclusive_layout_page,// layout page class
			$exclusive_general_settings_page,// general page class
			$exclusive_home_page,// home page class
			$exclusive_color_control_page,// color page class
			$exclusive_typography_page,// typography page class
			$exclusive_slider_page,// slider page class
			$exclusive_sample_date,// sample_date page class
			$exclusive_licensing_page; // licensing page class
			
			?>
	<style>
	.nav-tab-wrapper a{
		font-size:14px;
	}
	.nav-tab{
	   border-color: #919191 #919191 #fff !important;
	}
	.nav-tab-active{
	   border-color: #727272 #727272 #fff !important;
	}
	h2.nav-tab-wrapper{
	  border-bottom-color:#727272 !important;
	}
	</style>
	
	<script>
	jQuery(document).ready(function($) {
		if (typeof(localStorage) != 'undefined' ) {
			active_tab = localStorage.getItem("active_tab");
		}
		if (active_tab != '' && $(active_tab).length ) {
			$(active_tab).fadeIn();
		} else {
			$('.group:first').fadeIn();
		}
		$('.group .collapsed').each(function(){
			$(this).find('input:checked').parent().parent().parent().nextAll().each( 
				function(){
					if ($(this).hasClass('last')) {
						$(this).removeClass('hidden');
							return false;
						}
					$(this).filter('.hidden').removeClass('hidden');
				});
		});
		if (active_tab != '' && $(active_tab + '-tab').length ) {
			$(active_tab + '-tab').addClass('nav-tab-active');
		}
		else {
			$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
		}
		
		$('.nav-tab-wrapper a').click(function(evt) {
			$('.nav-tab-wrapper a').removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active').blur();
			var clicked_group = $(this).attr('href');
			if (typeof(localStorage) != 'undefined' ) {
				localStorage.setItem("active_tab", $(this).attr('href'));
			}
			$('.group').hide();
			$(clicked_group).fadeIn();
			evt.preventDefault();
			
			// Editor Height (needs improvement)
			$('.wp-editor-wrap').each(function() {
				var editor_iframe = $(this).find('iframe');
				if ( editor_iframe.height() < 30 ) {
					editor_iframe.css({'height':'auto'});
				}
			});
		
		});
								
		$('.group .collapsed input:checkbox').click(unhideHidden);
					
		function unhideHidden(){
			if ($(this).attr('checked')) {
				$(this).parent().parent().parent().nextAll().removeClass('hidden');
			}
			else {
				$(this).parent().parent().parent().nextAll().each( 
				function(){
					if ($(this).filter('.last').length) {
						$(this).addClass('hidden');
						return false;		
						}
					$(this).addClass('hidden');
				});
								
			}
		}
			
		
		// Image Options
		$('.of-radio-img-img').click(function(){
			$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
			$(this).addClass('of-radio-img-selected');		
		});
			
		$('.of-radio-img-label').hide();
		$('.of-radio-img-img').show();
		$('.of-radio-img-radio').hide();
		});
	</script>
	<?php global $exclusive_show_logo; if($exclusive_show_logo){?><div style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/adminheader.png);background-repeat: no-repeat; width: 90%;margin-left: 59px; height: 90px;"></div><?php }?>
	<div id="icon-themes" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
		<a id="options-group-1-tab" class="nav-tab" title="Layout Editor" href="#options-group-1">Layout Editor</a>
		<a id="options-group-2-tab" class="nav-tab" title="General" href="#options-group-2">General</a>
		<a id="options-group-3-tab" class="nav-tab" title="Homepage" href="#options-group-3">Homepage</a>
		<a id="options-group-4-tab" class="nav-tab" title="Color Control" href="#options-group-4">Color Control</a>
		<a id="options-group-5-tab" class="nav-tab" title="Typography" href="#options-group-5">Typography</a>
		<a id="options-group-6-tab" class="nav-tab" title="Slider" href="#options-group-6">Slider</a>
		<a id="options-group-7-tab" class="nav-tab" title="Install Sample Data" href="#options-group-7">Install Sample Data</a>	
		<a id="options-group-8-tab" class="nav-tab" title="Featured Plugins" href="#options-group-8">Licensing</a>	
	</h2>
	<div id="optionsframework-metabox" class="metabox-holder">
	    <div id="optionsframework" class="postbox">
			
				<div id="options-group-1" class="group Layout" style="display: none;"><h3>Layout Editor</h3><?php echo $exclusive_layout_page->dorado_theme_admin_layout(); ?></div>
				<div id="options-group-2" class="group General" style="display: none;"><h3>General</h3><?php echo $exclusive_general_settings_page->dorado_theme_admin_general_settings(); ?></div>
				<div id="options-group-3" class="group Homepage" style="display: none;"><h3>Homepage</h3><?php echo $exclusive_home_page->dorado_theme_admin_home(); ?></div>
				<div id="options-group-4" class="group Color" style="display: none;"><h3>Color Control</h3><?php echo $exclusive_color_control_page->dorado_theme_admin_color_control(); ?></div>
				<div id="options-group-5" class="group Typography" style="display: none;"><h3>Typography</h3><?php echo $exclusive_typography_page->dorado_theme_admin_typography(); ?></div>
				<div id="options-group-6" class="group Slider" style="display: none;"><h3>Slider</h3><?php echo $exclusive_slider_page->web_dorado_theme_admin_slider(); ?></div>
				<div id="options-group-7" class="group Install" style="display: none;"><h3>Install Sample Data</h3><?php echo $exclusive_sample_date->exclusive_install_posts(); ?></div>
				<div id="options-group-8" class="group Licensing" style="display: none;"><h3>Licensing</h3><?php echo $exclusive_licensing_page->dorado_theme_admin_licensing(); ?></div>
		</div>
	
	
	
	
	
	<?php
	
			
			
	
	

}


 


?>