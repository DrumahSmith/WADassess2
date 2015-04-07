<?php

class web_dor_slider_page_class{
	
	
	
		
	function __construct(){}


	/// save changes or reset options
	private function web_dorado_theme_update_slider(){
		
		$image_list='';
		$image_href='';
		$image_title='';
		$image_textarea='';
		$image_link='';
		$ct_pause_on_hover='';
		if(isset($_POST['ct_pause_on_hover'])){
			$ct_pause_on_hover =$_POST['ct_pause_on_hover'];
		}
		if ( isset($_GET['saved']) && $_GET['saved']=='saved' ) {	
						
			
			for($i=0;$i<200;$i++){
				if(isset($_POST['ct_image_link_'.$i])){
					$image_link .=$_POST['ct_image_link_'.$i].';;;;';
				}
				
				if(isset($_POST['ct_image_href_'.$i])){
					$image_href .=$_POST['ct_image_href_'.$i].';;;;';
				}
				
				if(isset($_POST['ct_image_title_'.$i])){
					$image_title .=$_POST['ct_image_title_'.$i].';;;;';
				}
				
				if(isset($_POST['ct_image_textarea_'.$i])){
					$image_textarea .=$_POST['ct_image_textarea_'.$i].';;;;';
				}
			}
			set_theme_mod('web_busines_image_link',$image_link);
			set_theme_mod('web_busines_image_href',$image_href);
			set_theme_mod('web_busines_image_textarea',$image_textarea);
			set_theme_mod('web_busines_image_title',$image_title);
			set_theme_mod('ct_slider_height',$_POST['ct_slider_height']);
			set_theme_mod('ct_pause_time',$_POST['ct_pause_time']);
			set_theme_mod('ct_anim_speed',$_POST['ct_anim_speed']);
			set_theme_mod('ct_effect',$_POST['ct_effect']);
			set_theme_mod('ct_pause_on_hover',$ct_pause_on_hover);
			set_theme_mod('ct_slider_title_position',$_POST['ct_slider_title_position']);
			set_theme_mod('ct_slider_description_position',$_POST['ct_slider_description_position']);
			
		}
		if(isset($_GET['reset']) && $_GET['reset']=='reset'){
		
		remove_theme_mod('web_busines_image_link');
		remove_theme_mod('web_busines_image_href');
		remove_theme_mod('web_busines_image_title');
		remove_theme_mod('web_busines_image_textarea');
		remove_theme_mod('ct_slider_height');
		remove_theme_mod('ct_pause_time');
		remove_theme_mod('ct_anim_speed');	
		remove_theme_mod('ct_effect');
		remove_theme_mod('ct_pause_on_hover');
		
		remove_theme_mod('ct_slider_title_position');
		remove_theme_mod('ct_slider_description_position');
			
		}	
	
	}
	/// print massage after save
	private function web_dorado_print_massage(){
		
		if (isset($_GET['saved']) && $_GET['saved'] =='saved'  ) 
		
			echo '<div id="message" class="updated"><p><strong>Slider settings are saved.</strong></p></div>';
			
		if (isset($_GET['reset']) && $_GET['reset'] == 'reset' ) 
		
			echo '<div id="message" class="updated"><p><strong>Slider settings are reset.</strong></p></div>';
	
	}
	
