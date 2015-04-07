<?php get_header(); ?>
</div>	
</div>
<div id="content" >

 <?php   exclusive_home_about_us(); ?>	
	
		<div class="container">
		
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1"   class="widget-area">
				<div class="sidebar-container">				
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>					
				</div>
			</div>
			<?php } 
			
		    exclusive_content_posts();  
			
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
