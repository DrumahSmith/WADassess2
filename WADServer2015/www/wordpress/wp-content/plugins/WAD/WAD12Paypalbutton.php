<?php
/*
Plugin Name: WAD course - 12. Plugin as a class (advanced) - simple paypal button
Plugin URI: http://localhost/
Description: Demo plugin for the ITWD7.350 WAD course. This plugin demonstrates a basic class with a simple Paypal button.
Author: John Jamieson
Version: 1.0
Author URI: http://http://eitonline.eit.ac.nz/course/view.php?id=72/
Last update: 11 Nov 2014
*/

/* DEBUGGING NOTE
 * Change the line 81 of the wp-config.php file in the Wordpress root folder
 * from 	define('WP_DEBUG', false);
 * to		define('WP_DEBUG', true);
 * This will enable the debugging and any error messages.
*/
/* CHANGELOG
	17MAY2014 - Initial release.
		
*/
/*-------------------------------------------------------------------------------------------
 * Wordpress globals - http://codex.wordpress.org/User:CharlesClarkson/Global_Variables
 * 					 - http://codex.wordpress.org/Function_Reference
 * Database object - http://codex.wordpress.org/Class_Reference/wpdb
 * 				   - http://codex.wordpress.org/Database_Description
 * Include JS/CSS  - http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 
 -------------------------------------------------------------------------------------------*/
//simple variable debug function
//usage: pr($avariable);
if (!function_exists('pr')) {
  function pr($var) { echo '<pre>Diagnostics: '; var_dump($var); echo '</pre>';}
}

