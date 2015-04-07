<?php
add_action('admin_init','exclusive_meta_init');

function exclusive_meta_init()
{
	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	// http://codex.wordpress.org/Function_Reference/wp_enqueue_style

	//wp_enqueue_script('exclusive_meta_js', MY_THEME_PATH . '/custom/meta.js', array('jquery'));
	wp_enqueue_style('exclusive_meta_css', MY_THEME_PATH . '/custom/meta.css');

	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/add_meta_box

	foreach (array('post','page') as $type) 
	{
		add_meta_box('exclusive_all_meta', 'Exclusive Custom Meta Box', 'exclusive_meta_setup', $type, 'normal', 'high');
	}
	
	add_action('save_post','exclusive_meta_save');
}

function exclusive_meta_setup()
{
	global $post;
 
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_exclusive_meta',TRUE);
 
	// instead of writing HTML here, lets do an include
	include(MY_THEME_FOLDER . '/custom/meta.php');
 
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="exclusive_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 
function exclusive_meta_save($post_id) 
{
	// authentication checks

	// make sure data came from our meta box
	if (!wp_verify_nonce($_POST['exclusive_meta_noncename'],__FILE__)) return $post_id;

	// check user permissions
	if ($_POST['post_type'] == 'page') 
	{
		if (!current_user_can('edit_page', $post_id)) return $post_id;
	}
	else 
	{
		if (!current_user_can('edit_post', $post_id)) return $post_id;
	}

	// authentication passed, save data

	// var types
	// single: _exclusive_meta[var]
	// array: _exclusive_meta[var][]
	// grouped array: _exclusive_meta[var_group][0][var_1], _exclusive_meta[var_group][0][var_2]

	$current_data = get_post_meta($post_id, '_exclusive_meta', TRUE);	
 
	$new_data = $_POST['_exclusive_meta'];

	exclusive_meta_clean($new_data);
	
	if ($current_data) 
	{
		if (is_null($new_data)) delete_post_meta($post_id,'_exclusive_meta');
		else update_post_meta($post_id,'_exclusive_meta',$new_data);
	}
	elseif (!is_null($new_data))
	{
		add_post_meta($post_id,'_exclusive_meta',$new_data,TRUE);
	}

	return $post_id;
}

function exclusive_meta_clean(&$arr)
{
	if (is_array($arr))
	{
		foreach ($arr as $i => $v)
		{
			if (is_array($arr[$i])) 
			{
				exclusive_meta_clean($arr[$i]);

				if (!count($arr[$i])) 
				{
					unset($arr[$i]);
				}
			}
			else 
			{
				if (trim($arr[$i]) == '') 
				{
					unset($arr[$i]);
				}
			}
		}

		if (!count($arr)) 
		{
			$arr = NULL;
		}
	}
}

?>