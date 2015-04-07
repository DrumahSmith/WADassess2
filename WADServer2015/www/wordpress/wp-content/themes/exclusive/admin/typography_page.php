<?php

class web_dor_typography_page_class{
	
	public $typography;
	public $shorttypography;	
	public $options_typography;
	
	function __construct(){
		add_action( 'customize_register', array($this,'web_bussines_typography_customize_register') );
		add_action( 'customize_preview_init', array($this,'web_bussines_typography_customize_preview_js') );
		
		$this->typography = "Typography";
		global $exclusive_special_id_for_db;
		$this->shorttypography = $exclusive_special_id_for_db."ty";	
		$value_of_std[0]=get_theme_mod($this->shorttypography."_type_headers_font",'Segoe UI');
		$value_of_std[1]=get_theme_mod($this->shorttypography."_type_headers_kern",'0.00em');
		$value_of_std[2]=get_theme_mod($this->shorttypography."_type_headers_transform",'none');
		$value_of_std[3]=get_theme_mod($this->shorttypography."_type_headers_variant",'normal');
		$value_of_std[4]=get_theme_mod($this->shorttypography."_type_headers_weight",'normal');
		$value_of_std[5]=get_theme_mod($this->shorttypography."_type_headers_style",'normal');
		$value_of_std[6]=get_theme_mod($this->shorttypography."_type_inputs_font",'Segoe UI');
		$value_of_std[7]=get_theme_mod($this->shorttypography."_type_inputs_kern",'0.00em');
		$value_of_std[8]=get_theme_mod($this->shorttypography."_type_inputs_transform",'none');
		$value_of_std[9]=get_theme_mod($this->shorttypography."_type_inputs_variant",'normal');
		$value_of_std[10]=get_theme_mod($this->shorttypography."_type_inputs_weight",'normal');
		$value_of_std[11]=get_theme_mod($this->shorttypography."_type_inputs_style",'normal');
		$value_of_std[12]=get_theme_mod($this->shorttypography."_type_primary_font",'Segoe UI');
		$value_of_std[13]=get_theme_mod($this->shorttypography."_type_primary_kern",'0.00em');
		$value_of_std[14]=get_theme_mod($this->shorttypography."_type_primary_transform",'none');
		$value_of_std[15]=get_theme_mod($this->shorttypography."_type_primary_variant",'normal');
		$value_of_std[16]=get_theme_mod($this->shorttypography."_type_primary_weight",'normal');	
		$value_of_std[17]=get_theme_mod($this->shorttypography."_type_primary_style",'normal');
		$value_of_std[18]=get_theme_mod($this->shorttypography."_type_secondary_font",'Segoe UI');
		$value_of_std[19]=get_theme_mod($this->shorttypography."_type_secondary_kern",'0.00em');
		$value_of_std[20]=get_theme_mod($this->shorttypography."_type_secondary_transform",'none');
		$value_of_std[21]=get_theme_mod($this->shorttypography."_type_secondary_variant",'normal');
		$value_of_std[22]=get_theme_mod($this->shorttypography."_type_secondary_weight",'normal');	
		$value_of_std[23]=get_theme_mod($this->shorttypography."_type_secondary_style",'normal');	
		$this->options_typography = array(
		  	array(
		   
		  	"name" => "Typography",

           	"type" => "title"
			
			),

    		array( 
			
				"type" => "open"
			),

			'type_headers_font'=>array(

				"name" => "Select Font",
				
				"name_customize" => "Header Font",
				
				"var_name" =>'type_headers_font',
				
				"all_values" => $this->fonts_options(),

				"id" =>  $this->shorttypography."_type_headers_font",

				"type" => "select",

				"std" => $value_of_std[0]
			),

			'type_headers_kern'=>array(

				"name" => "Letter Spacing",
				
				"var_name" =>'type_headers_kern',
				
				"all_values" => $this->inputs_kern(),

				"id" =>  $this->shorttypography."_type_headers_kern",

				"type" => "",

				"std" => $value_of_std[1]
			),

			'type_headers_transform'=>array(

				"name" => "Text Transform",
				
				"var_name" =>'type_headers_transform',
				
				"all_values" => $this->text_transform(),

				"id" =>  $this->shorttypography."_type_headers_transform",

				"type" => "",

				"std" => $value_of_std[2]
			),

			'type_headers_variant'=>array(

				"name" => "Variant",
				
				"var_name" =>'type_headers_variant',
				
				"all_values" => $this->text_variant(),

				"id" =>  $this->shorttypography."_type_headers_variant",

				"type" => "",

				"std" => $value_of_std[3]
			),

			'type_headers_weight'=>array(

				"name" => "Weight",
				
				"var_name" =>'type_headers_weight',
				
				"all_values" => $this->text_weight(),

				"id" =>  $this->shorttypography."_type_headers_weight",

				"type" => "",

				"std" => $value_of_std[4]
			),

			'type_headers_style'=>array(

				"name" => "Style",
				
				"var_name" =>'type_headers_style',
				
				"all_values" => $this->text_stylee(),

				"id" =>  $this->shorttypography."_type_headers_style",

				"type" => "",

				"std" => $value_of_std[5]
			),

		
			'type_inputs_font'=>array(

				"name" => "Select Font",
				
				"name_customize" => "Inputs and Text Areas Font",
				
				"var_name" =>'type_inputs_font',
				
				"all_values" => $this->fonts_options(),

				"id" =>  $this->shorttypography."_type_inputs_font",

				"type" => "",

				"std" => $value_of_std[6]
			),

			'type_inputs_kern' => array(

				"name" => "Letter Spacing",
				
				"var_name" =>'type_inputs_kern',
				
				"all_values" => $this->inputs_kern(),

				"id" =>  $this->shorttypography."_type_inputs_kern",

				"type" => "",

				"std" => $value_of_std[7]
			),

			'type_inputs_transform'=>array(

				"name" => "Text Transform",
				
				"var_name" =>'type_inputs_transform',
				
				"all_values" => $this->text_transform(),

				"id" =>  $this->shorttypography."_type_inputs_transform",

				"type" => "",

				"std" => $value_of_std[8]
			),

			'type_inputs_variant'=>array(

				"name" => "Variant",
				
				"var_name" =>'type_inputs_variant',
				
				"all_values" => $this->text_variant(),

				"id" =>  $this->shorttypography."_type_inputs_variant",

				"type" => "",

				"std" => $value_of_std[9]
			),

			'type_inputs_weight'=>array(

				"name" => "Weight",
				
				"var_name" =>'type_inputs_weight',
				
				"all_values" => $this->text_weight(),
				
				"id" =>  $this->shorttypography."_type_inputs_weight",

				"type" => "",

				"std" => $value_of_std[10]
			),

			'type_inputs_style'=>array(

				"name" => "Style",
				
				"var_name" =>'type_inputs_style',
				
				"all_values" => $this->text_stylee(),

				"id" =>  $this->shorttypography."_type_inputs_style",

				"type" => "",

				"std" => $value_of_std[11]
			),

		
			'type_primary_font'=>array(

				"name" => "Select Font",
				
				"name_customize" => "Primary Font (Body)",
				
				"var_name" =>'type_primary_font',
				
				"all_values" => $this->fonts_options(),

				"id" =>  $this->shorttypography."_type_primary_font",

				"desc" => "",

				"type" => "",

				"std" => $value_of_std[12]
				),

			'type_primary_kern'=>array(

				"name" => "Letter Spacing",
				
				"var_name" =>'type_primary_kern',
				
				"all_values" => $this->inputs_kern(),

				"id" =>  $this->shorttypography."_type_primary_kern",

				"type" => "",

				"std" => $value_of_std[13]
			),

			'type_primary_transform'=>array(

				"name" => "Text Transform",
				
				"var_name" =>'type_primary_transform',
				
				"all_values" => $this->text_transform(),

				"id" =>  $this->shorttypography."_type_primary_transform",

				"type" => "",

				"std" => $value_of_std[14]
			),

			'type_primary_variant'=>array(

				"name" => "Variant",
				
				"var_name" =>'type_primary_variant',
				
				"all_values" => $this->text_variant(),

				"id" =>  $this->shorttypography."_type_primary_variant",
				
				"type" => "",

				"std" => $value_of_std[15]
			),

			'type_primary_weight'=>array(

				"name" => "Weight",
				
				"var_name" =>'type_primary_weight',
				
				"all_values" => $this->text_weight(),

				"id" =>  $this->shorttypography."_type_primary_weight",

				"type" => "",

				"std" => $value_of_std[16]
			),

			'type_primary_style'=>array(

				"name" => "Style",
				
				"var_name" =>'type_primary_style',
				
				"all_values" => $this->text_stylee(),

				"id" =>  $this->shorttypography."_type_primary_style",

				"type" => "",

				"std" => $value_of_std[17]
			),

		
			'type_secondary_font'=>array(

				"name" => "Select Font",
				
				"name_customize" => "Secondary Font (Subtitle)",
				
				"var_name" =>'type_secondary_font',
				
				"all_values" => $this->fonts_options(),

				"id" =>  $this->shorttypography."_type_secondary_font",

				"type" => "",

				"std" => $value_of_std[18]
			),

			'type_secondary_kern'=>array(

				"name" => "Letter Spacing",
				
				"var_name" =>'type_secondary_kern',
				
				"all_values" => $this->inputs_kern(),

				"id" =>  $this->shorttypography."_type_secondary_kern",

				"type" => "",

				"std" => $value_of_std[19]
			),

			'type_secondary_transform'=>array(

				"name" => "Text Transform",
				
				"var_name" =>'type_secondary_transform',
				
				"all_values" => $this->text_transform(),

				"id" =>  $this->shorttypography."_type_secondary_transform",
				
				"type" => "",

				"std" => $value_of_std[20]
			),

			'type_secondary_variant'=>array(

				"name" => "Variant",
				
				"var_name" =>'type_secondary_variant',
				
				"all_values" => $this->text_variant(),

				"id" =>  $this->shorttypography."_type_secondary_variant",

				"type" => "",

				"std" => $value_of_std[21]
			),

			'type_secondary_weight'=>array(

				"name" => "Weight",
				
				"var_name" =>'type_secondary_weight',
				
				"all_values" => $this->text_weight(),

				"id" =>  $this->shorttypography."_type_secondary_weight",

				"type" => "",

				"std" => $value_of_std[22]
			),

			'type_secondary_style'=>array(

				"name" => "Style",
				
				"var_name" =>'type_secondary_style',
				
				"all_values" => $this->text_stylee(),

				"id" =>  $this->shorttypography."_type_secondary_style",

				"type" => "",

				"std" => $value_of_std[23]
			),
			array(
			 
				"type" => "close"
			)
		);
				
	}

