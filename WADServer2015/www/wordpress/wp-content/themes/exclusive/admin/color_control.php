<?php

class web_dor_color_control_page_class{
	
	public $colorcontrol;
	public $shortcolorcontrol;
	public $options_colorcontrol;
	
	
	
	
	
	
	function __construct(){
		global $exclusive_special_id_for_db;
		
		add_action( 'customize_preview_init', array($this,'web_bussines_customize_preview_js') );
		
		$this->colorcontrol = "Color Control";
		$this->shortcolorcontrol = $exclusive_special_id_for_db."cc";
		
		$value_of_std[0]=get_theme_mod($this->shortcolorcontrol."_menu_elem_back_color",'#022433');
		$value_of_std[1]=get_theme_mod($this->shortcolorcontrol."_content_back_color",'#FFFFFF');
		$value_of_std[2]=get_theme_mod($this->shortcolorcontrol."_sideb_background_color",'#ECECEC');
		$value_of_std[3]=get_theme_mod($this->shortcolorcontrol."_footer_back_color",'#ECECEC');
		$value_of_std[4]=get_theme_mod($this->shortcolorcontrol."_home_top_posts_color",'#ECECEC');
		$value_of_std[5]=get_theme_mod($this->shortcolorcontrol."_top_posts_color",'#012331');
		$value_of_std[6]=get_theme_mod($this->shortcolorcontrol."_text_headers_color",'#012331');
		$value_of_std[7]=get_theme_mod($this->shortcolorcontrol."_primary_text_color",'#1f1f1f');
		$value_of_std[8]=get_theme_mod($this->shortcolorcontrol."_footer_text_color",'#1f1f1f');
		$value_of_std[9]=get_theme_mod($this->shortcolorcontrol."_primary_links_color",'#000000');
		$value_of_std[10]=get_theme_mod($this->shortcolorcontrol."_primary_links_hover_color",'#000000');
		$value_of_std[11]=get_theme_mod($this->shortcolorcontrol."_menu_links_color",'#FFFFFF');
		$value_of_std[12]=get_theme_mod($this->shortcolorcontrol."_menu_links_hover_color",'#FFFFFF');		
		$value_of_std[13]=get_theme_mod($this->shortcolorcontrol."_menu_color",'#044967');
		$value_of_std[14]=get_theme_mod($this->shortcolorcontrol."_selected_menu_color",'#044967');
		$value_of_std[15]=get_theme_mod($this->shortcolorcontrol."_color_scheme",'#E0E0E0');	
		$value_of_std[16]=get_theme_mod($this->shortcolorcontrol."_logo_text_color",'#ffffff');
		$value_of_std[17]=get_theme_mod($this->shortcolorcontrol."_logo_text_color_for_phone",'#000000');		

		
		$this->options_colorcontrol = array(
		   "menu_elem_back_color" => array(
			
				"name" => "Menu Element Backround Color",
				
				"desc" => "",
				
				"var_name" =>'menu_elem_back_color',

				"id" => $this->shortcolorcontrol . "_menu_elem_back_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[0]
			), 	
			
			/* "content_back_color" =>  array(

				"name" => "Body Background Color",

				"desc" => "",
				
				"var_name" =>'content_back_color',

				"id" => $this->shortcolorcontrol . "_content_back_color",

				"type" => "picker",

				"std" => $value_of_std[1]
				
			),	*/
			
			 "sideb_background_color" =>  array(
			
				"name" => "Sidebar Background Color",
				
				"desc" => "",
				
				"var_name" =>'sideb_background_color',

				"id" => $this->shortcolorcontrol . "_sideb_background_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[2]
			),	

			 "footer_back_color" =>  array(

				"name" => "Footer Background Color",

				"desc" => "",
				
				"var_name" =>'footer_back_color',

				"id" => $this->shortcolorcontrol . "_footer_back_color",

				"type" => "picker",

				"std" => $value_of_std[3]
				),
				
			 "home_top_posts_color" =>  array(

				"name" => "Featured Post Background Color",

				"desc" => "",
				
				"var_name" =>'home_top_posts_color',

				"id" => $this->shortcolorcontrol . "_home_top_posts_color",

				"type" => "picker",

				"std" => $value_of_std[4]
				),		
				
			 "top_posts_color" =>  array(

				"name" => "Top Posts Background Color",

				"desc" => "",
				
				"var_name" =>'top_posts_color',

				"id" => $this->shortcolorcontrol . "_top_posts_color",

				"type" => "picker",

				"std" => $value_of_std[5]
				),	
				
			 "text_headers_color" =>  array(

				"name" => "Header Text(&lt;h1&gt; etc) Color",

				"desc" => "",
				
				"var_name" =>'text_headers_color',

				"id" => $this->shortcolorcontrol . "_text_headers_color",

				"type" => "picker",

				"std" => $value_of_std[6]
			),	

			

			 "primary_text_color" =>  array(

				"name" => "Primary Text Corlor",

				"desc" => "",
				
				"var_name" =>'primary_text_color',

				"id" => $this->shortcolorcontrol . "_primary_text_color",

				"type" => "picker",

				"std" => $value_of_std[7]
			),
			
			 "footer_text_color" =>  array(

				"name" => "Footer Text Color",

				"desc" => "",
				
				"var_name" =>'footer_text_color',

				"id" => $this->shortcolorcontrol . "_footer_text_color",

				"type" => "picker",

				"std" => $value_of_std[8]
			),

			

			 "primary_links_color" =>  array(

				"name" => "Primary Links",

				"desc" => "",
				
				"var_name" =>'primary_links_color',

				"id" => $this->shortcolorcontrol . "_primary_links_color",

				"type" => "picker",

				"std" => $value_of_std[9]
			),

			 "primary_links_hover_color" =>  array(

				"name" => "Primary Links Hover",

				"desc" => "",
				
				"var_name" =>'primary_links_hover_color',

				"id" => $this->shortcolorcontrol . "_primary_links_hover_color",

				"type" => "picker",

				"std" => $value_of_std[10]
			),

			 "menu_links_color" =>  array(

				"name" => "Menu Links",

				"desc" => "",
				
				"var_name" =>'menu_links_color',

				"id" => $this->shortcolorcontrol . "_menu_links_color",

				"type" => "picker",

				"std" => $value_of_std[11]
			),

			 "menu_links_hover_color" =>  array(

				"name" => "Menu Links Hover",

				"desc" => "",
				
				"var_name" =>'menu_links_hover_color',

				"id" => $this->shortcolorcontrol . "_menu_links_hover_color",

				"type" => "picker",

				"std" => $value_of_std[12]
			),			
			

			 "menu_color" =>  array(

				"name" => "Hover Menu Item",

				"desc" => "",
				
				"var_name" =>'menu_color',

				"id" => $this->shortcolorcontrol . "_menu_color",

				"type" => "picker",

				"std" => $value_of_std[13]
			),
			
			 "selected_menu_color" =>  array(

				"name" => "Selected Menu Item",

				"desc" => "",
				
				"var_name" =>'selected_menu_color',

				"id" => $this->shortcolorcontrol . "_selected_menu_color",

				"type" => "picker",

				"std" => $value_of_std[14]
			),

			 "color_scheme" =>  array(
			
				"name" => " ",
				
				"var_name" =>'color_scheme',

				"id" => $this->shortcolorcontrol . "_color_scheme",
				
				"type" => "",
				
				"std" => $value_of_std[15]
			),
			
			 "logo_text_color" =>  array(
			
				"name" => "Logo Text Color ",
				
				"desc" => "",
				
				"var_name" =>'logo_text_color',

				"id" => $this->shortcolorcontrol . "_logo_text_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[16]
			),
			"logo_text_color_for_phone" =>  array(
			
				"name" => "Logo Text Color For Phone",
				
				"desc" => "",
				
				"var_name" =>'logo_text_color_for_phone',

				"id" => $this->shortcolorcontrol . "_logo_text_color_for_phone",
				
				"type" => "picker",
				
				"std" => $value_of_std[17]
			)
			
					

		);
		
	
	
	}
	
