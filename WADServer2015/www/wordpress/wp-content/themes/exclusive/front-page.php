<?php get_header(); ?>
<?php exclusive_slideshow();
		
	  exclusive_top_posts(); ?>
	</div>	
</div>

<div id="content" >

 <?php  if( 'posts' == get_option( 'show_on_front' ) ){
       		exclusive_home_about_us();
         }  ?>	
	
		<div class="container">
		
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1"   class="widget-area">
				<div class="sidebar-container">				
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>					
				</div>
			</div>
			<?php } 
			
			if( 'posts' == get_option( 'show_on_front' ) )
				exclusive_content_posts();
			elseif('page' == get_option( 'show_on_front' ))
				exclusive_content_posts_for_home();			           		

            if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
				<div id="sidebar2"  class="widget-area">
					<div class="sidebar-container">
						<?php  dynamic_sidebar( 'sidebar-2' ); 	?>
					</div>
				</div>
          <?php } ?>
		<div class="clear"></div>

  </div>
</div>
<?php get_footer(); ?>
