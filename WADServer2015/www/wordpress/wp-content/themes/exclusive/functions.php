<?php

/////////////////////// include admin



require_once(trailingslashit( get_template_directory() ). 'admin/main_admin_controler.php');
require_once(trailingslashit( get_template_directory() ). 'front_end/front_end_functions.php');



function exclusive_setup() {

add_theme_support( 'custom-header', array(
	// Header image default
	'default-image'       => '',
	// Header text display default
	'header-text'         => false,
	'wp-head-callback'    => 'exclusive_header_style',
	
) );

$exclusive_defaults = array(
	'default-color'          => 'E3E1E2',
	'default-image'          => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $exclusive_defaults );

	if(!get_theme_mod('background_color',false)){
		set_theme_mod('background_color','e3e1e2')	;
	}


	 load_theme_textdomain('wd_exclusive', get_template_directory() . '/languages' );
	 
	 add_editor_style();
	 
	 
	 global $exclusive_layout_page;
	 foreach ($exclusive_layout_page->options_themeoptions as $value) {
		if(isset($value['id'])){
			if (get_theme_mod($value['id']) === FALSE) {
				
				$$value['var_name'] = $value['std'];
			} else {
				
				$$value['var_name'] = get_theme_mod($value['id']);
			}
		}

	}
	 
	 global $content_width;
	 if ( !isset( $content_width  ) ) {
			$content_width  = $content_area;
		}
	
}

add_action( 'after_setup_theme', 'exclusive_setup' );

function exclusive_header_style(){
	$header_image = get_header_image();
	?>
	
	<style type="text/css">
		
	<?php
	if ( ! empty( $header_image ) ) {
	?>.site-title {
			background: url(<?php header_image(); ?>) no-repeat scroll top;
			/*background-size: 1600px auto;*/
		}
		<?php
	}
	?>
	</style>
	
	<?php
}


add_action('wp_head', 'exclusive_header');

function exclusive_header(){
	global  $exclusive_layout_page,		// leayut class varaible
		$exclusive_typography_page,	// typagraphi class varaible
		$exclusive_color_control_page;// color control class varaible
	foreach ($exclusive_color_control_page->options_colorcontrol as $value) {
     $$value['var_name'] = $value['std']; 
	}	

	if ( is_singular() && get_theme_mod( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_get_post_tags('type=monthly&format=link');	

	$exclusive_layout_page->update_layout_editor();
	$exclusive_typography_page->print_fornt_end_style_typography();
	$exclusive_color_control_page->update_color_control();

	exclusive_favicon_img();
	exclusive_custom_head();
	
	////////
	$menu_slug = 'primary-menu';
	 if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_slug ] ) && $locations[ $menu_slug ]!=0 ) {
	$menu = wp_get_nav_menu_object( $locations[ $menu_slug ] );
	if($menu){
	$menu_items = wp_get_nav_menu_items($menu->term_id);
	?>
	<script type="text/javascript">
	setTimeout(function(){
    <?php
	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $id = $menu_item->ID; ?>
		
       if(jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub").hasClass("current-menu-item")){
	        jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub > ul").css("display", "block");
			jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub > a").css("background", "<?php echo $selected_menu_color; ?>  url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_down.png) right no-repeat");
		  }
		  if(jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub").hasClass("current-menu-parent")){
	        jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub > ul").css("display", "block");
			jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub > a").css("background", "url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_down.png) right no-repeat");
		  }
		  if(jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub").hasClass("current-page-parent")){
	        jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub > ul").css("display", "block");
			jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub > a").css("background", "url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_down.png) right no-repeat");
		  }
		  if(jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub").hasClass("current-menu-ancestor")){
	        jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub > ul").css("display", "block");
			jQuery(".top-nav-list.phone .menu-item-<?php echo $id; ?>.has-sub > a").css("background", "url(<?php echo get_template_directory_uri('template_url'); ?>/images/menu_down.png) right no-repeat");
		  }
		 
		
	<?php } ?>
	},500);
	</script>
	
<?php }
 
}	
		
	////////
}

function exclusive_wp_title( $title, $sep ) {
	global $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";


	return $title;
}
add_filter( 'wp_title', 'exclusive_wp_title', 10, 2 );