	public function web_bussines_customize_preview_js() {
	 	wp_enqueue_script( 'web_bussines-customizer', get_template_directory_uri() . '/scripts/theme-customizer.js', array( 'customize-preview' ) );
	}
	
	

	/// save changes or reset options
	public function web_dorado_theme_update_and_get_options_color_control(){
		
		if ( isset($_GET['page']) && $_GET['page'] == "web_dorado_theme" && isset($_GET['controller']) && $_GET['controller'] == "color_control_page") {

			if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save' ) {
				foreach ($this->options_colorcontrol as $value) {
					set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);

				}
				foreach ($this->options_colorcontrol as $value) {
					if (isset($_REQUEST[$value['var_name']])) {
						set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);
					} else {
						remove_theme_mod($value['id']);
					}
				}
				header("Location: themes.php?page=web_dorado_theme&controller=color_control_page&saved=true");
				die;
			} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset' ) {
				foreach ($this->options_colorcontrol as $value) {
					remove_theme_mod($value['id']);
				}
				header("Location: themes.php?page=web_dorado_theme&controller=color_control_page&reset=true");
				die;
			}
		}	
	}
	
	public function web_dorado_color_control_page_admin_scripts(){

		wp_enqueue_style('color_control_page_main_style',get_template_directory_uri('template_directory').'/admin/css/color_control.css');	
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_style( 'wp-color-picker' );
		

	}
	
	public function update_color_control(){

//for update global options
global $exclusive_color_control_page;

foreach ($exclusive_color_control_page->options_colorcontrol as $value) {
     $$value['var_name'] = $value['std']; 
}
$background_color = get_background_color();
$background_image=get_background_image();
?>
 <style type="text/css">

h1, h2, h3, h4, h5, h6, h1>a, h2>a, h3>a, h4>a, h5>a, h6>a,h1 > a:link, h2 > a:link, h3 > a:link, h4 > a:link, h5 > a:link, h6 > a:link,h1 > a:hover,h2 > a:hover,h3 > a:hover,h4 > a:hover,h5 > a:hover,h6 > a:hover,h61> a:visited,h2 > a:visited,h3 > a:visited,h4 > a:visited,h5 > a:visited,h6 > a:visited {
    color:<?php echo $text_headers_color; ?>;
}


a:link.site-title-a,a:hover.site-title-a,a:visited.site-title-a,a.site-title-a{
	color:<?php echo $logo_text_color;?>;
}

.phone a:link.site-title-a,.phone a:hover.site-title-a,.phone a:visited.site-title-a,.phone a.site-title-a{
	color:<?php echo $logo_text_color_for_phone;?>;
}
a.read_more:visited,a.read_more:link,.read_more, .more-link, .reply,#cancel-comment-reply-link,#commentform #submit {
     color:<?php echo $menu_links_color; ?> !important;
	 background:<?php echo $menu_elem_back_color; ?>;
}
a.read_more:hover,.reply:hover,.read_more:hover,#reply-title small:hover,#reply-title small:hover >a,#commentform #submit:hover{
     color:<?php echo $menu_links_hover_color; ?> !important;
	 background:<?php echo $selected_menu_color; ?> !important;
}

