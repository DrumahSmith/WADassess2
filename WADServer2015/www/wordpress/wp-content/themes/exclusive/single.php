<?php
get_header(); 
exclusive_update_page_layout_meta_settings();
?>
</div>	
</div>
<div id="content" class="page">
		<div class="container">
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1" class="widget-area">
				<div class="sidebar-container">
				  <?php dynamic_sidebar( 'sidebar-1' );  ?>
				</div>
			</div>
				<?php }	?>
			
			<div id="blog" class="blog">
   				<?php 
			    if(have_posts()) { ?><?php while(have_posts()) { the_post(); ?>
				    <div class="single-post">
					
						<a class="title_href" href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
						</a>
				    
						<?php
						exclusive_entry_meta_cont(); 
						?>
						<div class="entry">	
							<?php the_post_thumbnail();  
								  the_content(); ?>
						</div>
					</div>
					
					<?php
					wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Page', 'wd_exclusive' ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-links-number">', 'link_after' => '</span>' ) ); 
			        exclusive_post_nav();
				
					global $post;
					$withcomments = true;
					if(comments_open()){	
					wp_reset_query();
					?>
			       <div class="comments-template">
				      <?php echo comments_template(); ?>
			       </div>	
           <?php  }  ?>
	</div>			

<?php }} 


		if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div id="sidebar2" class="widget-area">
				<div class="sidebar-container">
				  <?php dynamic_sidebar( 'sidebar-2' );  ?>
				</div>
			</div>     
			<?php } ?>
		
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>