function exclusive_entry_meta() {
    $categories_list = get_the_category_list(', ' );

	if ( $categories_list ) {
		echo '<span class="categories-links"><span class="sep">C.</span> ' . $categories_list . '</span>';
	}
	$tag_list = get_the_tag_list( '', ' , ' );
	
	if ( $tag_list ) {
		echo '<span class="tags-links"><span class="sep">T. </span>' . $tag_list . '</span>';
	}
}

function exclusive_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>','wd_exclusive' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		get_the_author()
	);	
} 

function exclusive_posted_on_blog() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">Posted on %4$s</time></a>','wd_exclusive' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		get_the_author()
	);	
}

function exclusive_posted_on_single() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'wd_exclusive' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'wd_exclusive' ), get_the_author() ) ),
		get_the_author()
	);
}

function exclusive_post_nav() {
	global $post;
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next    = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
		<nav class="page-navigation">
			<?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title', 'Previous post link' ); ?>
			<?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>', 'Next post link'  ); ?>
		</nav>
	<?php
}

function exclusive_widgets_init()
{

    // Area 1, located at the top of the sidebar.

    register_sidebar(array(

            'name' => __('Primary Widget Area', 'WebBusiness'),

            'id' => 'sidebar-1',

            'description' => __('The primary widget area', 'WebBusiness'),

            'before_widget' => '<div id="%1$s" class="widget-area %2$s">',

            'after_widget' => '</div> ',

            'before_title' => '<h3>',

            'after_title' => '</h3>',

        )
    );

    // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.

    register_sidebar(array(

            'name' => __('Secondary Widget Area', 'WebBusiness'),

            'id' => 'sidebar-2',

            'description' => __('The secondary widget area', 'WebBusiness'),

            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',

            'after_widget' => '</div>',

            'before_title' => '<h3 class="widget-title">',

            'after_title' => '</h3>',
        )
    );
  
}

add_filter( 'wp_nav_menu_objects', 'exclusive_add_menu_parent_class', 10);
function exclusive_add_menu_parent_class( $items ) {
		
			$parents = array();
			foreach ( $items as $item ) {
				if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
					$parents[] = $item->menu_item_parent;
				}
			}
		
			foreach ( $items as $item ) {
				if ( in_array( $item->ID, $parents ) ) {
					$item->classes[] = 'haschild';
				}
			}
		
			return $items;
		}

//Register sidebars by running exclusive_widgets_init() on the widgets_init hook.

add_action('widgets_init', 'exclusive_widgets_init');

//Add support for WordPress 3.0's custom menus

add_action('init', 'exclusive_register_menu');

//Register area for custom menu

function exclusive_register_menu()
{

    register_nav_menu('primary-menu', __('Primary Menu','wd_exclusive'));

}
add_filter('nav_menu_css_class' , 'exclusive_special_nav_class' , 10 , 2);
function exclusive_special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}

function exclusive_add_first_and_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="menu-item', $output, 1);  
  $output = substr_replace($output, 'class="last menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}

add_filter('wp_nav_menu', 'exclusive_add_first_and_last', 10);

function exclusive_add_first_and_last_page_list($output) {
  $output = preg_replace('/class="page_item/', 'class="first page_item', $output, 1);  
  if(strripos($output, 'class="page_item'))
  $output = substr_replace($output, 'class="last page_item', strripos($output, 'class="page_item'), strlen('class="page_item'));
  return $output;
}

add_filter('wp_list_pages', 'exclusive_add_first_and_last_page_list', 10);

//Enable post and comments RSS feed links to head

add_theme_support('automatic-feed-links');

// Enable post thumbnails


    add_theme_support('post-thumbnails', array('post'));

    set_post_thumbnail_size(150, 150);




if( !function_exists('exclusive_the_excerpt_max_charlength')){
	function exclusive_the_excerpt_max_charlength($charlength,$content=false) {
	if($content)
	{
		$excerpt=$content;
	}
	else
	{
		$excerpt = get_the_excerpt();
	}
		$charlength++;
	
		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut ).'...';
			} else {
				echo $subex.'...';
			}
			
		} else {
			echo $excerpt;
		}
	}
}


function exclusive_catch_that_image()
{

    global $post, $posts;

    $first_img = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/', $post->post_content, $matches);
	if(isset($matches [1] [0])){	
    	$first_img = $matches [1] [0];
	}
    if (empty($first_img)) {

        //Defines a default image

        $first_img = get_template_directory_uri('template_url') . "/images/default.jpg";

    }

    return $first_img;
}


