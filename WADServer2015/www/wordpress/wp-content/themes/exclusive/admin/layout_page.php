<?php

class web_dor_layout_page_class{
	
	public $themeoptions;
	
	public $shortthemeoptions;
	
	public $layout;
	
	public $options_themeoptions;
	
	function __construct(){
		
		global $exclusive_special_id_for_db,$pcontent_area;
		
		$this->themeoptions = "Layout Editor";
		
		$this->shortthemeoptions = $exclusive_special_id_for_db."gs";
		
		$this->layout = array(
		
			"1" => "No Sidebar",
			
			"2" => "one right",
			
			"3" => "one left",
			
			"4" => "two right",
			
			"5" => "two left",
			
			"6"=>"one right and one left"
		
		);
		
		$value_of_std[0]=get_theme_mod($this->shortthemeoptions."_default_layout",2);
		$value_of_std[1]=get_theme_mod($this->shortthemeoptions."_full_width","");
		$value_of_std[2]=get_theme_mod($this->shortthemeoptions."_content_area","1024");
		$value_of_std[3]=get_theme_mod($this->shortthemeoptions."_main_column","67");
		$value_of_std[4]=get_theme_mod($this->shortthemeoptions."_pwa_width","16");		
		$this->options_themeoptions = array (
		
			"default_layout" => array( 
			
				"name" => "Choose Default Layout",
		
				"description" => "Here you can select the default layout for pages and posts on the website.",
		
				"id" => $this->shortthemeoptions."_default_layout",
				
				"var_name" => "default_layout",
		
				"type" => "radio",
		
				"options" => $this->layout,
		
				"std" => $value_of_std[0]
			),	  
			 
			"full_width" =>array( 
			
				"name" => "Full Width",
		
				"description" => "",
				
				"var_name" => "full_width",
		
				"id" => $this->shortthemeoptions."_full_width",
		
				"type" => "checkbox",
		
				"std" => $value_of_std[1]
			),	  
		
			"content_area" =>array( 
			
				"name" => "Content Area Width",
		
				"description" => "Specify the width of the Content Area",
				
				"var_name" => "content_area",
				
				"id" => $this->shortthemeoptions."_content_area",
				
				"type" => "text",
				
				"extend_simvol" => "px",
				
				"std" => $value_of_std[2]
			),		   
		
			"main_column" =>array( 
			
				"name" => "Main Column Width",
		
				"description" => "Specify the width of the Main Column",
				
				"var_name" => "main_column",
				
				"id" => $this->shortthemeoptions."_main_column",
				
				"type" => "text",
				
				"extend_simvol" => "%",
				
				"std" => $value_of_std[3]
			),	 
		
			"pwa_width" =>array( 
			
				"name" => "Primary Widget Area width",
		
				"description" => "Specify the width of the Primary Widget Area",
				
				"var_name" => "pwa_width",
				
				"id" => $this->shortthemeoptions."_pwa_width",
				
				"type" => "text",
				
				"extend_simvol" => "%",
				
				"std" => $value_of_std[4]
			),	   
		);
	
	
	}


	/// save changes or reset options
	public function web_dorado_theme_update_and_get_options_layout(){
	
		if (isset($_GET['page']) && $_GET['page'] =="web_dorado_theme" && isset($_GET['controller']) && $_GET['controller'] == "layout_page") {
	
			if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {
	
				foreach ($this->options_themeoptions as $value) {
	
					set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);
	
				}
	
				foreach ($this->options_themeoptions as $value) {
					
					
	
					if (isset($_REQUEST[$value['var_name']])) {
	
						set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);
	
					} else {
	
						remove_theme_mod($value['id']);
	
					}
				}
				header("Location: themes.php?page=web_dorado_theme&controller=layout_page&saved=true");
				die;
	
			} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset') {
	
