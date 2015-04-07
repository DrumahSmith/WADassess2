jQuery(document).ready(function(){ 
	
	 var j=jQuery('tr.slide-from-base').length;

	
	jQuery('#main_slider_div .upload-button').click(function(){
		var button="add";
 		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');  
		add_image=send_to_editor ;
		
		window.send_to_editor = function(html) { 
			imgurl = jQuery('img',html).attr('src');
			var tr='<tr class="new"><td width="30%" valign="middle"><h3>Image</h3></td><td><input size="36" value="'+imgurl+'" class="upload" id="ct_image_link_'+j+'" name="ct_image_link_'+j+'" /><input type="submit" class="update-button" value="Update image"><input class="remove-image" value="Remove image" type="submit" /></td></tr> <tr class="new" rel="'+j+'"><td width="30%" valign="middle"><h3></h3></td><td><img  src="'+imgurl+'" /></td></tr><tr class="new"><td width="30%" valign="middle"><h3>The URL of image when clicked</h3></td><td><input type="text" name="ct_image_href_'+j+'" value="" /></td></tr><tr><td width="30%"  valign="middle"><h3>Image Title</h3></td><td><input  type="text"  name="ct_image_title_'+j+'" value="" /></td></tr><tr class="new"><td width="30%"  valign="middle"><h3>Text on images</h3></td><td><textarea name="ct_image_textarea_'+j+'"></textarea></td></tr>';
			jQuery("#add-image-line").before(tr);	
			j++;
			tb_remove();  
		};
		return false; 	
	});
	
	
	jQuery(document).on("click" , ".update-button",  function(){
		var i=jQuery(this).parents("tr").next().attr("rel");
		var button="update";
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');  	
	
		window.send_to_editor = function(html) { 
			updateurl = jQuery('img',html).attr('src'); 
			jQuery("#ct_image_link_"+i).attr('value',updateurl);
			jQuery("#ct_image_link_"+i).attr('name','ct_image_link_'+i);
			jQuery("tr[rel='"+i+"']").find("img").attr("src",updateurl);
			tb_remove();  
		};

		return false; 	
	});
	

	jQuery(document).on("click" , ".remove-image",  function(){
		jQuery(this).parents("tr").next().next().next().next().remove();
		jQuery(this).parents("tr").next().next().next().remove();
		jQuery(this).parents("tr").next().next().remove();
		jQuery(this).parents("tr").next().remove();
		jQuery(this).parents("tr").remove();
		return false;
	});
	
});