function exclusive_first_image($width, $height,$url_or_img=0)
{
    $thumb = exclusive_catch_that_image();
    if ($thumb) {

        $str = "<img src=\"";
        $str .= $thumb;

        $str .= '"';
        $str .= 'alt="'.get_the_title().'" width="'.$width.'" height="'.$height.'" border="0" />';
        return $str;
    }
}

function exclusive_empty_thumb()
{

    $thumb = get_post_custom_values("Image");

    return !empty($thumb);

}

function exclusive_display_thumbnail($width, $height)
{
    if (has_post_thumbnail()) the_post_thumbnail(array($width, $height));

    elseif (!exclusive_empty_thumb()) {
        return exclusive_first_image($width, $height);
    } else {
        return the_post_thumbnail(array($width, $height));
    }
}

function exclusive_thumbnail($width, $height)
{

    if (has_post_thumbnail())

        the_post_thumbnail(array($width, $height));

    elseif (exclusive_empty_thumb()) {

        return the_post_thumbnail(array($width, $height));

    }
}



function exclusive_remove_more_jump_link($link)
{

    $offset = strpos($link, '#more-');
    if ($offset) {
        $end = strpos($link, '"', $offset);
    }
    if ($end) {
        $link = substr_replace($link, '', $offset, $end - $offset);
    }

    return $link;

}

add_filter('the_content_more_link', 'exclusive_remove_more_jump_link', 10);

function exclusive_p2h_comment($comment, $args, $depth) {
	
	$GLOBALS['comment'] = $comment;
	
	switch ($comment->comment_type){
		case '' :
		?>
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-avatar"><?php echo get_avatar($comment, $size = '54'); ?></div>
		<div class="comment-body">
			<p class="comment-meta"><span
					class="comment-author"><?php comment_author_link(); ?></span><?php _e(' on ', 'wd_exclusive'); ?><?php comment_date() ?><?php _e(' at ', 'wd_exclusive'); ?><?php comment_time() ?>
				.</p>
			<?php if ($comment->comment_approved == '0') { ?>
				<p><strong><?php _e('Your comment is awaiting moderation.', 'wd_exclusive'); ?></strong></p>
			<?php } ?>
		
			<?php comment_text(); ?>
		
			<p class="comment-reply-meta"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></p>
		</div>
		<?php
		break;
		
		case 'pingback'  :
		case 'trackback' :
		?>
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" class="post pingback">
		<p><?php _e('Pingback:', 'wd_exclusive'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'wd_exclusive'), ' '); ?></p>
		<?php
		break;
		
	}
}



/***************/
/*page meta box*/
/***************/


add_action('admin_init', 'exclusive_meta_init');

function exclusive_meta_init()
{

    wp_enqueue_script('exclusive_meta_js', get_template_directory_uri() . '/custom/meta.js', array('jquery'));
    wp_enqueue_style('exclusive_meta_css', get_template_directory_uri() . '/custom/meta.css');

    foreach (array('post', 'page') as $type) {
        add_meta_box('exclusive_all_meta', 'Exclusive Custom Meta Box', 'exclusive_meta_setup', $type, 'normal', 'high');
    }

    add_action('save_post', 'exclusive_meta_save');
}