    public function web_bussines_typography_customize_preview_js() {
	 	wp_enqueue_script( 'web_bussines-customizer', get_template_directory_uri() . '/scripts/theme-customizer.js', array( 'customize-preview' ) );
	}
	
	
	public function web_bussines_typography_customize_register( $wp_customize ) {
				 
		  $wp_customize->add_section( 'fonts' , array(
			'title'   => __( 'Fonts', 'sp_webBusiness' ),
			'priority'  => 50,
		  ) );
		  foreach($this->options_typography as $key=>$spec_font)
		  {
		   if(isset($spec_font['name'])){
		    if($spec_font['name']=='Select Font'){
				  $wp_customize->add_setting( 'theme_mods_exclusive['.$spec_font['id'].']', array(
					'default'   => $spec_font['std'],
					'type'      => 'option',
					'capability'  => 'edit_theme_options',
					'sanitize_callback'=>'sanitize_text_field',
					'transport'   => 'postMessage'
				  ) );
				  $wp_customize->add_control( 'theme_mods_exclusive['.$spec_font['id'].']', array(
					'label'   => $spec_font['name_customize'],
					'section' => 'fonts',
					'settings'  => 'theme_mods_exclusive['.$spec_font['id'].']',
					'type'    => 'select',
					'choices' => $this->fonts_options()
				  ) );
				}
			}
		}			  
	
	}
	