if (!class_exists("WAD12")) {
class WAD12class {
//class variables declared here    
	var $WAD12settings = "WAD12paypalsettings";
	
//class methods    
	function WAD12class() { 
      //empty class constructor
    }
//load default options for the Paypal button    
    function getAdminOptions() {
    	$WAD12AdminOpts = array(
          'currency_code'    => 'USD',
          'country_code'     => 'US',
          'paypal_testmode'  => 0,
          'button_path'      => 'en_US',
          'default_btnsize'  => '_LG',    //_SM or _LG
          'open_window'      => '_self', //_self or _blank
          'paypal_url'       => 'https://www.paypal.com/',
          'paypal_testurl'   => 'https://www.sandbox.paypal.com/',
          'paypal_email'     => '',
          'paypal_testemail' => ''
        );

		$O = get_option( $this->WAD12settings );
		if (!empty($O)) {
			foreach ($O as $k => $v ) {
				$options[$k] = $v;
			}	  
		}
		update_option($this->WAD12settings, $options);
		return $options;
    }

    function initialize() {
      $this->getAdminOptions();
    }

    function GenerateAdminPage() {

		global $wpdb;

		$PaypalSettings = $this->getAdminOptions();

		if (isset($_POST['update_WAD12Settings'])) {
			if (isset($_POST['currency_code'])) {
				$PaypalSettings['currency_code'] = $wpdb->escape($_POST['currency_code']);
			}

			if (isset($_POST['country_code'])) {
				$PaypalSettings['country_code'] = $wpdb->escape($_POST['country_code']);
			}

			if (isset($_POST['paypal_testmode'])) {
				$PaypalSettings['paypal_testmode'] = $wpdb->escape($_POST['paypal_testmode']);
			}

			if (isset($_POST['paypal_url'])) {
				$PaypalSettings['paypal_url'] = $wpdb->escape($_POST['paypal_url']);
			}

			if (isset($_POST['paypal_testurl'])) {
				$PaypalSettings['paypal_testurl'] = $wpdb->escape($_POST['paypal_testurl']);
			}

			if (isset($_POST['paypal_email'])) {
				$PaypalSettings['paypal_email'] = $wpdb->escape($_POST['paypal_email']);
			}

			if (isset($_POST['paypal_testemail'])) {
				$PaypalSettings['paypal_testemail'] = $wpdb->escape($_POST['paypal_testemail']);
			}

			update_option($this->WAD12settings, $PaypalSettings);

?>

        <div class="updated"><p><strong><?php _e("Settings Updated.", "WAD12");?></strong></p></div>
<?php

			foreach($PaypalSettings as $k => $v) {
				$PaypalSettings[$k] = esc_html($v);
			}
		} 
?>
      <div class=wrap>
        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
          <h2>WAD12 PayPal Button</h2>
          <h3>PayPal Account Email / Merchant Account ID</h3>
          <p>Enter your valid PayPal account email address. Or, enter your valid Merchant Account ID, which you can find in your PayPal account profile under My Business Info. Payments will be made to the PayPal account associated with this specified email address or merchant id.</p>
          <input type="text" size="50" name="paypal_email" id="paypal_email" value="<?php _e(apply_filters('format_to_edit',$PaypalSettings['paypal_email']), 'WAD12'); ?>" />
          <h3>PayPal Test Mode Email / Test Merchant Account ID</h3>
          <p>Enter your valid PayPal sandbox test seller email address. Or, enter your valid Merchant Account ID, which you can find in your PayPal sandbox account profile under My Business Info. Test payments will be made to the sandbox account associated with this specified email address. To use this feature you must have a PayPal developer account.
		  Buttons: https://developer.paypal.com/webapps/developer/docs/classic/api/buttons/</p>
          <input type="text" size="50" name="paypal_testemail" id="paypal_testemail" value="<?php _e(apply_filters('format_to_edit',$PaypalSettings['paypal_testemail']), 'WAD12'); ?>" />
          <h3>PayPal Test Mode</h3>
          <p>Select on or off to put all PayPal buttons in and out of test mode. When on is specified all transactions are sent to the PayPal sandbox. To use this feature you must have a PayPal developer account.</p>
          <p><label for="paypal_testmode0">
            <input type="radio" id="paypal_testmode0" name="paypal_testmode" value="0" <?php if ($PaypalSettings['paypal_testmode'] == 0) { _e('checked="checked"', "WAD12"); }?> />off</label>&nbsp;&nbsp;&nbsp;&nbsp;
          <label for="jform_params_paypal_testmode1">
            <input type="radio" id="paypal_testmode1" name="paypal_testmode" value="1" <?php if ($PaypalSettings['paypal_testmode'] == 1) { _e('checked="checked"', "WAD12"); }?> />on</label>
          </p>
          <h3>Currency Code</h3>
          <p>Valid PayPal 3-letter currency codes: Australian Dollars: AUD, Canadian Dollars: CAD, Euros: EUR, Pounds Sterling: GBP, Yen: JPY, U.S. Dollars: USD, New Zealand Dollar: NZD, Swiss Franc: CHF, Hong Kong Dollar: HKD, Singapore Dollar: SGD, Swedish Krona: SEK, Danish Krone: DKK, Polish Zloty: PLN, Norwegian Krone: NOK, Hungarian Forint: HUF, Czech Koruna: CZK, Israeli Shekel: ILS, Mexican Peso: MXN.</p>
          <input type="text" size="3" maxlength="3" name="currency_code" id="currency_code" value="<?php _e(apply_filters('format_to_edit',$PaypalSettings['currency_code']), 'WAD12'); ?>" />
          <h3>PayPal Country Code</h3>
          <p>Enter your 2 digit country code to set the language used on the PayPal payment page. PayPal uses a two-character country code (ISO 3166). Some examples are United States: US, Great Britain: GB, France: FR, Spain: ES, Netherlands: DL, Poland: PL, German: DE. If you don't know your country code, or you can Google PayPal Country Codes.</p>
          <input type="text" size="2" maxlength="2" name="country_code" id="country_code" value="<?php _e(apply_filters('format_to_edit',$PaypalSettings['country_code']), 'WAD12'); ?>" />
          <div class="submit">
          <input type="submit" name="update_WAD12Settings" value="<?php _e('Update Settings', 'WAD12') ?>" /></div>
        </form>
      </div>
<?php
    }


    function getWAD12shortcode ($shortcodevars = ''){

		extract(shortcode_atts(
		array('amount'	 => '',
			  'name'	 => '',
			  'sku'	     => '',
			  'shipping' => '',
			  'shipping2'=> '',
			  'tax'	     => '',
			  'quantity' => '',
			  'weight'	 => ''), $shortcodevars ));

		$options = $this->getAdminOptions();

		$shortcodevars['currency_code']    = $options['currency_code'];
		$shortcodevars['country_code']     = $options['country_code'];
		$shortcodevars['paypal_testmode']  = $options['paypal_testmode'];
		$shortcodevars['paypal_email']     = $options['paypal_email'];
		$shortcodevars['paypal_testemail'] = $options['paypal_testemail'];
		$shortcodevars['paypal_url']       = 'https://www.paypal.com/';
		$shortcodevars['paypal_testurl']   = 'https://www.sandbox.paypal.com/';
		$shortcodevars['command']          = '_xclick';
		$shortcodevars['url']              = $shortcodevars['paypal_testmode'] ? $shortcodevars['paypal_testurl']   : $shortcodevars['paypal_url'];
		$shortcodevars['email']            = $shortcodevars['paypal_testmode'] ? $shortcodevars['paypal_testemail'] : $shortcodevars['paypal_email'];
		$shortcodevars['button_image']     = 'https://www.paypalobjects.com/en_US/i/btn/x-click-but6.gif';

		foreach($shortcodevars as $k => $v) {
			$shortcodevars[$k] = esc_html($v);
		}
      
		return $this->WAD12GenerateForm( $shortcodevars );

    }

    function WAD12GenerateForm( $vars )
    {

		$S = '';
		if ( $vars['name'] != '' && $vars['command'] != '' && $vars['email'] != '' && $vars['url'] != '' ) 
		{
			$S .= '<form class="WAD12" action="'.$vars['url'].'/cgi-bin/webscr" method="post" target="'.$vars['open_window'].'">';
			$S .= '<input type="hidden" name="business" value="'.$vars['email'].'" />';
			$S .= '<input type="hidden" name="cmd" value="'.$vars['command'].'" />';
			$S .= '<input type="hidden" name="item_name" value="'.$vars['name'].'" />';
			$S .= '<input type="hidden" name="amount" value="'.$vars['amount'].'" />';

			if ($vars['sku'] != '' ) { 
				$S .= '<input type="hidden" name="item_number" value="'.$vars['sku'].'" />';  
			}

			if ( $vars['shipping'] != '' ) {
				$S .= '<input type="hidden" name="shipping" value="'.$vars['shipping'].'" />';
			}

			if ( $vars['shipping2'] != '' ) {
				$S .= '<input type="hidden" name="shipping2" value="'.$vars['shipping2'].'" />';
			}

			if ( $vars['tax'] != '' ) {
				$S .= '<input type="hidden" name="tax" value="'.$vars['tax'].'" />';
			}

			if ( $vars['quantity'] != '' ) {
				$S .= '<input type="hidden" name="quantity" value="'.$vars['quantity'].'" />';
			}

			if ( $vars['weight'] != '' ) {
				$vars['weight'] = strtolower( $vars['weight'] );
				$vars['weight'] = str_replace( ' ', '', $vars['weight'] );
				$S .= '<input type="hidden" name="weight" value="'.$vars['weight'].'" />';
				$S .= '<input type="hidden" name="weight_unit" value="kgs" />';
			}

			$S .= '<input type="hidden" name="currency_code" value="'.$vars['currency_code'].'" />';
			$S .= '<input type="hidden" name="lc" value="'.$vars['country_code'].'" />';
			$S .= '<input type="image" name="submit" style="border: 0;" src="'.$vars['button_image'].'" alt="PayPal - The safer, easier way to pay online" />';
			$S .= '</form>';
		} else {
			$S .= '<div style="color: red;" >ERROR: Incomplete PayPal Button data!</div>';
		}	
		
		return $S;
    }
	
}}

