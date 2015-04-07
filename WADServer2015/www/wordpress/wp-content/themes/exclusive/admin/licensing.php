<?php 

/// licensing 

class expert_licensing_page_class{

	public function web_dorado_licensing_admin_scripts(){
	
		wp_enqueue_style('web_dorado_licensing_admin_scripts',get_template_directory_uri().'/admin/css/licensing.css');	
	}

	
function dorado_theme_admin_licensing(){
global $exclusive_web_dor;
?>

<div id="main_licensing_page" style="width: 95%;margin: 0 auto;"> 
<p>
This theme is the non-commercial version of the Web-Business theme. You will be able to use it free of charge. It comes with a large number of features. Some of the advanced features are not available for this option. If you want to use those features, you are required to purchase a license.</p>
<table class="data-bordered" style="width:543px;color: #555;text-align:center;margin: 10px 24px;">
<thead>
<tr> <th scope="col" class="top first" nowrap="nowrap">Features of the Theme</th>
<th scope="col" class="top notranslate" nowrap="nowrap">Free</th>
<th scope="col" class="top notranslate" nowrap="nowrap">Pro Version</th>
</tr>
</thead>
<tbody>
<tr class="">
<td>WordPress 3.4+ ready +</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="alt">
<td>SEO-friendly</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="">
<td>Custom favicon and logo</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="alt">
<td>Possibility to add custom CSS</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="">
<td>Featured animated slider</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="alt">
<td>30 pre-installed fonts</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="">
<td>Widgets for AdSense, Advertisements and Random posts</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="alt">
<td>Child theme support</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="">
<td>6 built in customizable layouts</td>
<td class="icon-replace yes">yes</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="alt">
<td>Social sharing integration</td>
<td class="icon-replace no">no</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="">
<td>Possibility to add custom codes</td>
<td class="icon-replace no">no</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="alt">
<td>Full SEO management</td>
<td class="icon-replace no">no</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="">
<td>Color customization possibility</td>
<td class="icon-replace no">no</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="alt">
<td>10 different page templates</td>
<td class="icon-replace no">no</td>
<td class="icon-replace yes">yes</td>
</tr>
<tr class="">
<td>Built-in shortcodes for Editor</td>
<td class="icon-replace no">no</td>
<td class="icon-replace yes">yes</td>
</tr>

<tr class="alt">
<td>Support upon request in 24 hours</td>
<td class="icon-replace no">no</td>
<td class="icon-replace yes">yes</td>
</tr>

<tr class="">
<td>Buy using PayPal or Credit Card</td>
<td class="price" style="text-align:center; color:#FF7721; text-shadow: 1px 1px #aaa; font-size:20px;">Free</td>
<td>
<div class="buy_theme" style="float:left;"><a href="<?php echo $exclusive_web_dor.'/wordpress-themes/exclusive.html'; ?>" target="_blank"><div></div></a></div>
</td>
</tr>
</tbody>
</table>
	</div >

<?php
}



}


?>