.reply a, .more-link,#top-posts-list li a span, #back h3 a, #back p, strong.heading{ 
	     color:<?php echo $menu_links_color;?> !important;

}
.read_more:hover, a.read_more:hover, .more-link:hover {
      color:<?php echo '#'.exclusive_ligthest_brigths($menu_links_color,50); ?> !important;
     background-color: <?php echo '#'.exclusive_ligthest_brigths($menu_elem_back_color,15); ?>;
}

#back {
     background-color: <?php echo '#'.exclusive_ligthest_brigths($menu_elem_back_color, 10); ?>;
}

#content{
}

#site-description{  
	background-image:url('<?php echo  $background_image; ?>');
	background-color:#<?php echo $background_color; ?>;
}

#header-block{
	background-color:<?php echo $menu_color; ?>;
}
#logo-block a.hedar-a-element{
	background:<?php echo $menu_color; ?>;
}
.header-phone-block{
	background-image:url('<?php echo  get_background_image(); ?>');
	background-color:#<?php echo $background_color; ?>;
}
.container.device.phone,
#footer{
	background-color:<?php echo $footer_back_color; ?>;
}

.topPost {
    background-image: url(<?php echo get_template_directory_uri('template_url'); ?>/images/topPost-back<?php if($color_scheme == "Theme-1") echo "1"; elseif($color_scheme == "Theme-2") echo "2"; elseif($color_scheme == "Theme-3") echo "3"; else echo "1"; ?>.png);
}