	/// save changes or reset options
	public function web_dorado_theme_update_and_get_options_typography(){
		
		if (isset($_GET['page']) && $_GET['page'] == "web_dorado_theme" && isset($_GET['controller']) && $_GET['controller'] == "typography_page") {
			if (isset($_REQUEST['action']) == 'save' ) {

				foreach ($this->options_typography as $value) {
					if (isset($_REQUEST[$value['var_name']])) {
						set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);
					} else {
						remove_theme_mod($value['id']);
					}
				}
				
				header("Location: themes.php?page=web_dorado_theme&controller=typography_page&saved=true");
				die;
			} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset') {
				foreach ($this->options_typography as $value) {
					remove_theme_mod($value['id']);
				}
				
				header("Location: themes.php?page=web_dorado_theme&controller=typography_page&reset=true");
				die;
			}
		}

	
	}
	
	public function web_dorado_typography_page_admin_scripts(){

		wp_enqueue_style('typagraphi_page_main_style',get_template_directory_uri().'/admin/css/typography_page.css');	
		wp_enqueue_script('jquery');
	
	}
	
	public function dorado_theme_admin_typography(){
		
		 if(isset($_REQUEST['controller']) && $_REQUEST['controller']=='typography_page'){
			if (isset($_REQUEST['saved']) && $_REQUEST['saved'] ) 
		
			echo '<div id="message" class="updated"><p><strong>Typography settings saved.</strong></p></div>';
			
		if (isset($_REQUEST['reset']) && $_REQUEST['reset'] ) 
		
			echo '<div id="message" class="updated"><p><strong>Typography settings reset.</strong></p></div>';
		 }
		global $exclusive_admin_helepr_functions, $exclusive_web_dor;

		?>
		
		<script>
			jQuery(document).ready(function () {
		
				jQuery('.graphic_selector .graphic_select_border').click(function () {
					select_graphic(this);
				});
				
				jQuery('.fontselector').on('change',function () {
					font_style(this, 'font-family')
				});
				jQuery('.letter_spacing').on('change',function () {
					font_style(this, 'letter-spacing')
				});
				jQuery('.text_transform').on('change',function () {
					font_style(this, 'text-transform')
				});
				jQuery('.font_variant').on('change',function () {
					font_style(this, 'font-variant')
				});
				jQuery('.font_weight').on('change',function () {
					font_style(this, 'font-weight')
				});
				jQuery('.font_style').on('change',function () {
					font_style(this, 'font-style')
				});
				
			});
				
				
				
		
			function font_style(element, property) {
		
				var currentSelect = jQuery(element).attr("id");
		
				var selectedOption = '#' + currentSelect + ' option:selected';
		
				var previewProp = jQuery(selectedOption).val();
				jQuery(element).parent().parent().parent().find('.optioninput').css(property, previewProp);
		
		
			}
		
			function select_graphic(ClickedLayout) {
		
				if (!jQuery(ClickedLayout).hasClass('disabled_option')) {
		
					jQuery(ClickedLayout).parent().parent().find('.graphic_select_border').removeClass('selectedgraphic');
					jQuery(ClickedLayout).addClass('selectedgraphic');
					jQuery(ClickedLayout).parent().find('.graphic_select_input').attr("checked", "checked");
		
				}
			}
		
			function toggle(showElement, hideElement) {
		
				jQuery(hideElement).hide();
				jQuery(hideElement + '_button').removeClass('active_button');
		
				if (jQuery(showElement).is(':visible')) {
					jQuery(showElement).fadeOut();
					jQuery(showElement + '_button').removeClass('active_button');
				} else {
					jQuery(showElement + '_button').addClass('active_button');
					jQuery(showElement).fadeIn();
		
				}
		
			}
		
		
		</script>
		<div id="main_typagrphy_page">
		<form method="post" action="themes.php?page=web_dorado_theme&controller=typography_page">
		
		<?php foreach ($this->options_typography as $value) {
		
		
		switch ($value['type']) {
		case "open":
		?>
		<table align="center" width="90%" style=" padding-top: 0px; padding-bottom:0px;">
			<tr>
				<?php break;
				case "close":
		
				?>
			</tr>
		</table><br/>
		<?php break;
		case "title":
		?>
		<table align="center" width="90%" style="margin-top: 0px;border-bottom: rgb(111, 111, 111) solid 2px;">
		<tr>   
                      <td style="font-size:14px; font-weight:bold">
					     <a href="<?php echo $exclusive_web_dor.'/wordpress-themes-guide-step-1.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">User Manual</a><br />This section allows you to change the font styles.
                         <a href="<?php echo $exclusive_web_dor.'/wordpress-theme-options/3-7.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">More...</a>
			          </td>   
                      <td  align="right" style="font-size:16px;">
                           <a href="<?php echo $exclusive_web_dor.'/wordpress-themes/exclusive.html'; ?>" target="_blank" style="color:red; text-decoration:none;">
                              <img src="<?php echo get_template_directory_uri() ?>/images/header.png" border="0" alt="" width="215">                           
                           </a>
                       </td>
        </tr>
		<tr>
			<td ><h3  style="font-family:Segoe UI;padding-bottom: 15px;color: rgb(111, 111, 111); font-size:18pt; margin:0px;margin-bottom: 15px;"><?php echo $value['name']; ?></h3>
			</td>
		</tr>
		</table>
		<?php
		break;
		case 'select':
		?>
		<tr>
		<td>		
		<div>
			<div class="optiontitle first">
				Typography - Text Headers. Select the font style of your site&#39;s header tags (H1, H2, H3...)
			</div>
			<div>
				<div class="optioninput" style=" font-size:13pt;">
				<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_headers_font'],$class='fontselector'); ?>
				</div>
				<div>
					<div class="font_preview_wrap">
						<label class="typagrphy_label" for="" style="font-size:18px;font-size: 20px;font-family: Segoe UI;">Preview</label>
						<div class="font_preview">
							<div class="optioninput"  style="font-size: 16px; margin-top: 14px;margin-bottom: 23px; font-family: <?php if (get_theme_mod($this->shorttypography."_type_headers_font") != "") {   echo htmlspecialchars(stripslashes(get_theme_mod($this->shorttypography."_type_headers_font")));
									  } else {   echo "Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif";  } ?>;font-weight:<?php if (get_theme_mod($this->shorttypography."_type_headers_weight") != "") {    echo get_theme_mod($this->shorttypography."_type_headers_weight");   } else {    echo "normal";   } ?>; letter-spacing:<?php if (get_theme_mod($this->shorttypography."_type_headers_kern") != "") {    echo get_theme_mod($this->shorttypography."_type_headers_kern");    } else {   echo "0.00em";  } ?>; text-transform:<?php if (get_theme_mod($this->shorttypography."_type_headers_transform") != "") {  echo get_theme_mod($this->shorttypography."_type_headers_transform");  } else {   echo "none";   } ?>; font-variant:<?php if (get_theme_mod($this->shorttypography."_type_headers_variant") != "") {    echo get_theme_mod($this->shorttypography."_type_headers_variant"); } else {   echo "normal";   } ?>; font-style:<?php if (get_theme_mod($this->shorttypography."_type_headers_style") != "") {   echo get_theme_mod($this->shorttypography."_type_headers_style");   } else {   echo "normal";} ?>;">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
								labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
								laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
								voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
								non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							</div>
						</div>
					</div>
					<a href="javascript:;" style="text-decoration:none;">
						<span id="type_headers_set_styling_button"  class="button"  onclick="toggle('#type_headers_set_styling', '#type_headers_set_advanced')">Edit Font Styling</span>
					</a>
		
					<div id="type_headers_set_styling" class="font_styling type_inputs optioninputtextarea" style="height: 110px;">
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_headers_kern'],$class='letter_spacing'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_headers_transform'],$class='text_transform'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_headers_variant'],$class='font_variant'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_headers_weight'],$class='font_weight'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_headers_style'],$class='font_style'); ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
		<br/>
		
		<br/>
		
		<div>
			<div class="optiontitle">
				Typography - Primary Font. Select the font style of your site&#39;s primary body text.
			</div>
				<div>
					<div class="optioninput" style=" font-size:13pt;">
						<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_primary_font'],$class='fontselector'); ?>
					<div>
				</div>
			</div>
			<div class="font_preview_wrap">
				<label class="typagrphy_label" for="" style="font-size:18px;font-size: 20px;font-family: Segoe UI;">Preview</label>
		
				<div class="font_preview">
					<div class="optioninput" style="font-size: 16px; margin-top: 14px; margin-bottom: 23px;  
					font-family: <?php if (get_theme_mod($this->shorttypography."_type_primary_font") != "") {
						echo htmlspecialchars(stripslashes(get_theme_mod($this->shorttypography."_type_primary_font")));
					} 
					else {
						
						echo "Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif";
						
					} ?>;
					font-weight:<?php if (get_theme_mod($this->shorttypography."_type_primary_weight") != "") {
						echo get_theme_mod($this->shorttypography."_type_primary_weight");
					} 
					else {
						echo "normal";
					} ?>;
					letter-spacing:<?php if (get_theme_mod($this->shorttypography."_type_primary_kern") != "") {
						echo get_theme_mod($this->shorttypography."_type_primary_kern");
					} 
					else {
						echo "0.00em";
					} ?>; 
					text-transform:<?php if (get_theme_mod($this->shorttypography."_type_primary_transform") != "") {
						echo get_theme_mod($this->shorttypography."_type_primary_transform");
					} else {
						echo "none";
					} ?>; font-variant:<?php if (get_theme_mod($this->shorttypography."_type_primary_variant") != "") {
						echo get_theme_mod($this->shorttypography."_type_primary_variant");
					} else {
						echo "normal";
					} ?>; font-style:<?php if (get_theme_mod($this->shorttypography."_type_primary_style") != "") {
						echo get_theme_mod($this->shorttypography."_type_primary_style");
					} else {
						echo "normal";
					} ?>;">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
						dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
						ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
						fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
						deserunt mollit anim id est laborum.
					</div>
				</div>
			</div>
			<a href="javascript:;" style="text-decoration:none;"><span id="_type_primary__set_styling_button" class="button"
																	   onclick="toggle('#_type_primary__set_styling', '#_type_primary__set_advanced')">Edit Font Styling</span></a>
		
			<div id="_type_primary__set_styling" class="font_styling type_inputs optioninputtextarea" style="height:110px;">
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_primary_kern'],$class='letter_spacing'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_primary_transform'],$class='text_transform'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_primary_variant'],$class='font_variant'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_primary_weight'],$class='font_weight'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_primary_style'],$class='font_style'); ?>
						</div>
				<div class="clear"></div>
			</div>
		</div>
		</div>
		</div><br/>
		
		
		
		
		
		<br/>
			<div>
				<div class="optiontitle">Typography - Secondary Font. Select the font style of your site&#39;s Secondary or Subtitle
					text.
				</div>
				<div>
					<div class="optioninput" style=" font-size:13pt;">
						<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_secondary_font'],$class='fontselector'); ?>
					</div>
					<div>
						<div class="font_preview_wrap">
							<label class="typagrphy_label" for="" style="font-size:18px;font-size: 20px;font-family: Segoe UI;">Preview</label>
		
							<div class="font_preview">
								<div class="optioninput" style="font-size: 16px;  margin-top: 14px; margin-bottom: 23px;  
									font-family: <?php if (get_theme_mod($this->shorttypography."_type_secondary_font") != "") {
									echo  htmlspecialchars(stripslashes(get_theme_mod($this->shorttypography."_type_secondary_font")));
								} else {
									echo "Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif";
								} ?>;font-weight:<?php if (get_theme_mod($this->shorttypography."_type_secondary_weight") != "") {
									echo get_theme_mod($this->shorttypography."_type_secondary_weight");
								} else {
									echo "normal";
								} ?>; letter-spacing:<?php if (get_theme_mod($this->shorttypography."_type_secondary_kern") != "") {
									echo get_theme_mod($this->shorttypography."_type_secondary_kern");
								} else {
									echo "0.00em";
								} ?>; text-transform:<?php if (get_theme_mod($this->shorttypography."_type_secondary_transform") != "") {
									echo get_theme_mod($this->shorttypography."_type_secondary_transform");
								} else {
									echo "none";
								} ?>; font-variant:<?php if (get_theme_mod($this->shorttypography."_type_secondary_variant") != "") {
									echo get_theme_mod($this->shorttypography."_type_secondary_variant");
								} else {
									echo "normal";
								} ?>; font-style:<?php if (get_theme_mod($this->shorttypography."_type_secondary_style") != "") {
									echo get_theme_mod($this->shorttypography."_type_secondary_style");
								} else {
									echo "normal";
								} ?>;">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
									ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
									laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
									voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
									cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
								</div>
							</div>
						</div>
						<a href="javascript:;" style="text-decoration:none;"><span id="_type_secondary__set_styling_button" class="button" onclick="toggle('#_type_secondary__set_styling', '#_type_secondary__set_advanced')">Edit Font Styling</span></a>
		
		
						<div id="_type_secondary__set_styling" class="font_styling type_inputs optioninputtextarea"   style="height:110px;">
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_secondary_kern'],$class='letter_spacing'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_secondary_transform'],$class='text_transform'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_secondary_variant'],$class='font_variant'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_secondary_weight'],$class='font_weight'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_secondary_style'],$class='font_style'); ?>
						</div>
							<div class="clear"></div>
						</div>
		
						<div id="_type_secondary__set_advanced" class="advanced_type type_inputs">
							<div class="type_advanced">
								<label class="typagrphy_label" for="_type_secondary_selectors">Additional Selectors</label>
								 <textarea class=""   name="-settings-two[type_secondary][selectors]"  id="_type_secondary_selectors"  rows="3"></textarea>
							</div>
							<div class="clear"></div>
						</div>
		
		
					</div>
				</div>
			</div><br/>
		
		
		
		<br/>
			<div>
				<div class="optiontitle">Typography - Inputs and Text Areas. Select the font style of your site&#39;s Text Inputs and Text Areas.
				</div>
				<div>
					<div class="optioninput" style=" font-size:13pt;">
						<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_inputs_font'],$class='fontselector'); ?>
					</div>
					<div>
						<div class="font_preview_wrap">
							<label class="typagrphy_label" for="" style="font-size:18px;font-size: 20px;font-family: Segoe UI;">Preview</label>
		
							<div class="font_preview">
								<div class="optioninput" style="font-size: 16px;
									margin-top: 14px; margin-bottom: 23px;  font-family: <?php if (get_theme_mod($this->shorttypography."_type_inputs_font") != "") {
									echo htmlspecialchars(stripslashes(get_theme_mod($this->shorttypography."_type_inputs_font")));
								} else {
									echo "Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif";
								} ?>;font-weight:<?php if (get_theme_mod($this->shorttypography."_type_inputs_weight") != "") {
									echo get_theme_mod($this->shorttypography."_type_inputs_weight");
								} else {
									echo "normal";
								} ?>; letter-spacing:<?php if (get_theme_mod($this->shorttypography."_type_inputs_kern") != "") {
									echo get_theme_mod($this->shorttypography."_type_inputs_kern");
								} else {
									echo "0.00em";
								} ?>; text-transform:<?php if (get_theme_mod($this->shorttypography."_type_inputs_transform") != "") {
									echo get_theme_mod($this->shorttypography."_type_inputs_transform");
								} else {
									echo "none";
								} ?>; font-variant:<?php if (get_theme_mod($this->shorttypography."_type_inputs_variant") != "") {
									echo get_theme_mod($this->shorttypography."_type_inputs_variant");
								} else {
									echo "normal";
								} ?>; font-style:<?php if (get_theme_mod($this->shorttypography."_type_inputs_style") != "") {
									echo get_theme_mod($this->shorttypography."_type_inputs_style");
								} else {
									echo "normal";
								} ?>;">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
									ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
									laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
									voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
									cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
								</div>
							</div>
						</div>
						<a href="javascript:;" style="text-decoration:none;"><span id="_type_inputs__set_styling_button"							   class="button"
																				   onclick="toggle('#_type_inputs__set_styling', '#_type_inputs__set_advanced')">Edit Font Styling</span></a>
		
						<div id="_type_inputs__set_styling" class="font_styling type_inputs optioninputtextarea" style="height:110px;">
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_inputs_kern'],$class='letter_spacing'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_inputs_transform'],$class='text_transform'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_inputs_variant'],$class='font_variant'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_inputs_weight'],$class='font_weight'); ?>
						</div>
						<div class="type_select">
							<?php $exclusive_admin_helepr_functions->select_with_label($this->options_typography['type_inputs_style'],$class='font_style'); ?>
						</div>
						<div class="clear"></div>
						</div>
		
						<div id="_type_inputs__set_advanced" class="advanced_type type_inputs">
							<div class="type_advanced">
								<label class="typagrphy_label" for="_type_inputs_selectors">Additional Selectors</label> <textarea class="" name="-settings-two[type_inputs][selectors]"  id="_type_inputs_selectors"  rows="3"></textarea>
							</div>
							<div class="clear"></div>
						</div>
		
		
					</div>
				</div>
			</div><br/>
		
		
		
		
		
		
			</td></tr>
		
		<?php
		break;
		}
		}
		?>
			</style>
		<p class="submit" style="float: left; margin-left: 63px; margin-right: 8px;">
			<input class="button" name="save" type="submit" value="Save changes"/>
			<input type="hidden" name="action" value="save"/>
		</p>
		</form>
		<form method="post" action="themes.php?page=web_dorado_theme&controller=typography_page">
		<p class="submit">
			<input class="button" name="reset" type="submit" value="Reset"/>
			<input type="hidden"  name="action" value="reset"/>
		</p>
		</form>
		</div > <?php

		
		
	
	}
	public function fonts_options(){
		  $font_choices[ 'Arial,Helvetica Neue,Helvetica,sans-serif' ] = 'Arial *';
		  $font_choices[ 'Arial Black,Arial Bold,Arial,sans-serif' ] = 'Arial Black *';
		  $font_choices[ 'Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif' ] = 'Arial Narrow *';
		  $font_choices[ 'Courier,Verdana,sans-serif' ] = 'Courier *';
		  $font_choices[ 'Georgia,Times New Roman,Times,serif' ] = 'Georgia *';
		  $font_choices[ 'Times New Roman,Times,Georgia,serif' ] = 'Times New Roman *';
		  $font_choices[ 'Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Arial,sans-serif' ] = 'Trebuchet MS *';
		  $font_choices[ 'Verdana,sans-serif' ] = 'Verdana *';
		  $font_choices[ 'American Typewriter,Georgia,serif' ] = 'American Typewriter';
		  $font_choices[ 'Andale Mono,Consolas,Monaco,Courier,Courier New,Verdana,sans-serif' ] = 'Andale Mono';
		  $font_choices[ 'Baskerville,Times New Roman,Times,serif' ] = 'Baskerville';
		  $font_choices[ 'Bookman Old Style,Georgia,Times New Roman,Times,serif' ] = 'Bookman Old Style';
		  $font_choices[ 'Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif' ] = 'Calibri';
		  $font_choices[ 'Cambria,Georgia,Times New Roman,Times,serif' ] = 'Cambria';
		  $font_choices[ 'Candara,Verdana,sans-serif' ] = 'Candara';
		  $font_choices[ 'Century Gothic,Apple Gothic,Verdana,sans-serif' ] = 'Century Gothic';
		  $font_choices[ 'Century Schoolbook,Georgia,Times New Roman,Times,serif' ] = 'Century Schoolbook';
		  $font_choices[ 'Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif' ] = 'Consolas';
		  $font_choices[ 'Constantia,Georgia,Times New Roman,Times,serif' ] = 'Constantia';
		  $font_choices[ 'Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif' ] = 'Corbel';
		  $font_choices[ 'Franklin Gothic Medium,Arial,sans-serif' ] = 'Franklin Gothic Medium';
		  $font_choices[ 'Garamond,Hoefler Text,Times New Roman,Times,serif' ] = 'Garamond';
		  $font_choices[ 'Gill Sans MT,Gill Sans,Calibri,Trebuchet MS,sans-serif' ] = 'Gill Sans MT';
		  $font_choices[ 'Helvetica Neue,Helvetica,Arial,sans-serif' ] = 'Helvetica Neue';
		  $font_choices[ 'Hoefler Text,Garamond,Times New Roman,Times,sans-serif' ] = 'Hoefler Text';
		  $font_choices[ 'Lucida Bright,Cambria,Georgia,Times New Roman,Times,serif' ] = 'Lucida Bright';
		  $font_choices[ 'Lucida Grande,Lucida Sans,Lucida Sans Unicode,sans-serif' ] = 'Lucida Grande';
		  $font_choices[ 'Palatino Linotype,Palatino,Georgia,Times New Roman,Times,serif' ] = 'Palatino Linotype';
		  $font_choices[ 'Tahoma,Geneva,Verdana,sans-serif' ] = 'Tahoma';
		  $font_choices[ 'Rockwell, Arial Black, Arial Bold, Arial, sans-serif' ] = 'Rockwell';
		  $font_choices[ 'Segoe UI' ] = 'Segoe UI';
		  return $font_choices;
	}
	
	private function inputs_kern($start=-0.3,$trichqy=0.0500001,$count_of_select=26){
		$array_of_kern=array();
		for($i=0;$i<$count_of_select;$i++){
			$array_of_kern[number_format($start,2).'em']=number_format($start,2).'em';
			$start=$start+$trichqy;
		}
		return $array_of_kern;
	}
	private function text_transform(){
		return array('none'=>'None','uppercase'=>'Uppercase ','capitalize'=>'Capitalize ','lowercase'=>'Lowercase  ');
			
	}
	private function text_variant(){
		return array('normal'=>'Normal ','small-caps'=>'Small-Caps ');
	}
	private function text_weight(){
		return array('normal'=>'Normal ','bold'=>'Bold ','lighter'=>'Light  ');
	}
	private function text_stylee(){
		return array('normal'=>'Normal ','italic'=>'Italic ');
	}
	
	public function print_fornt_end_style_typography(){
		foreach ($this->options_typography as $value) {
			if(isset($value['var_name'])){
					$$value['var_name'] = $value['std'];				 
			}
	
		}
    ?>

    <style type="text/css">
	    #top-nav-list a, .top-nav-list a{
			font-family: Segoe UI, Arial, Helvetica, sans-serif, sans !important;
		}
        h1, h2, h3, h4, h5, h6 {
            font-family: <?php echo $type_headers_font; ?>;
            font-weight: <?php echo $type_headers_weight; ?>;
            letter-spacing: <?php echo $type_headers_kern; ?>;
            text-transform: <?php echo $type_headers_transform; ?>;
            font-variant: <?php echo $type_headers_variant; ?>;
            font-style: <?php echo $type_headers_style; ?>;
        }

        .nav, .metabar, .subtext, .subhead, .widget-title, .reply a, .editpage, #page .wp-pagenavi, .post-edit-link, #wp-calendar caption, #wp-calendar thead th, .soapbox-links a, .fancybox, .standard-form .admin-links, .ftitle small {
            font-family: <?php echo $type_headers_font; ?>;
            font-weight: <?php echo $type_headers_weight; ?>;
            letter-spacing: <?php echo $type_headers_kern; ?>;
            text-transform: <?php echo $type_headers_transform; ?>;
            font-variant: <?php echo $type_headers_variant; ?>;
            font-style: <?php echo $type_headers_style; ?>;
        }

        body {
            font-family: <?php echo $type_primary_font; ?>;
            font-weight: <?php echo $type_primary_weight; ?>;
            letter-spacing: <?php echo $type_primary_kern; ?>;
            text-transform: <?php echo $type_primary_transform; ?>;
            font-variant: <?php echo $type_primary_variant; ?>;
            font-style: <?php echo $type_primary_style; ?>;
        }

        input, textarea, .read_more {
            font-family: <?php echo $type_inputs_font; ?>;
            font-weight: <?php echo $type_inputs_weight; ?>;
            letter-spacing: <?php echo $type_inputs_kern; ?>;
            text-transform: <?php echo $type_inputs_transform; ?>;
            font-variant: <?php echo $type_inputs_variant; ?>;
            font-style: <?php echo $type_inputs_style; ?>;
        }
		
		#site-description-p {
		    font-family: <?php echo $type_secondary_font; ?>;
            font-weight: <?php echo $type_secondary_weight; ?>;
            letter-spacing: <?php echo $type_secondary_kern; ?>;
            text-transform: <?php echo $type_secondary_transform; ?>;
            font-variant: <?php echo $type_secondary_variant; ?>;
            font-style: <?php echo $type_secondary_style; ?>;
		}

    </style>
<?php

	
		
	}


}
 
