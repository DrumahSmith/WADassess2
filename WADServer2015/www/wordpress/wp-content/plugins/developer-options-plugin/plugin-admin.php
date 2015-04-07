<?php

class Developer_Options_Admin extends Developer_Options {
	/**
	 * Error messages to diplay
	 *
	 * @var array
	 */
	private $_messages = array();
	
	
	
	/**
	 * Class constructor
	 *
	 */
	public function __construct() {
		$this->_plugin_dir   = DIRECTORY_SEPARATOR . str_replace(basename(__FILE__), null, plugin_basename(__FILE__));
		$this->_settings_url = 'options-general.php?page=' . plugin_basename(__FILE__);;
	
	//wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	

	//wp_enqueue_script( 'jquery' );
	//wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );

		//not used currently, maybe in a future version
		$allowed_options = array();
		
		
		if(array_key_exists('option_name', $_GET) && array_key_exists('option_value', $_GET)
			&& in_array($_GET['option_name'], $allowed_options)) {
			
			//not used currently, maybe in a future version
			//update_option($_GET['option_name'], $_GET['option_value']);
			
			header("Location: " . $this->_settings_url);
			die();	
		
		} else {
			// register installer function
			register_activation_hook(DO_LOADER, array(&$this, 'activateDeveloperOptions'));
			
			// add plugin "Settings" action on plugin list
			add_action('plugin_action_links_' . plugin_basename(DO_LOADER), array(&$this, 'add_plugin_actions'));
			
			// add links for plugin help, donations,...
			add_filter('plugin_row_meta', array(&$this, 'add_plugin_links'), 10, 2);
			
			// push options page link, when generating admin menu
			add_action('admin_menu', array(&$this, 'adminMenu'));
	
		}
	}
	
	/**
	 * Add "Settings" action on installed plugin list
	 */
	public function add_plugin_actions($links) {
		array_unshift($links, '<a href="options-general.php?page=' . plugin_basename(__FILE__) . '">' . __('Settings') . '</a>');
		
		return $links;
	}
	
	/**
	 * Add links on installed plugin list
	 */
	public function add_plugin_links($links, $file) {
		if($file == plugin_basename(TW_LOADER)) {
			$links[] = '<a href="http://MyWebsiteAdvisor.com">Premium Plugins</a>';
		}
		
		return $links;
	}
	
	/**
	 * Add menu entry 
	 */
	public function adminMenu() {		
		// add option in admin menu, for setting options
		$plugin_page = add_options_page('Developer Options', 'Developer Options', 8, __FILE__, array(&$this, 'optionsPage'));

	}
	

	
	
	/**
	 * Display options page
	 */
	public function optionsPage() {
		// if user clicked "Save Changes" save them
		if(isset($_POST['Submit'])) {
			foreach($this->_options as $option => $value) {
				if(array_key_exists($option, $_POST)) {
					//update_option($option, $_POST[$option]);
				} else {
					//update_option($option, $value);
				}
			}

			$this->_messages['updated'][] = 'Options updated!';
		}

	
		
	
		foreach($this->_messages as $namespace => $messages) {
			foreach($messages as $message) {
?>
<div class="<?php echo $namespace; ?>">
	<p>
		<strong><?php echo $message; ?></strong>
	</p>
</div>
<?php
			}
		}
?>
<script type="text/javascript">var wpurl = "<?php bloginfo('wpurl'); ?>";</script>


<style type="text/css">

p.dev_option{
	background-color:#CCCCCC;
	padding:5px;
}

pre.dev_option{
	background-color:#CCCCCC;
	padding:5px;
}


</style>



<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Developer Options</h2>
	    
     <?php 
	$dev_options = get_alloptions(); 
	foreach($dev_options as $key=>$value){
		if($this->is_serial($value)){
			$value = "<pre class='dev_option'>" . print_r(unserialize($value), true) . "</pre>";
		}
		echo "<p class='dev_option'><b>$key:</b> $value</p>";
	}
	?>
  

	


			

</div>
<?php
	}



function is_serial($string) {
    return (@unserialize($string) !== false);
}




}

$developer_options = new Developer_Options_Admin();
?>