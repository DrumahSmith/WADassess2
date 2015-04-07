<?php 

get_header();
exclusive_update_page_layout_meta_settings();

?>
</div>	
</div>
<div id="content" class="page">
	<div class="container">
	
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<div id="sidebar1"  class="widget-area" role="complementary">
			<div class="sidebar-container">
				<?php dynamic_sidebar( 'sidebar-1' );  ?>
			</div>
		</div>
		<?php } ?>
		<div id="blog" class="blog" >		
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					  <div class="single-post single-page">
						 
							<a href="<?php the_permalink(); ?>">
								<h3><?php the_title(); ?></h3>
							</a>
						 
						<?php the_content();  ?>
					 </div>				
			    <?php endwhile; ?>
			   <div class="navigation">
					<?php posts_nav_link(); ?>
			   </div>
			<?php endif; 

               global $post;
			   $withcomments = true;
				if(comments_open())
				{	wp_reset_query(); ?>
					<div class="comments-template">
						<?php echo comments_template();	?>
					</div>
			<?php
				}		
			?>

  </div>
	
<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
	<div id="sidebar2"  class="widget-area" role="complementary">
		<div class="sidebar-container">
			<?php dynamic_sidebar( 'sidebar-2' );  ?>
		</div>
	</div>     
			<?php } ?>
	   <div class="clear"></div>
	</div>
</div>   
                 
<?php get_footer(); ?>