.content {
    background-color: #<?php echo $background_color; ?>;
}

.container.device,
#footer {
    background-color: <?php echo $footer_back_color; ?>;
}


body{
	color: <?php echo $primary_text_color; ?> !important;
}
#wrapper{
    color: <?php echo $primary_text_color; ?>;
}


.container.device,
#footer {
    color: <?php echo $footer_text_color; ?>;
}

a:link, a:visited {
    text-decoration: none;
    color: <?php echo $primary_links_color; ?>;
}

 .top-nav-list .current-menu-item, .top-nav-list .current_page_item{
    color: <?php echo $menu_links_hover_color; ?> !important;
	background-color: <?php echo  $selected_menu_color; ?>;
}

a:hover {
    color: <?php echo $primary_links_hover_color; ?>;
}

.sep{
  color: <?php echo $menu_elem_back_color; ?>;
}

.get_title{
	background-color:<?php echo $menu_color; ?>;
	background-image:url(<?php echo get_template_directory_uri( 'template_url' ); ?>/images/Shado.png);
	background-position: bottom;
	background-repeat: no-repeat;
}
#slideshow {
     background:<?php echo $menu_color; ?>  url(<?php echo get_template_directory_uri('template_url'); ?>/images/page.bg.png) center center no-repeat;
}

#header{
	background-color:<?php echo $menu_color; ?>;
}

#menu-button-block {
    background-color: <?php echo $menu_color; ?>;
}

.top-nav-list li li:hover .top-nav-list a:hover, .top-nav-list .current-menu-item a:hover{
    background-color: <?php echo $menu_color; ?>;
}
.top-nav-list li:hover {
    background-color: <?php echo $menu_color; ?>;
}
.top-nav-list li.current-menu-item, .top-nav-list li.current_page_item, .top-nav-list.phone li.current-menu-item, .top-nav-list.phone li.current_page_item, .top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active,  .top-nav-list.phone  li.current-menu-item > a:hover,   .top-nav-list.phone  li.current-menu-item:hover{
    color:<?php echo $menu_links_hover_color ?> !important;
	background-color: <?php echo $selected_menu_color; ?> ;
}
.top-nav-list li.current-menu-item > a, .top-nav-list li.current_page_item > a{
	color: <?php echo $menu_links_hover_color; ?>;
}

#top-page {
    background-color:<?php echo $home_top_posts_color; ?>;
}

.container.top-posts.phone{
	background-color:#<?php echo $background_color; ?> !important;
}

.phone .header-phone-block{
	background-color:#<?php echo $background_color; ?> !important;
}
#top-nav {
   background:<?php echo $menu_elem_back_color; ?>;
}

#reply-title small a:link, .top-nav-list li a{
   color:<?php echo $menu_links_color; ?>;	
}

#top-nav-list > li ul, .top-nav-list > ul > li ul{
	background:<?php echo $this->hex_to_rgba($menu_elem_back_color,0.6); ?>;
}

.phone #top-nav ul{
   background:<?php echo $menu_elem_back_color; ?> !important;
}
.phone #top-nav{
   background:none !important;
}


.sidebar-container {
   background-color:<?php echo $sideb_background_color; ?>;
}
.commentlist li {
	  background-color:<?php echo $sideb_background_color; ?>;
}
.children .comment{
	  background-color:<?php echo '#'.exclusive_ligthest_brigths($sideb_background_color,37); ?>;
}
#respond{
	  background-color:<?php echo '#'.exclusive_ligthest_brigths($sideb_background_color,37); ?>;
}
#reply-title small{
	 background:<?php echo $menu_elem_back_color; ?>;
}