function exclusive_meta_setup()
{

	global $exclusive_layout_page,$exclusive_general_settings_page,$post;
	
	foreach ($exclusive_general_settings_page->options_generalsettings as $value) 
{
    if (get_theme_mod( $value['id'] ) === FALSE)
	{
		 $$value['var_name'] = $value['std']; 
	} else {
		 $$value['var_name'] = get_theme_mod( $value['id'] ); 
	}
}

	foreach ($exclusive_layout_page->options_themeoptions as $value) {
		if(isset($value['id'])){
			if (get_theme_mod($value['id']) === FALSE) {
				
				$$value['var_name'] = $value['std'];
			} else {
				
				$$value['var_name'] = get_theme_mod($value['id']);
			}
		}

	}
    // using an underscore, prevents the meta variable
    // from showing up in the custom fields section
    $meta = get_post_meta($post->ID, '_exclusive_meta', TRUE);
    $n_of_blog_post=get_option( 'posts_per_page', 3 ); 
	if( gettype ($post->ID) == 'integer' ){
		$meta=array(
			'layout' =>  $default_layout ,
			'content_width' =>  $content_area ,
			'main_col_width' =>  $main_column ,
			'pr_widget_area_width' =>  $pwa_width,
			'fullwidthpage' => $full_width,
			'blogstyle' => '',
			'showthumb' => '',
			'blog_perpage' => $n_of_blog_post,
			'showtitle' => '',
			'showdesc' => '',
			'detect_portrait' => '',
			'thumbsize' => '2',
			'static_pages_on' => '',			
			'all_categories_on' => '',
			'tags_on' => '',
			'archives_on' => '',
			'authors_on' => '',
		);
		
	}
	else
	{
		$meta_if_par_not_initilas=array(
			'layout' =>  $default_layout ,
			'content_width' =>  $content_area ,
			'main_col_width' =>  $main_column ,
			'pr_widget_area_width' =>  $pwa_width,
			'fullwidthpage' => $full_width,
			'blogstyle' => '',
			'showthumb' => '',
			'blog_perpage' => $n_of_blog_post,
			'showtitle' => '',
			'showdesc' => '',
			'detect_portrait' => '',
			'thumbsize' => '2',
			'static_pages_on' => '',			
			'all_categories_on' => '',
			'tags_on' => '',
			'archives_on' => '',
			'authors_on' => '',
			'blog_posts_on' => '',
		);
		foreach($meta_if_par_not_initilas as $key=>$meta_if_par_not_initila){
			
			if(!isset($meta[$key])){
				$meta[$key]=$meta_if_par_not_initila;
			}
		
		}
		
	}

    // instead of writing HTML here, lets do an include
    require_once( trailingslashit( get_template_directory() ). 'custom/meta.php');

    // create a custom nonce for submit verification later
    echo '<input type="hidden" name="exclusive_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

function exclusive_meta_save($post_id)
{
    // authentication checks

    // check user permissions
    if (isset($_POST['post_type']) && $_POST['post_type'] == 'page') {
        if (!current_user_can('edit_page', $post_id)) return $post_id;
    } else {
        if (!current_user_can('edit_post', $post_id)) return $post_id;
    }

    // authentication passed, save data

    $current_data = get_post_meta($post_id, '_exclusive_meta', TRUE);
	if(isset($_POST['_exclusive_meta']))
    $new_data = $_POST['_exclusive_meta'];

    exclusive_meta_clean($new_data);

    if ($current_data) {
        if (is_null($new_data)) delete_post_meta($post_id, '_exclusive_meta');
        else update_post_meta($post_id, '_exclusive_meta', $new_data);
    } elseif (!is_null($new_data)) {
        add_post_meta($post_id, '_exclusive_meta', $new_data, TRUE);
    }

    return $post_id;
}

function exclusive_meta_clean(&$arr)
{
    if (is_array($arr)) {
        foreach ($arr as $i => $v) {
            if (is_array($arr[$i])) {
                exclusive_meta_clean($arr[$i]);

                if (!count($arr[$i])) {
                    unset($arr[$i]);
                }
            } else {
                if (trim($arr[$i]) == '') {
                    unset($arr[$i]);
                }
            }
        }

        if (!count($arr)) {
            $arr = NULL;
        }
    }
}

/*******************/
/*page meta box end*/
/*******************/

//search filter
function exclusive_SearchFilter($query)
{
    if ($query->is_search or $query->is_feed) {
// Portfolio
		if(!isset($_GET['inc-posts']) && !isset($_GET['inc-pages'])){
			
				$query->set('post_type', array('post', 'page'));
			
		}
		else
        if ($_GET['inc-posts'] == "on" && $_GET['inc-pages'] != "on") {
            $query->set('post_type', 'post');
        } else if ($_GET['inc-posts'] != "on" && $_GET['inc-pages'] == "on") {
            $query->set('post_type', 'page');
        } else if ($_GET['inc-posts'] == "on" && $_GET['inc-pages'] == "on") {
            $query->set('post_type', array('post', 'page'));
        } else {
            $query->set('post_type', '');
        }
        if (isset($_GET['month']) && $_GET['month'] != "no") {
            $query->set('year', substr($_GET['month'], 0, 4));
            $query->set('monthnum', substr($_GET['month'], 4, 2));
        }
    }

    return $query;
}

// This filter will jump into the loop and arrange our results before they're returned
//add_filter('pre_get_posts', 'exclusive_SearchFilter');


function exclusive_update_page_layout_meta_settings()
{
	
	global $exclusive_layout_page, $post;
	foreach ($exclusive_layout_page->options_themeoptions as $value) {
		if(isset($value['id'])){
			if (get_theme_mod($value['id']) === FALSE) {
				
				$$value['var_name'] = $value['std'];
			} else {
				
				$$value['var_name'] = get_theme_mod($value['id']);
			}
		}

	}


    /*update page layout*/
  
	
	if(isset($post))
    $exclusive_meta = get_post_meta($post->ID, '_exclusive_meta', TRUE);

		
		if(!isset($exclusive_meta['content_width']))
		$exclusive_meta['content_width'] = $content_area;
		if(!isset($exclusive_meta['main_col_width']))
		$exclusive_meta['main_col_width'] = $main_column;
		if(!isset($exclusive_meta['layout']))
		$exclusive_meta['layout'] = $default_layout;
		if(!isset($exclusive_meta['pr_widget_area_width']))
		$exclusive_meta['pr_widget_area_width'] = $pwa_width;

	if (isset($exclusive_meta['fullwidthpage']) && $exclusive_meta['fullwidthpage']) {		
		$them_content_are_width='100%';
		?><script>var exclusive_full_width=1</script>
		  <style  type="text/css">
				     #footer-bottom{
						padding: 15px !important;
					}
		  </style><?php		
	}
	else {
			
		if(isset($exclusive_meta['content_width']))
			$them_content_are_width=$exclusive_meta['content_width'] . "px;";
		else
			$them_content_are_width=$content_area;
		?><script> var exclusive_full_width=0</script><?php
	}
  
    switch ($exclusive_meta['layout']) {
        //set styles leauts
        case 1:
			?>
            <style type="text/css">
			#sidebar1,
			#sidebar2 {
				display:none;
			}
			#blog	{
				display:block; 
				float:left;
			};
       
            .container{
            width:<?php echo $them_content_are_width; ?>
            }        
            #blog{
            width:<?php echo $them_content_are_width; ?>
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
			#blog{
				display:block;
				float:left;
			} 
            .container{
            width:<?php echo $them_content_are_width; ?>
            }
            #blog{
            width:<?php echo $exclusive_meta['main_col_width']; ?>%;
            }
            #sidebar1{
            width:<?php echo (100  - $exclusive_meta['main_col_width']); ?>%;
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
			#blog{
				display:block;
				float:left;
			}
            .container{
            width:<?php echo $them_content_are_width; ?>
            }
            #blog{
            width:<?php echo $exclusive_meta['main_col_width']; ?>%;
            }
            #sidebar1{
            width:<?php echo (100  - $exclusive_meta['main_col_width']); ?>%;
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
			#blog{
				display:block;
				float:left;
			}
            .container{
            width:<?php echo $them_content_are_width; ?>
            }
            #blog{
            width:<?php echo $exclusive_meta['main_col_width'] ; ?>%;
            }
            #sidebar1{
            width:<?php echo $exclusive_meta['pr_widget_area_width']; ?>%;
            }
            #sidebar2{
            width:<?php echo (100  - $exclusive_meta['pr_widget_area_width'] - $exclusive_meta['main_col_width']); ?>%;
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
			#blog{
				display:block;
				float:right;
			}
            .container{
            width:<?php echo $them_content_are_width; ?>
            }
            #blog{
            width:<?php echo $exclusive_meta['main_col_width']; ?>%;
            }
            #sidebar1{
            width:<?php echo $exclusive_meta['pr_widget_area_width']; ?>%;
            }
            #sidebar2{
            width:<?php echo (100  - $exclusive_meta['pr_widget_area_width'] - $exclusive_meta['main_col_width']); ?>%;
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
			#blog{
				display:block;
				float:left;
			}    			       
            .container{
            width:<?php echo $them_content_are_width; ?>
            }
            #blog{
            width:<?php echo $exclusive_meta['main_col_width']; ?>%;
            }
            #sidebar1{
            width:<?php echo $exclusive_meta['pr_widget_area_width']; ?>%;
            }
            #sidebar2{
            width:<?php echo (100  - $exclusive_meta['pr_widget_area_width'] - $exclusive_meta['main_col_width']); ?>%;
            }            
            </style><?php
            break;
    }
    /*update page layout end*/
}



