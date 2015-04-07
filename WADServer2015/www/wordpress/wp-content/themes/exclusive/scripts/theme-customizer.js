var exclusive_footer_back_color='';
( function( jQuery ){/*
  wp.customize( 'web_bussines[color_schema]', function( value ) {
	 
		value.bind( function( to ) {
      switch (to) {
        case 'Theme-1': {
          var footer_background_color = '#E3E2E2';
          var content_background_color = '#ffffff';
          var wrapper_color = '#1f1f1f';
          var h3_color = '#0B2749';
          var a_link_color = '#FFFFFF';
          var a_hover_color = '#FFFFFF';
          var footer_color = '#1f1f1f';
		  var top_posts_color = '#0D2C53';
          break;

        }
        case 'Theme-2': {
          var footer_background_color = '#E3E2E2';
          var content_background_color = '#ffffff';
          var wrapper_color = '#1f1f1f';
          var h3_color = '#086200';
          var a_link_color = '#3E3E3E';
          var a_hover_color = '#3E3E3E';
          var footer_color = '#1f1f1f';
		  var top_posts_color = '#086200';
          break;

        }
        case 'Theme-3': {
          var footer_background_color = '#E3E2E2';
          var content_background_color = '#ffffff';
          var wrapper_color = '#1f1f1f';
          var h3_color = '#012331';
          var a_link_color = '#ffffff';
          var a_hover_color = '#ffffff';
          var footer_color = '#1f1f1f';
		  var top_posts_color = '#012331';
          break;
        }
		case 'Theme-4': {
          var footer_background_color = '#E3E2E2';
          var content_background_color = '#ffffff';
          var wrapper_color = '#1f1f1f';
          var h3_color = '#BE4415';
          var a_link_color = '#383838';
          var a_hover_color = '#383838';
          var footer_color = '#1f1f1f';
		  var top_posts_color = '#BE4415';
          break;
        }
      }
      jQuery( '.device' ).attr('style', 'background-color:' + footer_background_color + ' !important;' );
	   jQuery( '#footer' ).attr('style', 'background-color:' + footer_background_color + ' !important;' );
      jQuery( '#wrapper' ).attr('style', 'background-color:' + content_background_color + ' !important;' );
      jQuery( 'body' ).attr('style', 'color:' + wrapper_color + ' !important;' );
      jQuery( 'h3' ).attr('style', 'color:' + h3_color + ' !important;' );
      jQuery( 'a:link, a:visited' ).attr('style', 'color:' + a_link_color + ' !important;' );
      jQuery( 'a:hover' ).attr('style', 'color:' + a_hover_color + ' !important;' );
      jQuery( '.device' ).attr('style', 'color:' + footer_color + ' !important;' );
	  jQuery( '#footer' ).attr('style', 'color:' + footer_color + ' !important;' );
		} );
	} );*/
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			jQuery( '.site-title-a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			jQuery( '#site-description-p' ).text( to );
		} );
	} );
	 wp.customize( 'theme_mods_exclusive[exclusivecc_menu_elem_back_color]', function( value ) {
		value.bind( function( to ) {			        
				jQuery( '#top-nav-list' ).css('background-color',  to );
				jQuery( '#top-nav-list>li>ul, #top-nav-list>li:not(.current-menu-item):not(.current_page_item)' ).css('background-color',  to );
				jQuery( '#top-nav, .read_more' ).css('background-color',  to );
				
				jQuery(".top-nav-list li, #top-nav-list .current-menu-item > a, .top-nav-list .current-menu-item > a").hover(	
        	function(){
			    if(exclusive_menu_hover_back_color==""){
					jQuery(this).attr("style","background-color:none !important");
					}
				else{
					jQuery(this).attr("style","background-color:"+exclusive_menu_hover_back_color+" !important");
					}
				if(exclusive_menu_links_hover_color == "")
					jQuery(this).attr("style","color:none !important" );
				else				
					jQuery(this).attr("style","color:"+exclusive_menu_links_hover_color+" !important");	
			},
			function(){
			    if(exclusive_static_color== "")
					jQuery(this).attr("style","background-color:none !important");
				else	
					jQuery(this).attr("style","background-color:"+exclusive_static_color+" !important");
				if(exclusive_menu_links_color == "")
					jQuery(this).attr("style","color:none !important" );
				else				
					jQuery(this).attr("style","color:"+exclusive_menu_links_color+" !important");
			
			  });
				 window.parent.exclusive_static_color=to;
		} );
	  } );
	  
	  wp.customize( 'theme_mods_exclusive[exclusivecc_selected_menu_color]', function( value ) {
     	value.bind( function( to ) {
			jQuery( '#top-nav-list .current-menu-item,.top-nav-list li.current_page_item, #top-nav-list .current_page_item,.top-nav-list li.current-menu-item, #top-nav-list .current-menu-item > a,.top-nav-list li.current_page_item > a, #top-nav-list .current_page_item > a,.top-nav-list li.current-menu-item > a' ).css('background-color',to );
			jQuery( '#top-nav-list > li' ).css('border-right','1px solid '+to );
			jQuery("#top-nav-list .current-menu-item,.top-nav-list li.current_page_item, #top-nav-list .current_page_item,.top-nav-list li.current-menu-item,#top-nav-list .current-menu-item > a,.top-nav-list li.current_page_item > a, #top-nav-list .current_page_item > a,.top-nav-list li.current-menu-item > a").hover(
			   function(){
			       if(exclusive_menu_hover_back_color == "")
						jQuery(this).css("background-color", "none");
				   else		
						jQuery(this).css("background-color",exclusive_menu_hover_back_color);				
				},
				function(){
						jQuery(this).css("background-color", to);
						
			  });
			 window.parent.exclusive_selected_menu_color=to;
       } );
     } ); 
	
	 wp.customize( 'theme_mods_exclusive[blogdescription]', function( value ) {
		value.bind( function( to ) {
			jQuery( '#site-description-p' ).html( to  ); 
           		
		} );
	} );
    wp.customize( 'theme_mods_exclusive[exclusivecc_footer_back_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( '.device' ).css('background-color', to  );  
			jQuery( '#footer' ).css('background-color', to  ); 
			 window.parent.exclusive_footer_back_color=to;		
		} );
	} ); 
   wp.customize( 'theme_mods_exclusive[exclusivecc_home_top_posts_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( '#top-page' ).css('background-color', to  );		
             window.parent.exclusive_featured_posts_color=to;
		} );
	} ); 	
   wp.customize( 'theme_mods_exclusive[exclusivecc_sideb_background_color]', function( value ) {
   	value.bind( function( to ) {
			jQuery( '.sidebar-container' ).css('background-color',  to  );
			 window.parent.exclusive_sideb_background_color=to;	
    } );
  } );
     wp.customize( 'theme_mods_exclusive[exclusivecc_top_posts_color]', function( value ) {
   	value.bind( function( to ) {
			jQuery( '#top-posts' ).css('background-color',to );
			 window.parent.exclusive_top_posts_color=to;	
    } );
  } );
  
   wp.customize( 'theme_mods_exclusive[exclusivecc_menu_links_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( '.top-nav-list a:not(.top-nav-list .current-menu-item a), #top-nav-list a:not(#top-nav-list .current-menu-item a), .reply, #top-nav-list > li ul > li > a' ).attr('style', 'color:'+to );
			jQuery( '.read_more' ).css('color',  to ); 
			jQuery("#top-nav-list li a:not(#top-nav-list .current-menu-item a, #top-nav-list .active), .top-nav-list li a:not(.top-nav-list .current-menu-item a, .top-nav-list .active)").hover(
			   function(){
			       if(exclusive_menu_links_hover_color == "")
						jQuery(this).css("color", "none");
				   else		
						jQuery(this).css("color",exclusive_menu_links_hover_color);				
				},
				function(){
						jQuery(this).css("color", to);			
			  });
			 window.parent.exclusive_menu_links_color=to;			
		} );
	} );

   wp.customize( 'theme_mods_exclusive[exclusivecc_menu_color]', function( value ) {
    value.bind( function( to ) {    
	 jQuery( '#header' ).css('background-color',to );
	 jQuery( '#slideshow' ).css('background-color',to );
	 jQuery( '.get_title' ).css('background-color',  to );
	 jQuery( '.hedar-a-element' ).css('background-color',  to );	   
	 jQuery( '#menu-button-block' ).css('background-color',  to );
	 jQuery( '#top-nav-list li.menu-item-has-children.active:not(#top-nav-list .current-menu-item, .top-nav-list .current-menu-item)' ).css('background-color',  to );
	 
	 jQuery(".top-nav-list li:not(#top-nav-list .current-menu-item, .top-nav-list .current-menu-item)").hover(	
        	function(){
				jQuery(this).attr("style","background-color:"+to+" !important");				
			},
			function(){
			    if(exclusive_static_color== "")
					jQuery(this).attr("style","background-color:none !important");
				else	
					jQuery(this).attr("style","background-color:"+exclusive_static_color+" !important");
				if(exclusive_menu_links_color == "")
					jQuery(this).attr("style","color:none !important" );
				else				
					jQuery(this).attr("style","color:"+exclusive_menu_links_color+" !important");
			
			  });
			
       jQuery("#top-nav-list .current-menu-item a, .top-nav-list .current-menu-item a").hover(	
        	function(){
				jQuery(this).attr("style","background-color:"+to+" !important");				
			},
			function(){
			    if(exclusive_selected_menu_color== "")
					jQuery(this).attr("style","background-color:none !important");
				else	
					jQuery(this).attr("style","background-color:"+exclusive_selected_menu_color+" !important");
				if(exclusive_menu_links_hover_color == "")
					jQuery(this).attr("style","color:none !important" );
				else				
					jQuery(this).attr("style","color:"+exclusive_menu_links_hover_color+" !important");
			
			  });
			
			jQuery("#top-nav-list .current-menu-item,.top-nav-list li.current_page_item, #top-nav-list .current_page_item,.top-nav-list li.current-menu-item,#top-nav-list .current-menu-item a,.top-nav-list li.current_page_item > a, #top-nav-list .current_page_item > a,.top-nav-list li.current-menu-item > a").hover(
			   function(){
			        if(exclusive_menu_links_hover_color == "")
						jQuery(this).css("color", "none");
				    else		
						jQuery(this).css("color",exclusive_menu_links_hover_color);	
				},
				function(){
					if(exclusive_menu_links_hover_color == "")
						jQuery(this).css("color", "none");
				    else		
						jQuery(this).css("color",exclusive_menu_links_hover_color);	
						
			  });
	  window.parent.exclusive_menu_hover_back_color=to;
    } );
  } );
  
   wp.customize( 'theme_mods_exclusive[exclusivecc_content_back_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( '.content' ).css('background-color',  to );
			jQuery( '#site-description' ).css('background-color',  to );
			jQuery( '#content' ).css('background-color', to );
			jQuery( '#site-title' ).css('background-color',  to );
			 window.parent.exclusive_content_back_color=to;
		} );
	} );
   wp.customize( 'theme_mods_exclusive[exclusivecc_primary_text_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( '#wrapper' ).css('color', to );
			jQuery( '#content' ).css('color', to );
			 window.parent.exclusive_primary_text_color=to;
		} );
	} );

   wp.customize( 'theme_mods_exclusive[exclusivecc_text_headers_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( 'h1' ).css('color', to );
			jQuery( 'h2' ).css('color', to );
			jQuery( 'h3' ).css('color', to );
			jQuery( 'h4' ).css('color', to );
			jQuery( 'h5' ).css('color', to );
			jQuery( 'h6' ).css('color', to );
			jQuery("#ccc").html("h1, h2, h3, h4, h5, h6{color:"+to+" !important;}");
			 window.parent.exclusive_text_headers_color=to;
		} );
	} );
   wp.customize( 'theme_mods_exclusive[exclusivecc_primary_links_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( 'a:not(#top-nav-list a):not(.site-title-a)' ).css('color', to );
			jQuery("a:not(#top-nav-list a):not(.site-title-a)").hover(function(){
			    if(exclusive_link_color_hover == "")
				  jQuery(this).css("color", "none" );
				else				
				  jQuery(this).css("color", exclusive_link_color_hover);
				},function(){
				  jQuery(this).css("color",to); 
			  });
			 window.parent.exclusive_link_color_stop=to;			
		} );
	} );
		
	  wp.customize( 'theme_mods_exclusive[exclusivecc_logo_text_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( '.site-title-a, .styledHeading' ).css('color', to );
			 window.parent.exclusive_logo_text_color=to;
		} );
	} );
	wp.customize( 'theme_mods_exclusive[exclusivecc_logo_text_color_for_phone]', function( value ) {
		value.bind( function( to ) {
			jQuery( '.phone a:link.site-title-a,.phone a:hover.site-title-a,.phone a:visited.site-title-a,.phone a.site-title-a' ).css('color', to );
			 window.parent.exclusive_logo_text_color_for_phone=to;
		} );
	} );
   wp.customize( 'theme_mods_exclusive[exclusivecc_primary_links_hover_color]', function( value ) {
		value.bind( function( to ) {
            
			jQuery("a:not(#top-nav-list a):not(.site-title-a)").hover(function(){
				jQuery(this).css("color",to);				
				},function(){
				if(exclusive_link_color_stop == "")
				  jQuery(this).css("color", "none" );
				else				
				  jQuery(this).css("color", exclusive_link_color_stop);
			  });
		
			 window.parent.exclusive_link_color_hover=to;
		} );
	} );
	
	   wp.customize( 'theme_mods_exclusive[exclusivecc_menu_links_hover_color]', function( value ) {
		value.bind( function( to ) {
            jQuery( '.read_more, .top-nav-list .current-menu-item > a' ).attr('style', 'color:'+to+' !important');
			jQuery("#top-nav-list li > a:not(#top-nav-list .current-menu-item a), .top-nav-list li > a:not(.top-nav-list .current-menu-item a)").hover(
			   function(){
					jQuery(this).attr("style","color:"+to);				
				},
				function(){
						if(exclusive_menu_links_color == "")
							jQuery(this).css("color", "none");
						else				
							jQuery(this).css("color", exclusive_menu_links_color);			
			  });
			  jQuery("#top-nav-list .current-menu-item,.top-nav-list li.current_page_item, #top-nav-list .current_page_item,.top-nav-list li.current-menu-item,#top-nav-list .current-menu-item a,.top-nav-list li.current_page_item > a, #top-nav-list .current_page_item > a,.top-nav-list li.current-menu-item > a").hover(
			   function(){
			        jQuery(this).css("color", to);
				},
				function(){
				    jQuery(this).css("color", to);
					if(exclusive_menu_hover_back_color == "")
						jQuery(this).css("background-color", "none");
				    else		
						jQuery(this).css("background-color",exclusive_menu_hover_back_color);	
						
			  });
			 window.parent.exclusive_menu_links_hover_color=to;
		} );
	} );
	
   wp.customize( 'theme_mods_exclusive[exclusivecc_footer_text_color]', function( value ) {
		value.bind( function( to ) {
			jQuery( '.device' ).css('color', to );
			jQuery( '#footer' ).css('color', to  ); 
			 window.parent.exclusive_footer_text_color=to;
		} );
	} );
   wp.customize( 'theme_mods_exclusive[exclusivety_type_headers_font]', function( value ) {
		value.bind( function( to ) {
      jQuery( 'h1,h2,h3,h4,h5,h6, strong.heading' ).css('font-family', to );
		} );
	} );
   wp.customize( 'theme_mods_exclusive[exclusivety_type_primary_font]', function( value ) {
		value.bind( function( to ) {
			jQuery( 'body:not(#top-nav-list a):not(.top-nav-list a)' ).css('font-family',  to  );
		} );
	} );
   wp.customize( 'theme_mods_exclusive[exclusivety_type_secondary_font]', function( value ) {
		value.bind( function( to ) {
			jQuery( '#site-description-p' ).css('font-family',  to );
		} );
	} );
   wp.customize( 'theme_mods_exclusive[exclusivety_type_inputs_font]', function( value ) {
		value.bind( function( to ) {
			jQuery( 'textarea,input[type="text"], .read_more' ).css('font-family', to );
		} );
	} );
} )( jQuery );