#top-nav.phone  > li  > a, #top-nav.phone  > li  > a:link, #top-nav.phone  > li  > a:visited, a .page-links-number, .post-password-form input[type="submit"], #searchsubmit, .more-link  {
	color:<?php echo $menu_links_color; ?>;
	background:<?php echo $menu_elem_back_color; ?>;
}
.top-nav-list.phone  > li:hover > a ,.top-nav-list.phone  > li  > a:hover, .top-nav-list.phone  > li  > a:focus, .top-nav-list.phone  > li  > a:active {
	color:<?php echo $menu_links_hover_color; ?> !important;
	background:<?php echo $menu_color; ?>;
}
#top-posts {  
   background: url(<?php echo get_template_directory_uri('template_url'); ?>/images/top.posts.bg.png) left 0px repeat-x;
   background-color:<?php echo $top_posts_color; ?>;
   background-size: contain;
}

.styledHeading{
background:<?php echo $menu_color; ?>; /* Old browsers */
background: -moz-linear-gradient(top,  <?php echo $menu_color; ?> 0%, <?php echo '#'.exclusive_ligthest_brigths($menu_color,15); ?> 70%, <?php echo '#'.exclusive_ligthest_brigths($menu_color,20); ?> 100%); /* FF3.6+ */

background: -webkit-linear-gradient(left,  <?php echo $menu_color; ?> 0%,<?php echo '#'.exclusive_ligthest_brigths($menu_color,15); ?> 70%,<?php echo '#'.exclusive_ligthest_brigths($menu_color,20); ?> 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left,  <?php echo $menu_color; ?> 0%,<?php echo '#'.exclusive_ligthest_brigths($menu_color,15); ?> 70%,<?php echo '#'.exclusive_ligthest_brigths($menu_color,20); ?> 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left,  <?php echo $menu_color; ?> 0%,<?php echo '#'.exclusive_ligthest_brigths($menu_color,15); ?> 70%,<?php echo '#'.exclusive_ligthest_brigths($menu_color,20); ?> 100%); /* IE10+ */
background: linear-gradient(to right,  <?php echo $menu_color; ?> 0%,<?php echo '#'.exclusive_ligthest_brigths($menu_color,20); ?> 70%,<?php echo '#'.exclusive_ligthest_brigths($menu_color,40); ?> 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $menu_color; ?>', endColorstr='<?php echo '#'.exclusive_ligthest_brigths($menu_color,20); ?>',GradientType=1 ); /* IE6-9 */
color:<?php echo $logo_text_color; ?>;
}



#menu-button-block {
	background-color:<?php echo $menu_color; ?> !important;	
}

#menu-button-block a {
	background-image:url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu.phone.png);
}
.top-nav-list.phone   li ul li  > a, .top-nav-list.phone   li ul li  > a:link, .top-nav-list.phone   li  ul li > a:visited {
	color:<?php echo $menu_links_color ?> !important;
}
#top-nav-list > li > a:not(#top-nav-list .current-menu-item, .top-nav-list .current-menu-item), #top-nav-list > li ul > li > a:not(#top-nav-list .current-menu-item, .top-nav-list .current-menu-item), #top-nav-list li a:not(#top-nav-list .current-menu-item, .top-nav-list .current-menu-item), .top-nav-list li a:not(#top-nav-list .current-menu-item, .top-nav-list .current-menu-item), #top-nav-list > li ul > li > a:not(#top-nav-list .current-menu-item, .top-nav-list .current-menu-item){
    color:<?php echo $menu_links_color ?>;
}
#top-nav-list > li > a:hover, .top-nav-list > li > a:hover, #top-nav-list > li ul > li > a:hover{
    color:<?php echo $menu_links_hover_color ?>;
}
.top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active {
	color:<?php echo $menu_links_hover_color; ?> !important;
	background-color:<?php echo $menu_color; ?> !important;
}
.top-nav-list.phone  li.has-sub >  a, .top-nav-list.phone  li.has-sub > a:link, .top-nav-list.phone  li.has-sub >  a:visited {
	background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_right.png) right top no-repeat;
	background-size: contain !important;
}