	/// include style and scripts for slider page
	public function web_dorado_slider_page_admin_scripts(){

		wp_enqueue_style('slider_page_main_style',get_template_directory_uri().'/admin/css/slider_page.css');
        wp_enqueue_script('slider_page_main_script',get_template_directory_uri().'/admin/script/slider_page_script.js');		
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'jquery-color' );
		wp_print_scripts('editor');
		if (function_exists('add_thickbox')) add_thickbox();
		wp_print_scripts('media-upload');
		wp_admin_css();
		wp_enqueue_script('utils');
		do_action("admin_print_styles-post-php");
		do_action('admin_print_styles');
	
	}
	
	public function web_dorado_slider_parametrs(){
				
		$image_link=get_theme_mod('web_busines_image_link','');
		if($image_link){
			$link_array=explode(';;;;',$image_link);
			array_pop($link_array);
		}
		else {$link_array=array();}	
		$param['link_array']=$link_array;
		
		
		$image_href=get_theme_mod('web_busines_image_href','');
		if($image_href){
			$href_array=explode(';;;;',$image_href);
			array_pop($href_array);
		}
		else {$href_array=array();}	
		$param['href_array']=$href_array;
		
		$image_textarea=get_theme_mod('web_busines_image_textarea','');
		if($image_textarea){
			$textarea_array=explode(';;;;',$image_textarea);
			array_pop($textarea_array);
		}
		else {$textarea_array=array();}	
		$param['textarea_array']=$textarea_array;
		
		
		
		$image_title=get_theme_mod('web_busines_image_title','');
		if($image_title){
			$title_array=explode(';;;;',$image_title);
			array_pop($title_array);
		}
		else {$title_array=array();}	
		$param['title_array']=$title_array;
		
		
		return $param;
	}
	
	//// back end style
	public function web_dorado_theme_admin_slider(){
				
		$LIST='';
		$this->web_dorado_theme_update_slider();
		$this->web_dorado_print_massage();
		$param=$this->web_dorado_slider_parametrs();
		$link_array=$param['link_array'];
		$href_array=$param['href_array'];
		$title_array=$param['title_array'];
		$textarea_array=$param['textarea_array'];
		global $exclusive_web_dor;
		?>
		
		<div id="main_slider_page">
			<div class="wrap" style="margin-right:76px; margin-left: 82px;">
	
			<table align="center" width="100%" style="margin-top: 0px;border-bottom: rgb(111, 111, 111) solid 2px;">
					<tbody>
						<tr>   
						  <td style="font-size:14px; font-weight:bold;color: #333;">
							 <a href="<?php echo $exclusive_web_dor.'/wordpress-themes-guide-step-1.html'; ?>" target="_blank" style="outline-style: none !important;color:#126094; text-decoration:none;">User Manual</a><br />This section allows you customize the slider.
							 <a href="<?php echo $exclusive_web_dor.'/wordpress-theme-options/3-8.html'; ?>" target="_blank" style="outline-style: none !important;color:#126094; text-decoration:none;">More...</a>
						 </td>   
						  <td  align="right" style="font-size:16px;">
							   <a href="<?php echo $exclusive_web_dor.'/wordpress-themes/exclusive.html'; ?>" target="_blank" style="outline-style: none !important; text-decoration:none;">
								  <img src="<?php echo get_template_directory_uri() ?>/images/header.png" border="0" alt="" width="215">
							   </a>
						   </td>
						</tr>
						<tr>
							<td>
								<h3 style="margin: 0px;font-family:Segoe UI;padding-bottom: 15px;color: rgb(111, 111, 111); font-size:18pt;font-weight: bold;">Slider</h3>
							</td>
						</tr>
					</tbody>
				</table>		
		<?php	
			//Style and js included in $template html file
			
			$template='<div id="main_slider_div">
<form method="post" action="themes.php?page=web_dorado_theme&controller=slider_page&saved=saved">
<table class="optioninput" width="800">
	<tr>
		<td width="30%"  valign="middle"><h3>Slider Height
        <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="The height of the slider can be customized. You need to specify the height in the box provided.">[?]</span></h3></td>
		<td><input style="width:66px;" name="ct_slider_height" id="ct_slider_height" value="{HEIGHT}" /></td>
	</tr>
	<tr>
		<td width="30%"  valign="middle"><h3>Animation Speed
        <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="When using an animation for the slider, you can control its speed. You can use the provided box to fill in the optimal speed.">[?]</span></h3>
        </td>
		<td><input style="width:66px;" name="ct_anim_speed" id="ct_anim_speed" value="{SPEED}" /></td>
	</tr>
	<tr>
		<td width="30%"  valign="middle"><h3>Pause Time
        <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="The timing for the slider animation can be customized. You can adjust it providing timing in the corresponding box.">[?]</span></h3>
        </h3></td>
		<td><input style="width:66px;" name="ct_pause_time" id="ct_pause_time" value="{PAUSE}" /></td>
	</tr>
	<tr>
		<td width="30%"  valign="middle"><h3>Stop animation while hovering
        <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="By default slider animation is constant. However you can choose it to stop while hovering, checking the box for this option.">[?]</span>
        </h3></td>
		<td><input type="checkbox" name="ct_pause_on_hover" id="ct_pause_on_hover" value="true" {CHECKED}></td>
	</tr>
	
	<tr>
		<td width="30%"  valign="middle"><h3>Effect
        <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="The animation of the slider can be customized with the help of various effects. You can choose the slider animation effect from the list included below.">[?]</span>
        </h3></td>
		<td>
			<select style="width:215px;" name="ct_effect" id="ct_effect">
				<option value="none">None</option>
				<option value="cubeH">Cube Horizontal</option>
				<option value="cubeV">Cube Vertical</option>
				<option value="fade">Fade</option>
				<option value="sliceH">Slice Horizontal</option>
				<option value="sliceV">Slice Vertical</option>
				<option value="slideH">Slide Horizontal</option>
				<option value="slideV">Slide Vertical</option>
				<option value="scaleOut">Scale Out</option>
				<option value="scaleIn">Scale In</option>
				<option value="blockScale">Block Scale</option>
				<option value="kaleidoscope">Kaleidoscope</option>
				<option value="fan">Fan</option>
				<option value="blindH">Blind Horizontal</option>
				<option value="blindV">Blind Vertical</option>
				<option value="random">Random</option>
			</select>
		</td>
	</tr>
	
	<tr>
		<td width="30%"  valign="middle"><h3>Title Position
        <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="The animation of the slider can be customized with the help of various effects. You can choose the slider animation effect from the list included below.">[?]</span>
        </h3></td>
		<td>
			<table class="bws_position_table">
				<tbody>
				  <tr>
					<td><input type="radio" value="left-top" id="slideshow_title_top-left" name="ct_slider_title_position"></td>
					<td><input type="radio" value="center-top" id="slideshow_title_top-center" name="ct_slider_title_position"></td>
					<td><input type="radio" value="right-top" id="slideshow_title_top-right" name="ct_slider_title_position" checked=""></td>
				  </tr>
				  <tr>
					<td><input type="radio" value="left-middle" id="slideshow_title_middle-left" name="ct_slider_title_position"></td>
					<td><input type="radio" value="center-middle" id="slideshow_title_middle-center" name="ct_slider_title_position"></td>
					<td><input type="radio" value="right-middle" id="slideshow_title_middle-right" name="ct_slider_title_position"></td>
				  </tr>
				  <tr>
					<td><input type="radio" value="left-bottom" id="slideshow_title_bottom-left" name="ct_slider_title_position"></td>
					<td><input type="radio" value="center-bottom" id="slideshow_title_bottom-center" name="ct_slider_title_position"></td>
					<td><input type="radio" value="right-bottom" id="slideshow_title_bottom-right" name="ct_slider_title_position"></td>
				  </tr>
				</tbody>	
			</table>
			<script>jQuery(\'input[name="ct_slider_title_position"][value="{titlepositionActive}"]\').attr("checked","checked");</script>	
		</td>
	</tr>
	
	
	<tr>
		<td width="30%"  valign="middle"><h3>Description Position
        <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="The animation of the slider can be customized with the help of various effects. You can choose the slider animation effect from the list included below.">[?]</span>
        </h3></td>
		<td>
			<table class="bws_position_table">
				<tbody>
				  <tr>
					<td><input type="radio" value="left-top" id="slideshow_description_top-left" name="ct_slider_description_position"></td>
					<td><input type="radio" value="center-top" id="slideshow_description_top-center" name="ct_slider_description_position"></td>
					<td><input type="radio" value="right-top" id="slideshow_description_top-right" name="ct_slider_description_position"></td>
				  </tr>
				  <tr>
					<td><input type="radio" value="left-middle" id="slideshow_description_middle-left" name="ct_slider_description_position"></td>
					<td><input type="radio" value="center-middle" id="slideshow_description_middle-center" name="ct_slider_description_position"></td>
					<td><input type="radio" value="right-middle" id="slideshow_description_middle-right" name="ct_slider_description_position"></td>
				  </tr>
				  <tr>
					<td><input type="radio" value="left-bottom" id="slideshow_description_bottm-Left" name="ct_slider_description_position"></td>
					<td><input type="radio" value="center-bottom" id="slideshow_description_bottom-center" name="ct_slider_description_position"></td>
					<td><input type="radio" value="right-bottom" id="slideshow_description_bottm-right" name="ct_slider_description_position" checked=""></td>
				  </tr>
				</tbody>
		  </table>
		  <script>jQuery(\'input[name="ct_slider_description_position"][value="{descriptionpositionActive}"]\').attr("checked","checked");</script>
		</td>
	</tr>
	
	
	{LIST}
	<tr id="add-image-line">
		<td width="30%"  valign="middle"><h3>Image
        <span class="hasTip" style="cursor: pointer;color: #3B5998;" title="Using this option you can add images for the slider.">[?]</span>
        </h3></td>
		<td><input class="upload-button" type="button" id="slides-img-add-button" value="Upload New Image" /></td>
	</tr>
</table>
	<p class="submit" style="float: left; margin-left: -22px; margin-right: 8px;">
		<input class="button" name="save" type="submit" value="Save changes" style="background: url({THEME_URL}/images/button.png) center; background-size: 100% 100%;" />
		<input type="hidden" name="action" value="save" />
	</p>
</form>
<form method="post" action="themes.php?page=web_dorado_theme&controller=slider_page&reset=reset">
	<p class="submit"> 
		<input class="button" name="reset" type="submit" value="Reset"  style="background: url({THEME_URL}/images/button.png) center; background-size: 100% 100%;"/>
		<input type="hidden" name="action" value="reset" />
	</p>
</form>
</div>';
			
			$list='<tr class="slide-from-base"><td width="30%" valign="middle"><h3>Image</h3></td><td><input size="36" value="{LINK}" class="upload" id="ct_image_link_{ID}" name="ct_image_link_{ID}" /><input type="submit" class="update-button" value="Update image"><input class="remove-image" value="Remove image" type="submit" /></td></tr>
			<tr rel="{ID}"><td width="30%" valign="middle"><h3></h3></td><td><img  src="{LINK}" /></td></tr>
			<tr><td width="30%" valign="middle"><h3>The URL of image when clicked</h3></td><td><input  type="text" name="ct_image_href_{ID}" value="{HREF}" /></td></tr>
			<tr><td width="30%"  valign="middle"><h3>Image Title</h3></td><td><input  type="text"  name="ct_image_title_{ID}" value="{TITLE}" /></td></tr>
			<tr><td width="30%"  valign="middle"><h3>Text on images</h3></td><td><textarea name="ct_image_textarea_{ID}">{DESCRIPTION}</textarea></td></tr>';
		
			for($i=0;$i<count($link_array);$i++){
				$str=$list;
				$str=str_replace("{LINK}",$link_array[$i],$str);
				if(!isset($href_array[$i]))
				$href_array[$i]='';
				if(!isset($title_array[$i]))
				$title_array[$i]='';
				if(!isset($textarea_array[$i]))
				$textarea_array[$i]='';
				$str=str_replace("{HREF}",$href_array[$i],$str);
				$str=str_replace("{TITLE}",$title_array[$i],$str);
				$str=str_replace("{DESCRIPTION}",$textarea_array[$i],$str);
				$str=str_replace("{ID}",$i,$str);
				$LIST.=$str;
			}
			
			$template=str_replace("{LIST}",$LIST,$template);			
			$template=str_replace("{HEIGHT}",get_theme_mod('ct_slider_height','500'),$template);
			$template=str_replace("{SPEED}",get_theme_mod('ct_anim_speed','500'),$template);
			$template=str_replace("{PAUSE}",get_theme_mod('ct_pause_time','4000'),$template);
			$template=str_replace("{THEME_URL}",get_template_directory_uri(),$template);
						
			$template=str_replace("{titlepositionActive}",get_theme_mod('ct_slider_title_position'),$template);
			$template=str_replace("{descriptionpositionActive}",get_theme_mod('ct_slider_description_position'),$template);
			
			
			if(get_theme_mod('ct_pause_on_hover')){$template=str_replace("{CHECKED}",'checked="checked"',$template);}
			if(get_theme_mod('ct_effect')){$template=str_replace('value="'.get_theme_mod('ct_effect').'"','value="'.get_theme_mod('ct_effect').'"'.' selected="selected"',$template);}
			else{$template=str_replace("{CHECKED}",'',$template);}
		
			echo $template;
		?> <div style="clear:both; width:100%"></div></div></div>  <?php
	}
	


}
 