				foreach ($this->options_themeoptions as $value) {
	
					remove_theme_mod($value['id']);
				}
				header("Location: themes.php?page=web_dorado_theme&controller=layout_page&reset=true");
				die;
	
			}
		}
	
	
	
	}
	
	public function web_dorado_layout_page_admin_scripts(){
		
		wp_enqueue_style('layout_page_main_style',get_template_directory_uri('template_directory').'/admin/css/layout_page.css');	
		

	}
	
	public function dorado_theme_admin_layout(){
		
		global $exclusive_admin_helepr_functions;
		
		// get radio variables
		$radio = $this->get_option_type( 'radio' );
		$radio_options = $radio[0]['options'];
		$count_radio_options = count( $radio_options );
		
		// get checkbox variables
		$checkbox=$this->get_option_type( 'checkbox' );
		
		// get text variables
		$text=$this->get_option_type( 'text' );
		$count_text = count( $text );
		
		if (isset($_REQUEST['saved']) && $_REQUEST['saved'] && isset($_GET['controller']) && $_GET['controller'] == "layout_page" ) 
		
			echo '<div id="message" class="updated"><p><strong>Layout settings are saved.</strong></p></div>';
			
		if (isset($_REQUEST['reset']) && $_REQUEST['reset'] && isset($_GET['controller']) && $_GET['controller'] == "layout_page" ) 
		
			echo '<div id="message" class="updated"><p><strong>Layout settings are reset.</strong></p></div>';
			global $exclusive_web_dor;
	?>
	<script type="text/javascript">
	function showRadioValue(rad){
		if(rad<1){
			return;
		}
		for(var i = 1; i <= 14; ++i){
			if(jQuery("#main_layout_page .param_gorup_div").eq(i).length){jQuery("#main_layout_page .param_gorup_div").eq(i).css("display","none")}
		}
		switch(rad){
			case 1:
			jQuery("#main_layout_page .param_gorup_div").eq(1).css("display","block");
			
			break;
			case 2:
			jQuery("#main_layout_page .param_gorup_div").eq(1).css("display","block");
			jQuery("#main_layout_page .param_gorup_div").eq(2).css("display","block");
			break;
			case 3:
			jQuery("#main_layout_page .param_gorup_div").eq(1).css("display","block");
			jQuery("#main_layout_page .param_gorup_div").eq(2).css("display","block");
			break;
			case 4:
			jQuery("#main_layout_page .param_gorup_div").eq(1).css("display","block");
			jQuery("#main_layout_page .param_gorup_div").eq(2).css("display","block");
			jQuery("#main_layout_page .param_gorup_div").eq(3).css("display","block");
			break;
			case 5:
			jQuery("#main_layout_page .param_gorup_div").eq(1).css("display","block");
			jQuery("#main_layout_page .param_gorup_div").eq(2).css("display","block");
			jQuery("#main_layout_page .param_gorup_div").eq(3).css("display","block");
			break;
			case 6:
			jQuery("#main_layout_page .param_gorup_div").eq(1).css("display","block");
			jQuery("#main_layout_page .param_gorup_div").eq(2).css("display","block");
			jQuery("#main_layout_page .param_gorup_div").eq(3).css("display","block");
			break;

		}
 	}
	</script>
	<div id="main_layout_page">
		<form method="post" action="themes.php?page=web_dorado_theme&controller=layout_page">
			<table align="center" width="90%" style="margin-top: 0px;border-bottom: rgb(111, 111, 111) solid 2px;">
				<tbody>
				    <tr>   
                      <td style="font-size:14px; font-weight:bold">
					     <a href="<?php echo $exclusive_web_dor.'/wordpress-themes-guide-step-1.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">User Manual</a><br />This section allows you to make changes in default layout of the theme.
                         <a href="<?php echo $exclusive_web_dor.'/wordpress-theme-options/3-2.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">More...</a>
					    </td>   
                      <td  align="right" style="font-size:16px;">
                           <a href="<?php echo $exclusive_web_dor.'/wordpress-themes/exclusive.html'; ?>" target="_blank" style="color:red; text-decoration:none;">
                              <img src="<?php echo get_template_directory_uri() ?>/images/header.png" border="0" alt="" width="215">
                           </a>
                       </td>
                    </tr>
					<tr>
						<td>
							<h3 style="margin: 0px;font-family:Segoe UI;padding-bottom: 15px;color: rgb(111, 111, 111); font-size:18pt;">Layout Editor</h3>
						</td>						
					</tr>
				</tbody>
			</table>
			<table align="center" width="90%" style=" padding-bottom:0px;padding-top:0px;">
				<tbody>
					<tr>
						<td>
							<div class="optiontitle first"><h3><?php echo $radio[0]['name']; ?></h3></div>
							<div class="optiondescreption"><p><?php echo $radio[0]['description']; ?></p></div>
							<div class="options_input options_select"></div>
							<table width="100%">
								<tbody>
									<tr>
									<?php for($i=0;$i<$count_radio_options;$i++) { ?>
										<td>
											<div style="width:50px; height:49px; background:url(<?php echo get_template_directory_uri(); ?>/images/sprite-layouts.png) no-repeat 0 <?php echo -$i*48; ?>px;"></div>
												<input type="radio" <?php echo checked($radio[0]['std'],$i+1);  ?> name="<?php echo $radio[0]['var_name'] ?>" value="<?php echo $i+1; ?>" onclick="javascript:showRadioValue(<?php echo $i+1; ?>)">
											<br>
										</td>
									<?php } ?>
									</tr>
								</tbody>
							</table>
						     <div>
								<?php	$exclusive_admin_helepr_functions->only_checkbox($this->options_themeoptions['full_width']); ?>
								<?php for($i=0;$i<$count_text;$i++) {
									$exclusive_admin_helepr_functions->only_input($text[$i],array("input_size"=>"4"));
								 } 			
								 ?>
											
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<p class="submit" style="float:left; margin-left: 63px; margin-right: 8px;">
				<input class="button" name="save" type="submit" value="Save changes">
				<input type="hidden" name="action" value="save">
			</p>
		</form>
		<form method="post" action="themes.php?page=web_dorado_theme&controller=layout_page">
			<p class="submit"  style="float:left">
				<input class="button" name="reset" type="submit" value="Reset">
				<input type="hidden" name="action" value="reset">
			</p>
		</form>
	</div>
	<script>showRadioValue(<?php echo $radio[0]['std'] ?>);</script>
	<?php
	}
	
	/// get one type elements
	
	private function get_option_type($type){
		$cur_type_elements=array();
		$k=0;
		foreach( $this->options_themeoptions as $option ){
			
			if( $option['type'] == $type ){
			
				$cur_type_elements[$k]=$option;
				$k++;
			}
			
		}
		return $cur_type_elements;
	}
	
	public function update_layout_editor(){
			foreach ($this->options_themeoptions as $value) 
			{
				if(isset($value['id'])){
					if (get_theme_mod($value['id']) === FALSE) 
					{
						
						$$value['var_name'] = $value['std'];
					} else {
						
						$$value['var_name'] = get_theme_mod($value['id']);
					}
				}
		
			}

			if ($full_width)
			{
				$content_width ='100%';
				$them_content_are_width='100%';
				?><script>var exclusive_full_width=1</script>
				  <style>
				     #footer-bottom{
						padding: 15px !important;
					}
				  </style><?php
				
			}
			else {
				$content_width	=$content_area . "px;";
				$them_content_are_width=$content_area . "px;";
				?><script> var exclusive_full_width=0</script><?php
			}
			switch ($default_layout) {
				//set styles leauts
				case 1:
					?>
					<style type="text/css">
					#sidebar1,
					#sidebar2 {
						display:none;
					}
					.blog{
						display:block; 
						float:left;
					}
			   
					.container{
					width:<?php echo $them_content_are_width; ?>;
					}        
					.blog{
					width:100%;
					}               
					</style>
					<?php
					break;
				case 2:
					?>
					<style type="text/css">
					#sidebar2{
						display:none;
					} 
					#sidebar1 {
						display:block;
						float:right;
					}
					.blog{
						display:block;
						float:left;
					} 
					.container{
					width:<?php echo $them_content_are_width; ?>
					}
					.blog{
					width:<?php echo $main_column; ?>%;
					}
					#sidebar1{
					width:<?php echo (100  - $main_column); ?>%;
					}
					</style>
					<?php
					break;
				case 3:
					?>
					<style type="text/css">
					#sidebar2{
						display:none;
					} 
					#sidebar1 {
						display:block;
						float:left;
					} 
					.blog{
						display:block;
						float:left;
					}
					.container{
					width:<?php echo $them_content_are_width; ?>
					}
					.blog{
					width:<?php echo $main_column ; ?>%;
					}
					#sidebar1{
					width:<?php echo (100 -  $main_column); ?>%;
					}
					#top-page .blog{
						left:<?php echo  (100 -  $main_column) ; ?>%;
					}    
					</style>
					<?php
					break;
				case 4:
				?>
					<style type="text/css">
					.tablet #sidebar1, .phone #sidebar1{
						border-bottom: 1px dashed #959595;
					}
					#sidebar2{
						display:block;
						float:right;
					} 
					#sidebar1 {
						display:block; float:right;
					} 
					.blog{
						display:block;
						float:left;
					}
					.container{
					width:<?php echo $them_content_are_width; ?>
					}
					.blog{
					width:<?php echo $main_column ; ?>%;
					}
					#sidebar1{
					width:<?php echo $pwa_width ; ?>%;
					}
					#sidebar2{
					width:<?php echo (100  - $pwa_width - $main_column); ?>%;
					}
					</style>
					 <?php
					break;
				case 5:
				?>
					<style type="text/css">
					.tablet #sidebar1, .phone #sidebar1{
						border-bottom: 1px dashed #959595;
					}
					#sidebar2{
						display:block;
						float:left;
					} 
					#sidebar1 {
						display:block;
						float:left;
					} 
					.blog{
						display:block;
					}
					#blog{
						float:right;
					}
					.container{
					width:<?php echo $them_content_are_width; ?>
					}
					.blog{
					width:<?php echo $main_column ; ?>%;
					}
					#sidebar1{
					width:<?php echo $pwa_width ; ?>%;
					}
					#sidebar2{
					width:<?php echo (100 - $pwa_width - $main_column); ?>%;
					}
					#top-page .blog{
						left:<?php echo (100 - $main_column) ; ?>%;
					}
					</style>
					<?php
					break;
				case 6:
				?>
					<style type="text/css">
					.tablet #sidebar1, .phone #sidebar1{
						border-bottom: 1px dashed #959595;
					}
					#sidebar2{
						display:block;
						float:right;
					} 
					#sidebar1 {
						display:block;
						float:left; 
					} 
					.blog{
						display:block;
						float:left;
					}    			       
					.container{
						width:<?php echo $them_content_are_width; ?>
					}
					.blog{
						width:<?php echo $main_column ; ?>%;
					}
					#sidebar1{
						width:<?php echo $pwa_width ; ?>%;
					}
					#sidebar2{
						width:<?php echo (100  - $pwa_width - $main_column); ?>%;
					}       
					#top-page .blog{
						left:<?php echo $pwa_width ; ?>%;
					}     
					</style>
					<?php
					break;
			}
		}
}
 