if (class_exists("WAD12class")) {
    $WAD12paypalbutton = new WAD12class();
}

if (isset($WAD12paypalbutton)) {
	function WAD12class_adminpanel() {
		global $WAD12paypalbutton;

		if ( !isset($WAD12paypalbutton) ) {
			return;
		}

		add_options_page('WAD12 PayPal', 'WAD12 PayPal', 9, basename(__FILE__), array(&$WAD12paypalbutton, 'GenerateAdminPage'));    
	}


	function WADsettingslink($links) { 
	//http://codex.wordpress.org/Function_Reference/admin_url
		array_unshift($links, '<a href="'.admin_url('options-general.php?page=WAD12Paypalbutton.php').'">Settings</a>'); 
		return $links; 
	}
}

if (isset($WAD12paypalbutton)) {
//-------------------------------------------------------------------------------------------
	add_action('plugin_action_links_'.plugin_basename(__FILE__), 'WADsettingslink' );  
    add_action('admin_menu', 'WAD12class_adminpanel');
    add_action('activate_WAD12WAD12Paypalbutton/WAD12Paypalbutton.php',  array(&$WAD12paypalbutton, 'initialize'));

    add_shortcode('wad12paypal', array(&$WAD12paypalbutton, 'getWAD12shortcode'), 1);

    add_filter( 'widget_text', 'shortcode_unautop');
    add_filter( 'widget_text', 'do_shortcode', 11);

}

?>