/// include requerid scripts and styles


add_filter('wp_head','exclusive_include_requerid_scripts_for_theme',1);

function exclusive_include_requerid_scripts_for_theme(){
	wp_enqueue_script('jquery');	
	wp_enqueue_script('conect-js',get_template_directory_uri().'/scripts/conect_js.js');
	wp_enqueue_script('jquery-effects-transfer');
	wp_enqueue_style('exclusive-slider',get_template_directory_uri().'/slideshow/style.css');
	wp_enqueue_script('custom-js',get_template_directory_uri().'/scripts/javascript.js');
	wp_enqueue_script('theme-responsive', get_template_directory_uri().'/scripts/responsive.js');
	wp_enqueue_style( 'exclusive-style', get_stylesheet_uri(), array(), '2013-11-18' );
    wp_enqueue_style( 'exclusive-style');
	global 	$exclusive_general_settings_page;
	foreach ( $exclusive_general_settings_page->options_generalsettings as $value ) {
		if(isset($value['id'])){
			if ( get_theme_mod( $value['id'] ) === FALSE ) {
			   $$value['var_name'] = $value['std']; 
			} 
			else {
			   $$value['var_name'] = get_theme_mod( $value['id'] ); 
			}
		}
	}
	$custom_css = htmlspecialchars_decode( $custom_css );

	wp_add_inline_style( 'exclusive-style', $custom_css );
	
	
	if ( is_singular() && get_theme_mod( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );
}


function exclusive_main_queries($query){
	if(is_home() && is_front_page() && $query->is_main_query()){
		
		global $paged;
		global $exclusive_home_page;
		foreach ($exclusive_home_page->options_homepage as $value) 
		{
			if(isset($value['id']))
			{
				if (get_theme_mod( $value['id'] ) === FALSE)
				{
					 $$value['var_name'] = $value['std']; 
				} 
				else { 		
					$$value['var_name'] = get_theme_mod( $value['id'] );
				}	
			}
		}
        $cat_query="";
		$cat_checked="";
      
		$cat_query=substr($content_post_categories, 0, -1);
		$query->set( 'paged', $paged );
		$query->set( 'cat', $cat_query );
		$query->set( 'order', 'DESC' );
	}
}



function exclusive_ligthest_brigths($color,$pracent){

	$new_color=$color;
	if(!(strlen($new_color==6) || strlen($new_color)==7))
	{
		return $color;
	}
	$color_vandakanishov=strpos($new_color,'#');
	if($color_vandakanishov == false) {
		$new_color= str_replace('#','',$new_color);
	}
	$color_part_1=substr($new_color, 0, 2);
	$color_part_2=substr($new_color, 2, 2);
	$color_part_3=substr($new_color, 4, 2);
	$color_part_1=dechex( (int) (hexdec( $color_part_1 ) + (( 255-( hexdec( $color_part_1 ) ) ) * $pracent / 100 )));
	$color_part_2=dechex( (int) (hexdec( $color_part_2)  + (( 255-( hexdec( $color_part_2 ) ) ) * $pracent / 100 )));
	$color_part_3=dechex( (int) (hexdec( $color_part_3 ) + (( 255-( hexdec( $color_part_3 ) ) ) * $pracent / 100 )));
	$new_color=$color_part_1.$color_part_2.$color_part_3;
	if($color_vandakanishov == false){
		return $new_color;
	}
	else{
		return '#'.$new_color;
	}

}
function exclusive_remove_last_comma($string=''){
	
	if(substr($string,-1)==',')
		return substr($string, 0, -1);
	else
		return $string;
	
}

add_filter('body_class', 'exclusive_multisite_body_classes', 10);
function exclusive_multisite_body_classes($classes){
	foreach($classes as $key=>$class)
	{
		if($class=='blog')
		$classes[$key]='blog_body';
	}
	return $classes;
	
}

function exclusive_custom_head(){
	
global $exclusive_general_settings_page;
foreach ( $exclusive_general_settings_page->options_generalsettings as $value ) {
	if(isset($value['id'])){
		
		if ( get_theme_mod( $value['id'] ) === FALSE ) {
		   $$value['id'] = $value['std']; 
		} 
		else {
		   $$value['id'] = get_theme_mod( $value['id'] ); 
		}
		
	}
}?>

<script>
	var skzbi_hasce="<?php echo get_template_directory_uri(); ?>";
	$ = jQuery;
</script>
<?php

	echo "<style>".stripslashes(get_theme_mod("_custom_css"))."</style>";
?>

<?php
	
	
}
function exclusive_do_nothing($parametr=null){return $parametr;}
?>