.top-nav-list.phone  li.current-menu-item.has-sub:hover > a, .top-nav-list.phone  li.current-page-ancestor.has-sub:hover > a, .top-nav-list.phone  li.current-menu-item.has-sub > a:hover, .top-nav-list.phone  li.current-menu-item.has-sub > a:focus, .top-nav-list.phone  li.current-menu-item.has-sub >  a:active {
	background:<?php echo $menu_color; ?>  url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_down.png) right top no-repeat !important;
	background-size: contain !important;
}

.top-nav-list.phone  li ul li.has-sub > a, .top-nav-list.phone  li ul li.has-sub > a:link, .top-nav-list.phone  li ul li.has-sub > a:visited{
	background:<?php echo '#'.exclusive_ligthest_brigths($menu_elem_back_color,10); ?>  url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_right.png) right no-repeat;
	background-size: contain !important;
}

.phone #top-nav-list > li ul li,.top-nav-list.phone > ul > li ul li {
	background-color:<?php echo '#'.exclusive_ligthest_brigths($menu_elem_back_color,10); ?>; 
}

.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-item > a:focus, .top-nav-list.phone  li.current-menu-item > a:active{
	color:<?php echo $menu_links_color ?>;
	background-color:<?php echo $menu_color; ?> !important;
}

.top-nav-list.phone  li.current-menu-ancestor.has-sub > a, .top-nav-list.phone  li.current-menu-item.has-sub > a, .top-nav-list.phone  li.current-menu-item.has-sub > a{
	background:<?php echo $selected_menu_color; ?>  url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_down.png) right no-repeat;
	background-size: contain !important;
}

.top-nav-list.phone  li.current-menu-ancestor.has-sub > a:hover, .top-nav-list.phone  li.current_page_item.has-sub > a:hover, .top-nav-list.phone  li.current-menu-item.has-sub > a:focus, .top-nav-list.phone  li.current-menu-item.has-sub > a:active{
	background:<?php echo $menu_color; ?>  url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_down.png) right no-repeat !important;
	background-size: contain !important;
}

.top-nav-list.phone  li.current-menu-item > a,.top-nav-list.phone  li.current-menu-item > a:visited,
{
	color:<?php echo $primary_links_hover_color ?> !important;
	background-color:<?php echo $selected_menu_color; ?> !important;
}
#top-nav-list > li{
	border-right:1px solid <?php echo $selected_menu_color; ?>;
}
.phone  #top-nav-list > li a, .phone #top-nav-list > li ul li a,.phone.top-nav-list > ul > li a, .phone.top-nav-list > ul> li ul li a {
   	border-bottom:3px solid <?php echo $menu_color; ?> !important;
}
.phone  #top-nav-list > ul li:first-child { 
border-top:3px solid <?php echo $menu_color; ?> !important;
}

    </style>

<?php
}
	private function negativeColor($color)
	{
		//get red, green and blue
		$r = substr($color, 0, 2);
		$g = substr($color, 2, 2);
		$b = substr($color, 4, 2);
		
		//revert them, they are decimal now
		$r = 0xff-hexdec($r);
		$g = 0xff-hexdec($g);
		$b = 0xff-hexdec($b);
		
		//now convert them to hex and return.
		return dechex($r).dechex($g).dechex($b);
	}
	
	public function dorado_theme_admin_color_control(){
		if(isset($_REQUEST['controller']) && $_REQUEST['controller']=='color_control_page'){
			if (isset($_REQUEST['saved']) && $_REQUEST['saved'] ) 
		
			echo '<div id="message" class="updated"><p><strong>' . $this->colorcontrol . ' settings saved.</strong></p></div>';
			
		if (isset($_REQUEST['reset']) && $_REQUEST['reset'] ) 
		
			echo '<div id="message" class="updated"><p><strong>' . $this->colorcontrol . ' settings reset.</strong></p></div>';
		}
		global $exclusive_admin_helepr_functions;
		$pickers=$this->get_option_type('picker');
		$count_picker=count( $pickers );
		$array_of_colors=array(
							array(
								"menu_elem_back_color" => "#022433", 
								"sideb_background_color" => "#ECECEC", 
								"footer_back_color" => "#ECECEC", 
								"home_top_posts_color" => "#ECECEC", 
								"top_posts_color" => "#012331", 
								"text_headers_color" => "#012331", 
								"primary_text_color" => "#1f1f1f", 
								"footer_text_color" => "#1f1f1f", 
								"primary_links_color" => "#000000", 
								"primary_links_hover_color" => "#000000", 
								"menu_links_color" => "#ffffff", 
								"menu_links_hover_color" => "#ffffff", 
								"menu_color" => "#044967", 
								"selected_menu_color" => "#044967", 
								"logo_text_color" => "#ffffff",
								"logo_text_color_for_phone" => "#000000",
							),
							array(
								"menu_elem_back_color" => "#D4D2D2", 
								"sideb_background_color" => "#ECECEC", 
								"footer_back_color" => "#ECECEC", 
								"home_top_posts_color" => "#ECECEC", 
								"top_posts_color" => "#086200", 
								"text_headers_color" => "#086200", 
								"primary_text_color" => "#1f1f1f", 
								"footer_text_color" => "#1f1f1f", 
								"primary_links_color" => "#000000", 
								"primary_links_hover_color" => "#000000", 
								"menu_links_color" => "#3E3E3E", 
								"menu_links_hover_color" => "#3E3E3E", 
								"menu_color" => "#EDEDED", 
								"selected_menu_color" => "#EDEDED", 
								"logo_text_color" => "#086200",
								"logo_text_color_for_phone" => "#086200",
							),							
							array(
								"menu_elem_back_color" => "#091F3C", 
								"sideb_background_color" => "#ECECEC", 
								"footer_back_color" => "#ECECEC", 
								"home_top_posts_color" => "#ECECEC", 
								"top_posts_color" => "#0D2C53", 
								"text_headers_color" => "#0B2749", 
								"primary_text_color" => "#000000", 
								"footer_text_color" => "#000000", 
								"primary_links_color" => "#000000", 
								"primary_links_hover_color" => "#000000", 
								"menu_links_color" => "#ffffff", 
								"menu_links_hover_color" => "#ffffff", 
								"menu_color" => "#044A9F", 
								"selected_menu_color" => "#044A9F", 
								"logo_text_color" => "#ffffff",
								"logo_text_color_for_phone" => "#000000",								
							),
							array(
								"menu_elem_back_color" => "#C1C2C2", 
								"sideb_background_color" => "#ECECEC", 
								"footer_back_color" => "#ECECEC", 
								"home_top_posts_color" => "#ECECEC", 
								"top_posts_color" => "#BE4415", 
								"text_headers_color" => "#BE4415", 
								"primary_text_color" => "#1f1f1f", 
								"footer_text_color" => "#1f1f1f", 
								"primary_links_color" => "#000000", 
								"primary_links_hover_color" => "#000000", 
								"menu_links_color" => "#383838", 
								"menu_links_hover_color" => "#383838", 
								"menu_color" => "#EDEDED", 
								"selected_menu_color" => "#EDEDED", 
								"logo_text_color" => "#BE4415", 
								"logo_text_color_for_phone" => "#BE4415",
							)
							);
		
		
		
		?><?php $this->default_themes_jquery($array_of_colors) ?>
		
        <?php global $exclusive_web_dor; ?>
		<div id="main_color_control_page">			
			<table align="center" width="90%" style="margin-top: 0px;border-bottom: rgb(111, 111, 111) solid 2px;">
			    <tr>   
                      <td style="font-size:14px; font-weight:bold">
					     <a href="<?php echo $exclusive_web_dor.'/wordpress-themes-guide-step-1.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">User Manual</a><br />This section allows you customize the color features.
                         <a href="<?php echo $exclusive_web_dor.'/wordpress-theme-options/3-6.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">More...</a>
					 </td>    
                      <td  align="right" style="font-size:16px;">
                           <a href="<?php echo $exclusive_web_dor.'/wordpress-themes/exclusive.html'; ?>" target="_blank" style="color:red; text-decoration:none;">
                              <img src="<?php echo get_template_directory_uri() ?>/images/header.png" border="0" alt="" width="215">
                           </a>
                       </td>
                </tr>
				<tr>
					<td style="height: 70px;"><h3 style="margin: 0px;font-family:Segoe UI;color: rgb(111, 111, 111); font-size:18pt;">Color Control</h3></td>
				</tr>
			</table>
		  <div style="margin: 0 auto;width:90%;padding-bottom:0px; padding-top:0px;">		
			<div class="optiontitle" style="">
				  <p style="font-size:15px;font-weight:bold;color: #333;">The color customization parameters are disabled in free version. Please buy the commercial version in order to enable this functionality.</p>
				  <img src="<?php echo get_template_directory_uri(); ?>/images/color.jpg" width="100%" style="border-bottom: 1px solid rgb(206, 206, 206);">
			</div>
	</div>
</div>	
		 <?php
	}
	
	private function get_option_type($type=''){
	$cur_type_elements=array();
	$k=0;
	foreach( $this->options_colorcontrol as $option ){
		
		if(isset($type) && isset($option['type']) && $option['type'] == $type ){
		
			$cur_type_elements[$k]=$option;
			$k++;
		}
		
	}
	return $cur_type_elements;
	}
	
	
	private function default_themes_jquery($array_of_colors=NULL){
		// print array if it not set
		if($array_of_colors===NULL){
			echo "\$array_of_colors=array(<br>array(<br>";
			foreach($this->options_colorcontrol as $key=>$special_color){
				if($special_color['type']=='picker'){
					echo "	\"".$special_color['var_name']."\" => \"".$special_color['std']."\", <br>";
				}
			}
			echo "),<br>array(<br>";
			foreach($this->options_colorcontrol as $key=>$special_color){
				if($special_color['type']=='picker'){
					echo "	\"".$special_color['var_name']."\" => \"".$special_color['std']."\", <br>";
				}
			}
			echo ")); esi copy past ara array_of_colors tex@ kashxati";
			die();
			
		}
		// print qjeru and initial colors standart themes
		else
		{			
			echo '<script>jQuery(document).ready(function(){
				jQuery("#color_scheme").change(function () {
					var bkg = jQuery("#color_scheme option:selected").val();  ';

			foreach($array_of_colors as $key=>$colors){
				
				echo 'if (bkg == "Theme-'.($key+1).'") {';
					foreach($colors as $key=>$color){				
					
						echo 'jQuery("#'.$key.'").val("'.$color.'"); ';
						echo 'jQuery("#'.$key.'").css("backgroundColor", "'.$color.'"); ';
						echo 'jQuery("#'.$key.'").iris("color", "'.$color.'"); ';
						echo 'jQuery("#'.$key.'_picker").children("div").css("backgroundColor", "'.$color.'"); ';
 
					}
				echo " }";
			}
			
			echo "});  });</script>";
		}
		
		
	}
	private function default_theme_select($array_of_colors=NULL){
		$count_of_selects=count($array_of_colors);
		
		echo '<select name="color_scheme" id="color_scheme">';
		
		for($i=1;$i<=$count_of_selects;$i++){
			$selected='';
			$selected=selected($this->options_colorcontrol['color_scheme']['std'], 'Theme-'.$i );
			echo '<option value="Theme-'.$i.'" '.$selected.'>Theme-'.$i.'</option>';
			
		}
		
		echo '</select>';
		
		
	}
	private function hex_to_rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	//Return default if no color provided
	if(empty($color))
          return $default; 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
        //Return rgb(a) color string
        return $output;
}
}
 
